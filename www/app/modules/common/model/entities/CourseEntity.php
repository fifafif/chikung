<?php

class CourseEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_CourseKey = 'CourseKey';

    const FIELD_id = 'id';
    const FIELD_courseKey = 'courseKey';
    const FIELD_name = 'name';
    const FIELD_description = 'description';

    public $id;
    public $courseKey;
    public $name;
    public $description;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'courseKey' => array (2, false, 1, NULL, false), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, true, 1, NULL, false));

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'CourseKey' => array( 'courseKey' ));

    public static $tableName = 'course';

    public static function getTableName() { return self::$tableName; }

}
?>