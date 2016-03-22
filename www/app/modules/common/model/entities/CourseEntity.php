<?php

class CourseEntity extends FModelObject
{
    const INDEX_id = 'id';


    protected static $indexFields = array(
        'id' => array( 'id' ));

    public $id;
    public $name;
    public $description;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, true, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'course';

}
?>