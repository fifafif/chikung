<?php

class C1exerciseEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_c1day_id = 'c1day_id';

    const FIELD_id = 'id';
    const FIELD_c1day_id = 'c1day_id';
    const FIELD_name = 'name';
    const FIELD_description = 'description';
    const FIELD_video = 'video';
    const FIELD_type = 'type';

    public $id;
    public $c1day_id;
    public $c1day = null;
    public $name;
    public $description;
    public $video;
    public $type;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'c1day_id' => array (0, false, 1, NULL, false), 
        'name' => array (2, false, 1, NULL, false), 
        'description' => array (2, false, 1, NULL, false), 
        'video' => array (2, false, 1, NULL, false), 
        'type' => array (0, false, 1, NULL, false));

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'c1day_id' => array( 'c1day_id' ));

    public static $tableName = 'c1exercise';

    public static function getTableName() { return self::$tableName; }

}
?>