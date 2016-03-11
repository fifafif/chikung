<?php

class UserGoalEntity extends FModelObject
{
    protected $tableName = 'userGoal';
    protected $dataTypes = array('id' => 0, 'user_id' => 0, 'priority' => 0, 'type' => 0, 'title' => 2);
}
?>