<?php

require_once dirname(__FILE__) . '/../BaseController.php';
require_once dirname(__FILE__) . '/../../../../../core/forms/FFormValidation.php';

class AdminController extends BaseController
{
    public function defaultHandler()
    {
        if (!$this->controller->requireAdmin())
        {
            return new FResponse("need admin!");
        }
        
        return $this->fetchViewToResponse('admin/index.tpl', 'default');
    }
}
