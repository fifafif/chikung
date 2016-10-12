<?php

class C1userProgressEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_user_id = 'user_id';
    const INDEX_user_id_c1day_id = 'user_id-c1day_id';
    const INDEX_c1day_id = 'c1day_id';

    const FIELD_id = 'id';
    const FIELD_user_id = 'user_id';
    const FIELD_c1day_id = 'c1day_id';
    const FIELD_state = 'state';
    const FIELD_completedOn = 'completedOn';

    public $id;
    public $user_id;
    public $user = null;
    public $c1day_id;
    public $c1day = null;
    public $state;
    public $completedOn;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'user_id' => array (0, false, 1, NULL, false), 
        'c1day_id' => array (0, false, 1, NULL, false), 
        'state' => array (0, false, 1, NULL, false), 
        'completedOn' => array (3, false, 1, NULL, false));

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'user_id' => array( 'user_id' ),
        'user_id-c1day_id' => array( 'user_id', 'c1day_id' ),
        'c1day_id' => array( 'c1day_id' ));

    public static $tableName = 'c1userProgress';

    public static function getTableName() { return self::$tableName; }

}
?>