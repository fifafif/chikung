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
            
            while ($rowTable = mysqli_fetch_assoc($resTable))
            {
                print_r($rowTable);
                //echo "" . $rowTable->Field . "-" .  $rowTable->Type ."\n<br>";
                $this->generateTableEntity($rowTable);
            }
        }
    }
    
    private function generateTableEntity($row)
    {
        //foreach ($table as $row)
        {
            $size = 0;
            $type = 0;
            
            $bracketPos = strpos($row["Type"], "(");
            $fieldType = substr($row["Type"], 0, ($bracketPos ? $bracketPos : null));
            
            echo " :: ".$fieldType . " ::  ";
            
            //$field = sprintf("\'%\'"$row);
        }
   
        
    }
        // "protected $dataTypes = array('id' => 0, 'name' => 2, 'theme' => 2);
    
    
    public function createEntities()
    {
        $this->connectDB();
        $this->loadSchema();
    }
}


$entityGen = new FEntityGen();
$entityGen->createEntities();

?>