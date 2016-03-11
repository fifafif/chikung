<?php

class UserEntity extends FModelObject
{
    protected $tableName = 'user';
    protected $dataTypes = array('id' => 0, 'username' => 2, 'email' => 2, 'password' => 2, 'accessToken' => 2, 'createDate' => 0);
}
?>