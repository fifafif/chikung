<?php

class ExerciseEntity extends FModelObject
{
    const INDEX_id = 'id';


    protected static $indexFields = array(
        'id' => array( 'id' ));

    public $id;
    public $name;
    public $description;
    public $video;
    public $images;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, false, 1, NULL, false), 
        'video' => array (2, false, 1, NULL, false), 
        'images' => array (2, false, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'exercise';

}
?>