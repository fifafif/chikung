<?php

/**
 * Description of FDBGen
 *
 * @author XiXao
 */


define('APP_PATH', '\\..\\..\\www\\');

require_once dirname(__FILE__) . APP_PATH . 'app/core/database/FDatabase.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/database/FQuery.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/FConfigBase.php';
require_once dirname(__FILE__) . APP_PATH . 'app/core/utils/FDebug.php';
    
class DBCatchUp
{
    private $db;
    private $file;
    private $seedFile;
    private $config;
    
    public function __construct($dbFile = "", $seedFile = "")
    {
        $this->file = $dbFile;
        $this->seedFile = $seedFile;
    }

    private function connectDB()
    {
        $config = new FConfigBase;
        $config->loadSettings();
        
        $this->db = FDatabase::getInstance();
        $this->db->connect(FConfigBase::$config['db_host'], FConfigBase::$config['db_username'], FConfigBase::$config['db_password'], FConfigBase::$config['db_name']);
    }
    
    public function catchUp()
    {
        $this->connectDB();
        
        // Schema update
        $version = $this->loadLastChangeset();
        
        $query = '';
        
        $newVersion = $this->readNextChangeSet($query, $version);
        
        if ($newVersion > $version)
        {
            if ($this->updateSchema($query))
            {
                $this->saveNewVersion($newVersion);
            }
        }
        else
        {
            echo "\nSchema is up to date\n";
        }
        
        
        // Seed update
        $seedData = $this->loadSeedData();
        $this->insertSeedData($seedData);
        
        echo "\nSeed inserted";
        echo "\n\n";
    }
    
    private function updateSchema($query)
    {
        echo "\nRunning query:\n$query\n";
            
        if (mysqli_multi_query($this->db->getDBLink(), $query))
        {
            do 
            {
                if ($result = $this->db->getDBLink()->store_result()) 
                {
                    $result->free();
                }

                if ($this->db->getDBLink()->more_results()) 
                {
                    printf("-----------------\n");
                }
            } 
            while ($this->db->getDBLink()->next_result());

            return truee;
        }

        return false;
    }
    
    private function saveNewVersion($version)
    {
        try
        {
            $res = $this->db->execute("UPDATE `DBVERSION` SET `version` = $version;");
        } 
        catch (Exception $ex) 
        {
            print_r($ex);
        }
    }
    
    private function readNextChangeSet(&$query, $version = -1)
    {
        $file = fopen($this->file, "r");
        $query = '';
        $newVersion = -1;
        
        if ($file) 
        {
            $changeSetPattern = '/^\-\-changeset\s[a-zA-Z0-9]*:([0-9])/';
            $isReading = false;
            
            while (($line = fgets($file)) !== false) 
            {
                if (preg_match($changeSetPattern, $line, $matches) == 1)
                {
                    $newVersion = $matches[1];
                    
                    //echo "matches:: version = $newVersion<br>\n";
                    
                    if ($newVersion > $version)
                    {
                        $isReading = true;
                    }
                }
                else
                {
                    if ($isReading)
                    {
                        $query .= $line . "\n";
                    }
                }
            }

            fclose($file);
        } 
        else 
        {
            echo "Error opening DB schema file";
        } 
        
        return $newVersion;
    }
    
    private function loadLastChangeset()
    {
        $version = -1;
        
        try
        {
            $res = $this->db->execute('SELECT version FROM DBVERSION;');
            
            while ($row = mysqli_fetch_array($res))
            {
                $version = $row[0];
            }
        } 
        catch (Exception $ex) 
        {
            $res = $this->db->execute('CREATE TABLE IF NOT EXISTS `DBVERSION` ( `version` INT(11) NOT NULL DEFAULT \'0\')');
            $res = $this->db->execute('INSERT INTO `DBVERSION` ( `version` ) VALUES ( -1 )');
        }

        return $version;
    }
    
    private function insertSeedData($query)
    {
        if (mysqli_multi_query($this->db->getDBLink(), $query))
        {
            do 
            {
                if ($result = $this->db->getDBLink()->store_result()) 
                {
                    $result->free();
                }

                if ($this->db->getDBLink()->more_results()) 
                {
                    printf("-----------------\n");
                }
            }
            while ($this->db->getDBLink()->next_result());
        }
    }
    
    private function loadSeedData()
    {
        $file = fopen($this->seedFile, "r");
        $query = '';
        
        if ($file) 
        {
            while (($line = fgets($file)) !== false) 
            {
                $query .= $line . "\n";
            }
            
            fclose($file);
        } 
        else 
        {
            echo "Error opening seed schema file";

            return false;
        }
        
        return $query;
    }
}

$schemaFile = dirname(__FILE__) . '/../data/db.sql';
$seedFile = dirname(__FILE__) . '/../data/seed.sql';

$dbCatchUp = new DBCatchUp($schemaFile, $seedFile);
$dbCatchUp->catchUp();