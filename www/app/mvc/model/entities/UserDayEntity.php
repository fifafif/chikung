<?php

class UserDayEntity extends FModelObject
{
    protected $tableName = 'userDay';
    protected $dataTypes = array('id' => 0, 'user_id' => 0, 'day_id' => 0, 'completed' => 0, 'effectiveDate' => 0);
}
?>