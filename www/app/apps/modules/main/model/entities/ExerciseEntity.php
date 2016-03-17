<?php

class ExerciseEntity extends FModelObject
{
    const KEY_ID = 'id';
    
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

    public static $tableName = 'exercise';

}
?>