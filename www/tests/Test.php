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
        
        $exercise = new ExerciseModel();
        $exercise->name = "name 1";
        $exercise->images = "img 1";
        $exercise->video = "video 1";
        $exercise->description = "description 1";
        
        $exercises = ExerciseModel::loadAll();
        $first = reset($exercises);
        
        $exeUpdate = current(ExerciseModel::loadByPrimaryKey($first->id));
        print_r($exeUpdate);
        
        $exeUpdate->name = "kuku";
        
        print_r($exeUpdate);
        
        $exeUpdate->update();
        
        //print_r($exercises);
        
        //$exercise->insert();
        
        
        //$exercise->loadByPrimaryKey(10);
        
        print_r($exercise);
        
        //$exercise->setValue('email', 'new-email');email
        //$exercise->update();
    }
    
    public function testExcercise2()
    {
        require_once dirname(__FILE__) . '/../app/apps/modules/main/model/ExerciseModel.php';
        require_once dirname(__FILE__) . '/../app/core/database/DataContext.php';
        
        $dataContext = new DataContext($this->db);
        
        $exercise = new ExerciseModel();
        $exercise->name = "name 1";
        $exercise->images = "img 1";
        $exercise->video = "video 1";
        $exercise->description = "description 1";
        
        $dataContext->insert($exercise);
        
        $result = $dataContext->loadAll(ExerciseModel::class);
        $first = $result->first();
        
        $id = $first->id;
        $first->name = "name 1222";
        $dataContext->update($first);
        
        $changed = $dataContext->loadByPrimaryKey(ExerciseModel::class, $id)->first();
        //$exeUpdate = current(ExerciseModel::loadByPrimaryKey($first->id));
        print_r($changed);

    }
    
}

$test = new Test();
$test->testExcercise2();

?>