<?php

require_once dirname(__FILE__) . '/../../common/controller/BaseController.php';


/**
 * Description of DefaultController
 *
 * @author XiXao
 */
class DefaultController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function defaultHandler($data = null)
    {
        $this->includeSmarty(dirname(__FILE__) . '/../');
        
        return $this->fetchViewToResponse('index', 'default');
    }
}
