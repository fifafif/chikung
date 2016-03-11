<?php

class ExerciseEntity extends FModelObject
{
    protected $tableName = 'exercise';
    protected $dataTypes = array('id' => 0, 'name' => 2, 'description' => 0, 'video' => 2, 'images' => 2);
}
?>