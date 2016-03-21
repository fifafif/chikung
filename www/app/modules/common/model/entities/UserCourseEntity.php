<?php

class UserCourseEntity extends FModelObject
{
    const INDEX_id = 'id';

    public $id;
    public $user_id;
    public $course_id;
    public $status;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'user_id' => array (0, false, 1, NULL, false), 
        'course_id' => array (0, false, 1, NULL, false), 
        'status' => array (0, false, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'userCourse';

}
?>