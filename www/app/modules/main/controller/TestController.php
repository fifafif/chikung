<?php

require_once dirname(__FILE__) . '/BaseController.php';

class TestController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function testHandler($request)
    {
        
        $output = $this->fetchViewOutput();
        
        return new FResponse($output);
    }
    //put your code here
}
