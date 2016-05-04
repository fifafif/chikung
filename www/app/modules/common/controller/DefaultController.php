<?php

require_once dirname(__FILE__) . '/../../common/controller/BaseController.php';

class DefaultController extends BaseController
{
    public function defaultHandler($data = null)
    {
        $this->includeSmartySimple();
        
        return $this->fetchViewToResponse('index', 'default');
    }
    
    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../';
    }
}
