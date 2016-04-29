<?php

class LinkParams
{
//    const TYPE_HREF = 0;
//    const TYPE_FORM = 1;
//    
//    public $type;

    public $module;
    public $controller;
    public $handler;
    public $gate;
    public $args;
}

/**
 * Description of FLink
 *
 * @author XiXao
 */
class FLink
{
    const TYPE_UGLY = 0;
    const TYPE_NICE = 1;
    
    private $controllerPath = '';
    private static $instance;
    private $type;
    private $root;
    
    function __construct($root = '/', $type = self::TYPE_UGLY)
    {
        $this->type = $type;
        $this->root = $root;
        
        self::$instance = $this;
    }
    
    function setControllerPath($controllerPath)
    {
        $this->controllerPath = $controllerPath;
    }

        
    public static function getInstance()
    {
        return self::$instance;
    }

    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function setRoot($root)
    {
        $this->root = $root;
    }
    
    public function printLink(LinkParams $link)
    {
        $htmlLink = '';
        
        switch ($this->type)
        {
            case self::TYPE_NICE:
                
                $htmlLink = $this->printNice($link);
                break;
                
            default:
                
                $htmlLink = $this->printUgly($link);
                break;
        }
        
        return $htmlLink;
    }
    
    public function decodeAndPrint($link, $args)
    {
        $linkParams = $this->createLinkParams($link, $args);
        
        return $this->printLink($linkParams);
    }
    
    private function printUgly(LinkParams $link)
    {
        $args = '';
        
        if (is_array($link->args))
        {
            foreach ($link->args as $key => $value)
            {
                $args .= "&$key=$value";
            }
        }
        
        return $this->root . "index.php?"
                . (isset($link->module) ? "m=$link->module&" : '')
                . "c=$link->controller&h=$link->handler"
                . (isset($link->gate) ? "&g=$link->gate" : '')
                . $args;
    }
    
    private function printNice($controller, $handler, $args)
    {
        return "index.php/$controller/$handler";
    }
    
    public function createLinkParams($link, $args)
    {
        $linkParams = new LinkParams();
        
        $linkArray = explode(':', $link);
        
        if (count($linkArray) == 2)
        {
            $linkParams->controller = $linkArray[0];
            $linkParams->handler = $linkArray[1];
        }
        else if (count($linkArray) == 3)
        {
            $linkParams->module = $linkArray[0];
            $linkParams->controller = $linkArray[1];
            $linkParams->handler = $linkArray[2];
        }
        else if (count($linkArray) == 4)
        {
            $linkParams->module = $linkArray[0];
            $linkParams->gate = $linkArray[1];
            $linkParams->controller = $linkArray[2];
            $linkParams->handler = $linkArray[3];
        }
        else
        {
            return false;
        }
        
        $linkParams->args = $args;
        
        return $linkParams;
    }
    
    public function registerSmarty(Smarty $smarty)
    {
        $smarty->registerPlugin('function', 'a', 'FLink::printSmartyLink');
        $smarty->registerPlugin('function', 'form', 'FLink::printSmartyForm');
    }
    
    public static function printSmartyLink($params, $smarty)
    {
        $flink = FLink::getInstance();

        if (isset($params['href']))
        {
            $link = $params['href'];
            unset($params['href']);
        }
        else
        {
 
        }
        
        return 'a href="' . $flink->decodeAndPrint($link, $params) . '"';
    }
    
    public static function printSmartyForm($params, $smarty)
    {
        $flink = FLink::getInstance();

        $link = $params['action'];
        unset($params['action']);
        
        return 'form action="' . $flink->decodeAndPrint($link, $params) . '"';
    }
    
    public static function printLinkFromParams($link, $params = null)
    {
        $flink = FLink::getInstance();
        
        return $flink->decodeAndPrint($link, $params);
    }
    
    public function getModulePath($moduleName)
    {
        return $this->controllerPath . '/../modules/' . FConfigBase::getModulePath($moduleName);
    }
}