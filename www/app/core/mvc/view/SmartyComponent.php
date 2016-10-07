<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SmartyComponent
 *
 * @author Purchaser
 */
class SmartyComponent
{
    protected $smarty;
    
    public function __construct($viewModuleDir)
    {
        $this->includeSmartyOneFolder($viewModuleDir);
    }
    
    /*protected function includeSmartySimple()
    {
        $this->includeSmartyOneFolder($this->getPathToView());
    }
    
    public function init($moduleDir)
    {
        $this->includeSmartyOneFolder($moduleDir);
    }*/
    
    protected function includeSmartyOneFolder($moduleDir)
    {
        $this->includeSmarty($moduleDir, '', 'smarty/templates_c/', 'smarty/configs/', 'smarty/cache/');
    }
    
    protected function includeSmarty($moduleDir, $templatesDir = 'templates/', $compileDir = 'templates_c/', $configDir = 'configs/', $cacheDir = 'cacheDir/')
    {
        define('SMARTY_DIR',str_replace("\\","/",dirname(__FILE__)).'/../../../plugins/smarty/');
        require_once(SMARTY_DIR . 'Smarty.class.php');
        require_once(dirname(__FILE__) . '/SmartyBinder.php');
        
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir($moduleDir . 'view/' . $templatesDir);
        $this->smarty->setCompileDir($moduleDir . 'view/' . $compileDir);
        $this->smarty->setConfigDir($moduleDir . 'view/' . $configDir);
        $this->smarty->setCacheDir($moduleDir . 'view/' . $cacheDir);
        
        $smartyBinder = new SmartyBinder();
        $smartyBinder->register($this->smarty);

        $this->smarty->debugging = true;
    }
    
    public function assignBasic(FController $controller, $title = "title")
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        $user = $controller->getUser();
        $this->assignByRef('user', $user);
        
        $this->assign('root', FConfigBase::$config['root']);
        
        $this->assign('title', $title);
        
        $messages = $controller->getMessages()->getMessages();
        $this->assignByRef('messages', $messages);
    }
    
    public function fetchViewOutput()
    {
        if (!isset($this->smarty))
        {
            return;
        }
        
        return $this->smarty->fetch('index.tpl');
    }
    
    public function fetchView($template)
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
    
    public function assign($key, $value)
    {
        $this->smarty->assign($key, $value);
    }
    
    public function assignByRef($key, &$value)
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
    public function fetchViewToResponse($view, $template)
    {
        if (!isset($this->smarty))
        {
            return null;
        }
        
        FDebug::log("Fetching view: [$view] template: [$template]", FDebugChannel::VIEW);
        
        //$this->assignBase();
        $this->setTemplate($template);        
                
        return new FResponse($this->fetchView($view));
    }
}
