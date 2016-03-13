<?php

require_once dirname(__FILE__) . '/app/core/utils/FDebug.php';
require_once dirname(__FILE__) . '/app/core/FController.php';

session_start();

FDebug::setLogToFile(true);
FDebug::setLogFileName(dirname(__FILE__) . '/../logs/log.txt');
FDebug::setEnabled(isset($_REQUEST['debug']));
//FDebug::setEnabled(true);

$controller = FController::getInstance();
$controller->handleRequest();

/*$controller = FController::getInstance();
$controller->setLanguage('cs_CZ.UTF-8');
*/

?>