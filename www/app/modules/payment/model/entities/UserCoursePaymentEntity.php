<?php

class UserCoursePaymentEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_userCourse_id = 'userCourse_id';
    const INDEX_symbol = 'symbol';

    const FIELD_id = 'id';
    const FIELD_userCourse_id = 'userCourse_id';
    const FIELD_symbol = 'symbol';
    const FIELD_created = 'created';
    const FIELD_status = 'status';

    public $id;
    public $userCourse_id;
    public $userCourse = null;
    public $symbol;
    public $created;
    public $status;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'userCourse_id' => array (0, false, 1, NULL, false), 
        'symbol' => array (0, false, 1, NULL, false), 
        'created' => array (3, false, 1, NULL, false), 
        'status' => array (0, false, 1, NULL, false));

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'userCourse_id' => array( 'userCourse_id' ),
        'symbol' => array( 'symbol' ));

    public static $tableName = 'userCoursePayment';

    public static function getTableName() { return self::$tableName; }

}
?>