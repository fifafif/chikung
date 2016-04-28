<?php


class FRedirect implements IResponseable
{
    private $redirectUrl;
    
    function __construct($redirectUrl = '', $includeRoot = true)
    {
        $this->redirectUrl = ($includeRoot ? FConfigBase::$config['root'] : '') . $redirectUrl;
    }
    
    public function sendResponse()
    {
        FDebug::log("Redirecting to: $this->redirectUrl", FDebugChannel::NET);
        
        header("Location: " . $this->redirectUrl);
        exit;
    }
    
    public function reload() 
    {
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }

    public function reloadWithoutParameters() 
    {
        $pos = strpos($_SERVER['REQUEST_URI'], '?');
        if ($pos !== FALSE) {
            $url = substr($_SERVER['REQUEST_URI'], 0, $pos);
        } else {
            $url = $_SERVER['REQUEST_URI'];
        }
        header("Location: " . $url);
        exit;
    }

    public function redirect($page) 
    {
        header("Location: " . FConfigBase::$config['root'] . $page);
        exit;
    }
}
