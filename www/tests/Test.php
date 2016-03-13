<?php

require_once dirname(__FILE__) . '/../app/core/database/FDatabase.php';
require_once dirname(__FILE__) . '/../app/core/database/FQuery.php';
require_once dirname(__FILE__) . '/../app/core/FConfigBase.php';
require_once dirname(__FILE__) . '/../app/core/utils/FDebug.php';
require_once dirname(__FILE__) . '/../app/core/FModelObject.php';

class Test
{
    private $db;
    
    
    public function __construct()
    {
        $this->connectDB();
        
        FDebug::setLogToFile(true);
        FDebug::setLogFileName(dirname(__FILE__) . '/../../logs/log.txt');
        FDebug::setEnabled(true);
    }

    public function connectDB()
    {
        $config = new FConfigBase;
        $config->loadSettings();
        
        $this->db = FDatabase::getInstance();
        $this->db->connect(FConfigBase::$config['db_host'], FConfigBase::$config['db_username'], FConfigBase::$config['db_password'], FConfigBase::$config['db_name']);
    }
    
    
    public function runTest()
    {
        require_once dirname(__FILE__) . '/../app/core/user/FUser.php';
        
        $user = new FUserModel($this->db);        
        $user->setValue('username', "fifa");
        $user->setValue('email', 'email');
        $user->insert();
        
        $user->loadByEmail('email');
        $user->setValue('email', 'new-email');
        $user->update();
    }
    
}

$test = new Test();
$test->runTest();

?>