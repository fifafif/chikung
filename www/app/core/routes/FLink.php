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
    private $router;
    
    function __construct($root = '/', $type = self::TYPE_UGLY)
    {
        $this->type = $type;
        $this->root = $root;
        
        self::$instance = $this;
    }
    
    function setRouter($router)
    {
        $this->router = $router;
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
    
    /*public function decodeAndPrint($link, $args)
    {
        $linkParams = self::createLinkParams($link, $args);
        
        return $this->printLink($linkParams);
    }*/
    
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
    
    public function decodeAndPrint($link, $args)
    {
        $htmlLink = '';
        
        switch ($this->type)
        {
            case self::TYPE_NICE:
                
                $htmlLink = $this->printNice($link, $args);
                break;
                
            default:
                
                $linkParams = self::createLinkParams($link, $args);
                $htmlLink = $this->printUgly($linkParams);
                break;
        }
        
        return $htmlLink;
    }
    
    private function printNice($link, $args)
    {
        if (!isset($this->router))
        {
            $linkParams = self::createLinkParams($link, $args);
            return $this->printUgly($linkParams);
        }
        
        $route = $this->router->getRouteByLink($link);
        
        if ($route == null)
        {
            $linkParams = self::createLinkParams($link, $args);
            return $this->printUgly($linkParams);
        }
        
        // Swap patters with args
        $pattern = $route->pattern;
        
        if (is_array($args))
        {
            foreach ($args as $key => $value)
            {
                $pattern = str_replace('{' . $key . '}', $value, $pattern);
            }    
        }
        
        return $this->root . ltrim($pattern, '/');
    }
    
    public static function createLinkParams($link, $args)
    {
        $linkParams = new LinkParams();
        
        $linkArray = explode(':', $link);
        
        $paramCount = count($linkArray);
        
        if ($paramCount == 2)
        {
            $linkParams->controller = $linkArray[0];
            $linkParams->handler = $linkArray[1];
        }
        else if ($paramCount == 3)
        {
            $linkParams->module = $linkArray[0];
            $linkParams->controller = $linkArray[1];
            $linkParams->handler = $linkArray[2];
        }
        else if ($paramCount == 4)
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