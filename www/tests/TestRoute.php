<?php

require_once dirname(__FILE__) . '/../app/core/routes/Router.php';
require_once dirname(__FILE__) . '/../app/core/routes/Flink.php';

//$url = '/course';
//$url = '/course/day-1';
$url = '/course/day-1-ex-66';

$router = new Router();
$router->addRoute('/course/admin', 'c1:Course:admin:default')
        ->addRoute('/course', 'c1:Course:default')
        ->addRoute('/course/day-{id}-ex-{exId}', 'c1:Course:showDayAndEx')
        ->addRoute('/course/day-{id}', 'c1:Course:showDay');

$router->findRoute($url);
        

print_r($router->getFoundRoute());
