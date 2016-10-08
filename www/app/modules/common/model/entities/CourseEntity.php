<?php

class CourseEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_CourseKey = 'CourseKey';


    protected static $indexFields = array(
        'id' => array( 'id' ),
        'CourseKey' => array( 'courseKey' ));

    public $id;
    public $courseKey;
    public $name;
    public $description;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'courseKey' => array (2, false, 1, NULL, false), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, true, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'course';

}
?>