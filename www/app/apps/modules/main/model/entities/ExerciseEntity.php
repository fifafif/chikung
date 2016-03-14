<?php

class ExerciseEntity extends FModelObject
{
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_DESCRIPTION = 'description';
    const FIELD_VIDEO = 'video';
    const FIELD_IMAGES = 'images';

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, false), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, false, 1, NULL, false), 
        'video' => array (2, false, 1, NULL, false), 
        'images' => array (2, false, 1, NULL, false));

    public function getTableName() { return 'exercise'; }

}
?>