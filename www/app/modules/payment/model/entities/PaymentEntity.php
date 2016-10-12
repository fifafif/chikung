<?php

class PaymentEntity extends FModelObject
{
    const INDEX_id = 'id';
    const INDEX_user_id = 'user_id';

    const FIELD_id = 'id';
    const FIELD_user_id = 'user_id';
    const FIELD_author_id = 'author_id';
    const FIELD_method = 'method';
    const FIELD_paymentDate = 'paymentDate';
    const FIELD_amount = 'amount';
    const FIELD_symbol = 'symbol';

    public $id;
    public $user_id;
    public $user = null;
    public $author_id;
    public $author = null;
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

    protected static $indexFields = array(
        'id' => array( 'id' ),
        'user_id' => array( 'user_id' ));

    public static $tableName = 'payment';

    public static function getTableName() { return self::$tableName; }

}
?>