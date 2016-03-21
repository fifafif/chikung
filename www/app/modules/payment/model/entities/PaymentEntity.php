<?php

class PaymentEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_user_id = 'user_id';

    public $id;
    public $user_id;
    public $author_id;
    public $method;
    public $paymentDate;
    public $amount;
    public $symbol;

    protected static $dataTypes = array(
        'id' => array (0, false, 2, NULL, true), 
        'user_id' => array (0, false, 1, NULL, false), 
        'author_id' => array (0, false, 1, NULL, false), 
        'method' => array (0, false, 1, NULL, false), 
        'paymentDate' => array (3, false, 1, NULL, false), 
        'amount' => array (1, false, 1, NULL, false), 
        'symbol' => array (0, false, 1, NULL, false));

    public static function getTableName() { return self::$tableName; }
    public static $tableName = 'payment';

}
?>