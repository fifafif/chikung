<?php

class UserEntity extends FModelObject
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $accessToken;
    public $createDate;
    public $role;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'username' => array (2, false, 1, NULL, false), 
        'email' => array (2, false, 1, NULL, false), 
        'password' => array (2, false, 1, NULL, false), 
        'accessToken' => array (2, false, 1, NULL, false), 
        'createDate' => array (3, false, 1, NULL, false), 
        'role' => array (0, false, 1, NULL, false));

    public static $tableName = 'user';

}
?>