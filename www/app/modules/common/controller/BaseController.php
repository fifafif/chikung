<?php

//require_once dirname(__FILE__) . '/../config/Settings.php';


require_once dirname(__FILE__) . '/../../../core/forms/FFormValidation.php';
require_once dirname(__FILE__) . '/../../../core/database/DataContext.php';



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
    protected $dataContext;
    
    public function __construct()
    {
        $this->controller = FController::getInstance();
        $this->dataContext = $this->controller->getModel()->getDataContext();
    }
    
    protected function includeSmarty($moduleDir)
    {
        define('SMARTY_DIR',str_replace("\\","/",dirname(__FILE__)).'/../../../plugins/smarty/');
        require_once(SMARTY_DIR . 'Smarty.class.php');
        
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir($moduleDir . 'view/templates/');
        $this->smarty->setCompileDir($moduleDir . 'view/templates_c/');
        $this->smarty->setConfigDir($moduleDir . 'view/configs/');
        $this->smarty->setCacheDir($moduleDir . 'view/cache/');
        
        $this->controller->getFlink()->registerSmarty($this->smarty);

        //** un-comment the following line to show the debug console
        $this->smarty->debugging = true;
    }
    
    protected function assignBase()
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        $user = $this->controller->getUser();
        $this->assignByRef('user', $user);
        
        $this->assign('root', FConfigBase::$config['root']);
        
        $this->assign('title', "Chikung");
        
        $messages = &$this->controller->getMessages();
        $this->assignByRef('messages', $messages->getMessages());
    }
    
    protected function fetchViewOutput()
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        return $this->smarty->fetch('index.tpl');
    }
    
    protected function fetchView($template)
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        return $this->smarty->fetch($template . ".tpl");
    }
    
    protected function setTemplate($template)
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        $this->smarty->assign('template', $template);
    }
    
    protected function assign($key, $value)
    {
        $this->smarty->assign($key, $value);
    }
    
    protected function assignByRef($key, &$value)
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        $this->smarty->assignByRef($key, $value);
    }
    
    protected function fetchViewToResponse($view, $template)
    {
        if (!isset($this->smarty))
        {
            return null;
        }
        
        $this->assignBase();
        $this->setTemplate($template);        
                
        return new FResponse($this->fetchView($view));
    }
}

?>
