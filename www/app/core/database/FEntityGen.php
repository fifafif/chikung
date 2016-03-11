<?php


require_once dirname(__FILE__) . '/FDatabase.php';
require_once dirname(__FILE__) . '/FQuery.php';
require_once dirname(__FILE__) . '/../FConfigBase.php';

class FEntityGen
{
    private $db;

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
            $body .= "    protected \$tableName = '$row[0]';\n";
            $body .= "    protected \$dataTypes = array(";
            
            while ($rowTable = mysqli_fetch_assoc($resTable))
            {
                //print_r($rowTable);
                //echo "" . $rowTable->Field . "-" .  $rowTable->Type ."\n<br>";
                $body .= $this->generateTableEntity($rowTable) . ", ";
            }
            
            $body[strlen($body) - 2] = ")";
            $body[strlen($body) - 1] = ";";
            $body .= "\n}\n?>";
            
            file_put_contents(dirname(__FILE__) . "/../../mvc/model/entities/" . ucfirst($row[0]) . "Entity.php", $body);
            
            echo $body . "<br>";
        }
    }
    
    private function generateTableEntity($row)
    {
        //foreach ($table as $row)
        {
            $size = 0;
            $type = 0;
            
            $bracketPos = strpos($row["Type"], "(");
            $fieldTypeName = substr($row["Type"], 0, ($bracketPos ? $bracketPos : -1));
            $fieldType = $this->getColumnType($fieldTypeName);
            
            $size = 0;
            
            if ($bracketPos > 0)
            {
                $size = substr($row["Type"], $bracketPos + 1, strlen($row["Type"]) - ($bracketPos + 2));
            }
            
            return "'" . $row["Field"] . "' => " . $fieldType;
            
            //echo " :: $fieldType($size) :: <br> ";
            
            //$field = sprintf("\'%\'"$row);
        }
   
        
    }
        // "protected $dataTypes = array('id' => 0, 'name' => 2, 'theme' => 2);
    
    
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
            case 'string':
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


$entityGen = new FEntityGen();
$entityGen->createEntities();

?>