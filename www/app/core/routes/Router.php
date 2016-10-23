<?php

class Route
{
    public $module;
    public $controller;
    public $handler;
    public $gate;
    public $params;
    public $pattern;
    
    function __construct($module, $controller, $handlers, $gate, $params, $pattern)
    {
        $this->module = $module;
        $this->controller = $controller;
        $this->handler = $handlers;
        $this->gate = $gate;
        $this->params = $params;
        $this->pattern = $pattern;
    }

}

class Router
{
    private $routes;
    private $foundRoute;
    
    
    function __construct()
    {
    }
    
    function getFoundRoute()
    {
        return $this->foundRoute;
    }
    
    public function addRoute($pattern, $link)
    {
        $linkParams = FLink::createLinkParams($link, null);
        
        $route = new Route($linkParams->module, $linkParams->controller, $linkParams->handler, $linkParams->gate, null, $pattern);
        $this->routes[$link] = $route;
        
        return $this;
    }
    
    public function findRoute($url)
    {
        foreach ($this->routes as $route)
        {
            $urlParams = null;
            
            if ($this->isUrlMatching($route->pattern, $url, $urlParams))
            {
                $this->foundRoute = $route;
                
                $route->params = $urlParams;

                return;
            }
        }
        
        if (!isset($this->foundRoute))
        {
            FDebug::log('Route not found! Url: ' . $url, FDebugChannel::SERVICE);
        }
    }
    
    public function getRouteByLink($link)
    {
        if (!isset($this->routes[$link]))
        {
            return null;
        }
        
        return $this->routes[$link];
    }
    
    private function isUrlMatching($pattern, $url, &$urlParams)
    {
        $pos1 = 0;
        $pos2 = 0;
        $strLen1 = strlen($url);
        $strLen2 = strlen($pattern);
        $insidePattern = false;
        $insideUrl = false;
        $varEndChar = '';
        
        $urlParams = array();
        $patternVariable = '';
        $variable = '';
        
        $hasMore1 = $pos1 < $strLen1;
        $hasMore2 = $pos2 < $strLen2;
        
        while($hasMore1 && ($hasMore2 || $insideUrl))
        {
            $char1 = $url[$pos1];
            
            if ($hasMore2)
            {
                $char2 = $pattern[$pos2];
            }
            
            if ($insidePattern)
            {
                ++$pos2;
                
                if ($char2 == '}')
                {
                    $insidePattern = false;
                    $insideUrl = true;
                    
                    if ($pos2 < $strLen2)
                    {
                        $varEndChar = $pattern[$pos2];
                        
                        ++$pos2;
                    }
                }
                else
                {
                    $patternVariable .= $char2;
                }
            }
            else if ($insideUrl)
            {
                ++$pos1;
                
                if ($char1 == $varEndChar)
                {
                    $insideUrl = false;
                    
                    $urlParams[$patternVariable] = $variable;
                }
                else if ($pos1 == $strLen1)
                {
                    $variable .= $char1;
                    
                    $insideUrl = false;
                    
                    $urlParams[$patternVariable] = $variable;
                }
                else
                {
                    $variable .= $char1;
                }
            }
            else if ($char1 == $char2)
            {
                ++$pos1;
                ++$pos2;
            }
            else if ($char2 == '{')
            {
                $insidePattern = true;
                
                $variable = '';
                $patternVariable = '';
                
                ++$pos2;
            }
            else
            {
                return false;
            }
            
            $hasMore1 = $pos1 < $strLen1;
            $hasMore2 = $pos2 < $strLen2;
        }
        
        if ($hasMore1 || $hasMore2)
        {
            return false;
        }
        
        return true;
    }
    
    public function getUrl($path)
    {
        return $path;
    }
}