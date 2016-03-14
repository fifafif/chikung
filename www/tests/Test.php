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
    
    
    public function testUser()
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
    
    public function testExcercise()
    {
        require_once dirname(__FILE__) . '/../app/apps/modules/main/model/ExerciseModel.php';
        
        $exercise = new ExerciseModel($this->db);        
        $exercise->setValue(ExerciseModel::FIELD_NAME, "exericise 1");
        $exercise->setValue(ExerciseModel::FIELD_DESCRIPTION, "desc 1");
        $exercise->setValue(ExerciseModel::FIELD_VIDEO, "vid 1");
        $exercise->setValue(ExerciseModel::FIELD_IMAGES, "img 1");
        $exercise->insert();
        
        
        $exercise->loadByPrimaryKey(10);
        
        print_r($exercise->data);
        
        //$exercise->setValue('email', 'new-email');email
        //$exercise->update();
    }
    
}

$test = new Test();
$test->testExcercise();

?>