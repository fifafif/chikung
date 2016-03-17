<?php

//require_once dirname(__FILE__) . '/../config/Settings.php';

require_once dirname(__FILE__) . '/../../../../core/forms/FFormValidation.php';

define('SMARTY_DIR',str_replace("\\","/",dirname(__FILE__)).'/../../../../plugins/smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');

/**
 * Description of BaseController
 *
 * @author XiXao
 */
class BaseController
{
    /* @var $controller FController  */
    protected $controller;
    protected $smarty;
    protected $template;
    
    public function __construct()
    {
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir(dirname(__FILE__) . '/../view/templates/');
        $this->smarty->setCompileDir(dirname(__FILE__) . '/../view/templates_c/');
        $this->smarty->setConfigDir(dirname(__FILE__) . '/../view/configs/');
        $this->smarty->setCacheDir(dirname(__FILE__) . '/../view/cache/');

        $this->smarty->assign('name','Ned');

        //** un-comment the following line to show the debug console
        $this->smarty->debugging = true;
        
        $this->controller = FController::getInstance();
    }
    
    protected function assignBase()
    {
        $user = $this->controller->getUser();
        $this->assignByRef('user', $user);
        
        $this->assign('root', FConfigBase::$config['root']);
        
        $this->assign('title', "Chikung");
        
        $messages = &$this->controller->getMessages();
        $this->assignByRef('messages', $messages->getMessages());
    }
    
    protected function fetchViewOutput()
    {
        return $this->smarty->fetch('index.tpl');
    }
    
    protected function fetchView($template)
    {
        return $this->smarty->fetch($template . ".tpl");
    }
    
    protected function setTemplate($template)
    {
        $this->smarty->assign('template', $template);
    }
    
    protected function assign($key, $value)
    {
        $this->smarty->assign($key, $value);
    }
    
    protected function assignByRef($key, &$value)
    {
        $this->smarty->assignByRef($key, $value);
    }
    
    protected function fetchViewToResponse($view, $template)
    {
        $this->assignBase();
        $this->setTemplate($template);        
                
        return new FResponse($this->fetchView($view));
    }

}

?>
