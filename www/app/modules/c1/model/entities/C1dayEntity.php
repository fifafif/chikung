<?php

class C1dayEntity extends FModelObject
{
    const INDEX_id = 'id';


    protected static $indexFields = array(
        'id' => array( 'id' ));

    public $id;
    public $order;
    public $name;
    public $description;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'order' => array (0, false, 1, NULL, false), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, false, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'c1day';

}
?>