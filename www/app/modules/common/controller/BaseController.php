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
    
    public function __construct(FController $controller)
    {
        $this->controller = $controller;
        $this->dataContext = $this->controller->getModel()->getDataContext();
    }
    
    protected function getUserId()
    {
        return $this->controller->getUser()->id;
    }
    
    protected function getPathToView()
    {
        throw new Exception('getPathToView() function has to be overriden!');
    }
    
    protected function includeSmartySimple()
    {
        $this->includeSmartyOneFolder($this->getPathToView());
    }
    
    protected function includeSmartyOneFolder($moduleDir)
    {
        $this->includeSmarty($moduleDir, '', 'smarty/templates_c/', 'smarty/configs/', 'smarty/cache/');
    }
    
    protected function includeSmarty($moduleDir, $templatesDir = 'templates/', $compileDir = 'templates_c/', $configDir = 'configs/', $cacheDir = 'cacheDir/')
    {
        define('SMARTY_DIR',str_replace("\\","/",dirname(__FILE__)).'/../../../plugins/smarty/');
        require_once(SMARTY_DIR . 'Smarty.class.php');
        require_once(dirname(__FILE__) . '/../../../core/mvc/view/SmartyBinder.php');
        
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir($moduleDir . 'view/' . $templatesDir);
        $this->smarty->setCompileDir($moduleDir . 'view/' . $compileDir);
        $this->smarty->setConfigDir($moduleDir . 'view/' . $configDir);
        $this->smarty->setCacheDir($moduleDir . 'view/' . $cacheDir);
        
        $smartyBinder = new SmartyBinder();
        $smartyBinder->register($this->smarty);

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
    
    /**
     * Assign templates to Smarty and returns FResponse with rendered HTML
     * 
     * @param type $view Base template (Index.tpl)
     * @param type $template Actual subpage template (Users.tpl)
     * @return \FResponse Rendered HTML
     */
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
