<?php

class UserDataEntity extends FModelObject
{
    protected $tableName = 'userData';
    protected $dataTypes = array('user_id' => 0, 'exerciseCompleted' => 2, 'alarmTimes' => 2, 'hasStarted' => 0, 'startDate' => 0);
}
?>