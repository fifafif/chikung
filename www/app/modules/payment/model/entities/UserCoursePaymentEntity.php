<?php

class UserCoursePaymentEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_userCourse_id = 'userCourse_id';
    const INDEX_symbol = 'symbol';

    public $id;
    public $userCourse_id;
    public $symbol;
    public $created;
    public $status;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'userCourse_id' => array (0, false, 1, NULL, false), 
        'symbol' => array (0, false, 1, NULL, false), 
        'created' => array (3, false, 1, NULL, false), 
        'status' => array (0, false, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'userCoursePayment';

}
?>