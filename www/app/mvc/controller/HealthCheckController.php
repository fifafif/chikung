<?php

require_once dirname(__FILE__) . '/BaseController.php';
/**
 * Description of HealthCheckController
 *
 * @author XiXao
 */
class HealthCheckController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
    
    public function checkHandler($data)
    {
        $responseData = array();
        $responseData['result'] = 1;
        $responseData['time'] = time();
        
        return new ResponseDataJson(0, json_encode($responseData, JSON_FORCE_OBJECT));
    }
}

?>
