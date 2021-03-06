<?php

class UserCourseEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_user_id_course_id = 'user_id-course_id';
    const INDEX_user_id = 'user_id';
    const INDEX_course_id = 'course_id';
    const INDEX_user_id_course_id_status = 'user_id-course_id-status';
    const INDEX_user_id_status = 'user_id-status';

    const FIELD_id = 'id';
    const FIELD_user_id = 'user_id';
    const FIELD_course_id = 'course_id';
    const FIELD_status = 'status';

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

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'user_id-course_id' => array( 'user_id', 'course_id' ),
        'user_id' => array( 'user_id' ),
        'course_id' => array( 'course_id' ),
        'user_id-course_id-status' => array( 'user_id', 'course_id', 'status' ),
        'user_id-status' => array( 'user_id', 'status' ));

    public static $tableName = 'userCourse';

    public static function getTableName() { return self::$tableName; }

}
?>