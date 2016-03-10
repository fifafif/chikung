<?php

//echo "kuku";
//exit(0);

require_once dirname(__FILE__) . '/app/core/utils/FDebug.php';
require_once dirname(__FILE__) . '/app/core/FController.php';

session_start();

FDebug::setEnabled(isset($_REQUEST['debug']));
//FDebug::setEnabled(true);

$controller = FController::getInstance();
$controller->handleRequest();

/*$controller = FController::getInstance();
$controller->setLanguage('cs_CZ.UTF-8');
*/

/*
$controller->loadPageController();
$controller->displayIndex();
*/
?>