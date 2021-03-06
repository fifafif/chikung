<?php

define('APP_PATH', '\\..\\..\\www\\');

require_once dirname(__FILE__) . APP_PATH . 'app/core/database/FDatabase.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/database/FQuery.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/FConfigBase.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/utils/FDebug.php';


class FEntityGen
{
    private $db;
    private $outputFolder;
    private $config;
    
    public function __construct($outputFolder = "")
    {
        $this->outputFolder = $outputFolder;
    }

    public function connectDB()
    {
        $config = new FConfigBase;
        $config->loadSettings();
        
        $this->db = FDatabase::getInstance();
        $this->db->connect(FConfigBase::$config['db_host'], FConfigBase::$config['db_username'], FConfigBase::$config['db_password'], FConfigBase::$config['db_name']);
    }
    
    private function loadSchema()
    {
        $res = $this->db->execute("show tables;");
        
        $tableNames = array();
        
        while ($row = mysqli_fetch_array($res))
        {
            $tableNames[] = $row[0];
            $tableName = $row[0];
            //echo "" . $row[0];
            
            $resTable = $this->db->execute("describe " . $tableName);
            $resIndex = $this->db->execute("show index in $tableName;");
            
            $indexString = "";
            
            
            $indices = array();
                        
            // Parse Indices
            while ($rowIndex = mysqli_fetch_assoc($resIndex))
            {
                if (!isset($indices[$rowIndex['Key_name']]))
                {
                    $indices[$rowIndex['Key_name']] = array();
                }
                
                $indices[$rowIndex['Key_name']][] = $rowIndex['Column_name'];
            }
            
            foreach ($indices as $key => $value)
            {
                //if (count($value) == 1)
                {
                    if ($key == 'PRIMARY')
                    {
                        $key = $value[0];
                    }
                    
                    $keyCorrected = str_replace('-', '_', $key);
                    
                    $indexString .= "    const INDEX_$keyCorrected = '$key';\n";
                }
            }
            
            
            $indexFieldsString = "    protected static \$indexFields = array(";
            
            foreach ($indices as $key => $value)
            {
                if ($key == 'PRIMARY')
                {
                    $key = $value[0];
                }
                
                $indexFieldsString .= "\n        '$key' => array( '" . implode("', '", $value) . "' ),";
            }
            
            $indexFieldsString[strlen($indexFieldsString) - 1] = ')';
            $indexFieldsString .= ';';
            
            $fieldNamesString = '';
            $fieldsString = '';
            $entityArrayString = "    protected static \$dataTypes = array(";
            
            // Parse data fields
            while ($rowTable = mysqli_fetch_assoc($resTable))
            {
                $entity = $this->generateTableEntity($rowTable);
                
                $entityArrayString .= "\n        " . $this->buildTypeDefinition($rowTable, $entity) . ", ";
                $fieldsString .= "    public \$" . $rowTable['Field'] . ";\n";
                $fieldNamesString .= '    const FIELD_' . $rowTable['Field'] . ' = \'' . $rowTable['Field'] . "';\n";
                
                if (strpos($rowTable['Field'], '_') !== false)
                {
                    $referenceFields = explode('_', $rowTable['Field']);
                    $fieldsString .= "    public \$" . $referenceFields[0] . " = null;\n";
                }
                
            }
            
            $entityArrayString[strlen($entityArrayString) - 2] = ")";
            $entityArrayString[strlen($entityArrayString) - 1] = ";";
            
            $body = "<?php\n\nclass " . ucfirst($tableName) . "Entity extends FModelObject\n{\n";
            $body .= $indexString . "\n";
            $body .= $fieldNamesString . "\n";
            $body .= $fieldsString . "\n" . $entityArrayString . "\n\n";
            $body .= $indexFieldsString . "\n\n";
            $body .= "    public static \$tableName = '$row[0]';\n\n";
            $body .= "    public static function getTableName() { return self::\$tableName; }\n";
            $body .= "\n}\n?>";
            
            $tableModulePath = $this->getTableModule($tableName);
            if ($tableModulePath != false)
            {
                echo "Saving table [$tableName] into module path [$tableModulePath]\n\n";
                
                file_put_contents($tableModulePath . ucfirst($row[0]) . "Entity.php", $body);
            }
            else
            {
                echo "ERROR: Saving table [$tableName] failed! Module path not found [$tableModulePath]\n\n";
            }
            
            echo $body . "\n\n";
        }
    }
    
    private function buildTypeDefinition(&$row, &$array)
    {
        return "'" . $row["Field"] . "' => array ($array[0], $array[1], $array[2], $array[3], $array[4])";
    }
    
    private function generateTableEntity($row)
    {
        $size = 0;

        $bracketPos = strpos($row["Type"], "(");
        if ($bracketPos)
        {
            $fieldTypeName = substr($row["Type"], 0, ($bracketPos ? $bracketPos : -1));
            $size = substr($row["Type"], $bracketPos + 1, strlen($row["Type"]) - ($bracketPos + 2));
        }
        else
        {
            $fieldTypeName = $row["Type"];
        }

        $type = $this->getColumnType($fieldTypeName);
//            echo "$fieldTypeName = $type\n<br>";

        $isAutoincrement = $row['Extra'] == "auto_increment" ? 'true' : 'false';
        $key = (!isset($row["Key"])) ? 0 : ($row["Key"] == 'PRI') ? 2 : 1;
        $default = 'NULL'; //$row['Default']; // TODO
        $isNull = $row['Null'] == 'YES' ? 'true' : 'false';
        
        $array = array($type, $isNull, $key, $default, $isAutoincrement);
        
        return $array;
    }
        
    protected $dataTypes = array('id' => array(0, 1, 0, 1), 'name' => 2, 'theme' => 2);
    
    
    public function createEntities()
    {
        $this->connectDB();
        $this->loadSchema();
    }
    
    private function getColumnType($columnType)
    {
        switch($columnType)
        {
            case 'int':
            case 'tinyint':
            case 'bigint':
                return FQueryParam::INT;
            
            case 'varchar':
            case 'text':
                return FQueryParam::STRING;
                
            case 'datetime':
            case 'timestamp':
                return FQueryParam::DATETIME;
                
            case 'float':
            case 'double':
                return FQueryParam::FLOAT;
                
            default:
                return FQueryParam::INT;
        }
    }
    
    private function getTableModule($tableName)
    {
        // FIXME !!!! Move to core and config core
        if ($tableName == 'user')
        {
            return $this->outputFolder . 'core/user/';
        }
        
        foreach (FConfigBase::$modules as $module)
        {
            if (isset($module['tables']))
            {
                if (in_array($tableName, $module['tables']))
                {
                    return $this->outputFolder . 'modules/' . $module['path'] . 'model/entities/';
                }
            }
        }
        
        return false;
    }
}

parse_str(implode('&', array_slice($argv, 1)), $_GET);

//echo $_GET["a"];

$outputFolder = dirname(__FILE__) . APP_PATH . "app/";

$entityGen = new FEntityGen($outputFolder);
$entityGen->createEntities();

?>