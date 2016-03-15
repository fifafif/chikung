<?php


require_once dirname(__FILE__) . '/FDatabase.php';
require_once dirname(__FILE__) . '/FQuery.php';
require_once dirname(__FILE__) . '/../FConfigBase.php';
require_once dirname(__FILE__) . '/../utils/FDebug.php';

class FEntityGen
{
    private $db;
    private $outputFolder;
    
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
            //echo "" . $row[0];
            
            $resTable = $this->db->execute("describe " . $row[0]);
                        
            $body = "<?php\n\nclass " . ucfirst($row[0]) . "Entity extends FModelObject\n{\n";
            //$body .= "    protected static \$tableName = '$row[0]';\n";
            
            
            
            $fieldsString = "";
            $entityArrayString = "    protected static \$dataTypes = array(";
            
            while ($rowTable = mysqli_fetch_assoc($resTable))
            {
                $entity = $this->generateTableEntity($rowTable);
                
                $entityArrayString .= "\n        " . $this->buildTypeDefinitio($rowTable, $entity) . ", ";
                //$fieldsString .= "    const FIELD_" . strtoupper($rowTable['Field']) . " = '". $rowTable['Field'] . "';\n";
                $fieldsString .= "    public \$" . $rowTable['Field'] . ";\n";
            }
            
            $entityArrayString[strlen($entityArrayString) - 2] = ")";
            $entityArrayString[strlen($entityArrayString) - 1] = ";";
            
            $body .= $fieldsString . "\n" . $entityArrayString . "\n\n";
//            $body .= "    public function getTableName() { return '$row[0]'; }\n";
            $body .= "    public static \$tableName = '$row[0]';\n";
            
            $body .= "\n}\n?>";
            
            if (isset($this->outputFolder))
            {
                file_put_contents($this->outputFolder . ucfirst($row[0]) . "Entity.php", $body);
            }
            
            echo $body . "<br>";
        }
    }
    
    private function buildTypeDefinitio(&$row, &$array)
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
}

parse_str(implode('&', array_slice($argv, 1)), $_GET);

//echo $_GET["a"];

$outputFolder = dirname(__FILE__) . "/../../apps/modules/main/model/entities/";

$entityGen = new FEntityGen($outputFolder);
$entityGen->createEntities();

?>