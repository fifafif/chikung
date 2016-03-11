<?php

class ExerciseVariationEntity extends FModelObject
{
    protected $tableName = 'exerciseVariation';
    protected $dataTypes = array('id' => 0, 'day_id' => 0, 'exercise_id' => 0, 'time' => 0, 'name' => 2, 'description' => 0);
}
?>