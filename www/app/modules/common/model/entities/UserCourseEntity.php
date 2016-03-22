<?php

class UserCourseEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_user_id_course_id = 'user_id-course_id';
    const INDEX_user_id = 'user_id';
    const INDEX_course_id = 'course_id';


    protected static $indexFields = array(
        'id' => array( 'id' ),
        'user_id-course_id' => array( 'user_id', 'course_id' ),
        'user_id' => array( 'user_id' ),
        'course_id' => array( 'course_id' ));

    public $id;
    public $user_id;
    public $user = null;
    public $course_id;
    public $course = null;
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