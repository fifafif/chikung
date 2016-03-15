<?php


class Data
{
    public static $schema = array ( 'id' => 1);
    public static $schema2 = array ( 'id' => array ( 'type' => 1 ));
    
    public $values = array();
    
    public $id = 5;
    
    public function getId()
    {
        
    }
    
    public function getValue($name)
    {
        
    }
    
    public function getType($key)
    {
        return self::$schema[$key];
    }
    
    public function __construct()
    {
    }
    
    
}


$variable = 'id';
$data = new Data();

$data->$variable = 55;

echo $data->$variable;

//echo $data->getType($data->id);


//phpinfo();
exit();
$a = null;
$b;
$c = array();
$c['q'] = 1;
$c['u'] = 1;

echo count($c);

exit(0);

require_once 'app/core/database/FQuery.php';


$q = FQuery::getInstance();

$q->create()
        ->select('u.name','u.login')
        ->from('users', 'u')
        ->where('u.username = ', 'use123!@##$%^%&**()"::;rName', FQueryParam::STRING)
        ->whereAnd('u.email <>', 'wer@wer.cz', FQueryParam::FLOAT)
        ->limit(4, 10);

echo $q->getQuery();

?>
