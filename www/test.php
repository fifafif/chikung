<?php

//phpinfo();
//exit();
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
