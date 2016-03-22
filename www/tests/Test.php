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
        
        print_r($exercise);
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
        
        print_r($changed);
    }
    
    public function testLoadByIndex()
    {
        require_once dirname(__FILE__) . '/../app/modules/common/model/entities/UserCourseEntity.php';
        require_once dirname(__FILE__) . '/../app/core/database/DataContext.php';
        
        $dataContext = new DataContext($this->db);
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = 1;
        $userCourse->course_id = 1;
//        $dataContext->insert($userCourse);
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = 2;
        $userCourse->course_id = 1;        
//        $dataContext->insert($userCourse);
        
        $result = $dataContext->loadByIndex(UserCourseEntity::class, UserCourseEntity::INDEX_user_id_course_id, 1, 5);
        $first = $result->first();
        
        print_r($first);
    }
    
    public function testLoadByMultiKey()
    {
        require_once dirname(__FILE__) . '/../app/modules/common/model/entities/UserCourseEntity.php';
        require_once dirname(__FILE__) . '/../app/core/database/DataContext.php';
        
        $dataContext = new DataContext($this->db);
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = 1;
        $userCourse->course_id = 1;
//        $dataContext->insert($userCourse);
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = 2;
        $userCourse->course_id = 1;        
//        $dataContext->insert($userCourse);
        
        $result = $dataContext->loadByMultiKey(UserCourseEntity::class, UserCourseEntity::INDEX_user_id, array(1, 2));
        
        print_r($result);
    }
    
    public function testJoin()
    {
        require_once dirname(__FILE__) . '/../app/modules/common/model/entities/UserCourseEntity.php';
        require_once dirname(__FILE__) . '/../app/core/database/DataContext.php';
        require_once dirname(__FILE__) . '/../app/core/user/FUser.php';
        
        $dataContext = new DataContext($this->db);
        
        $usersData = $dataContext->loadAll(UserEntity::class);
        $userCoursesData = $dataContext->loadAll(UserCourseEntity::class);
        
        $userCoursesData->join($usersData, UserCourseEntity::INDEX_user_id);
        
        print_r($userCoursesData);
    }
    
    public function testToLookup()
    {
        require_once dirname(__FILE__) . '/../app/modules/common/model/entities/UserCourseEntity.php';
        require_once dirname(__FILE__) . '/../app/core/database/DataContext.php';
        require_once dirname(__FILE__) . '/../app/core/user/FUser.php';
        
        $dataContext = new DataContext($this->db);
        
        $userCourses = $dataContext->loadAll(UserCourseEntity::class)->toLookup(UserCourseEntity::INDEX_user_id);
        
        self::printData($userCourses);
    }
    
    public static function printData($data)
    {
        print "<pre>";
        print_r($data);
        print "</pre>";
    }
}

$test = new Test();
$test->testToLookup();

?>