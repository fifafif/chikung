<?php

require_once dirname(__FILE__) . '/BaseController.php';

class DefaultController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function defaultHandler($data = null)
    {
        $this->assignBase();
        
        $this->setTemplate('default');
        
        $output = $this->fetchViewOutput();
        
        return new FResponse($output);
    }
}
