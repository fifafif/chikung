<?php

require_once dirname(__FILE__) . '/app/core/utils/FDebug.php';
require_once dirname(__FILE__) . '/app/core/utils/FPerf.php';

FPerf::start('framework');

require_once dirname(__FILE__) . '/app/core/FController.php';

session_start();

FDebug::setLogToFile(true);
FDebug::setLogFileName(dirname(__FILE__) . '/../logs/log.txt');
FDebug::setEnabled(isset($_REQUEST['debug']));
//FDebug::setEnabled(true);

FDebug::log("=== Begin request ===", FDebugChannel::NET);

$controller = FController::getInstance();
$controller->handleRequest();

FDebug::log("=== End request === Total time [ms]: " . FPerf::end('framework'), FDebugChannel::SYSTEM);

/*$controller = FController::getInstance();
$controller->setLanguage('cs_CZ.UTF-8');
*/

?>