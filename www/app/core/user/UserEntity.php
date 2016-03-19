<?php

class UserEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_email = 'email';
    const INDEX_username = 'username';
    const INDEX_accessToken = 'accessToken';

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

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'user';

}
?>