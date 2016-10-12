<?php

class UserEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_email = 'email';
    const INDEX_username = 'username';
    const INDEX_accessToken = 'accessToken';
    const INDEX_id_username = 'id-username';

    const FIELD_id = 'id';
    const FIELD_username = 'username';
    const FIELD_email = 'email';
    const FIELD_password = 'password';
    const FIELD_accessToken = 'accessToken';
    const FIELD_createDate = 'createDate';
    const FIELD_role = 'role';

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

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'email' => array( 'email' ),
        'username' => array( 'username' ),
        'accessToken' => array( 'accessToken' ),
        'id-username' => array( 'id', 'username' ));

    public static $tableName = 'user';

    public static function getTableName() { return self::$tableName; }

}
?>