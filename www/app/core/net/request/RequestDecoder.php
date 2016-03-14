<?php

require_once dirname(__FILE__) . '/Request.php';
require_once dirname(__FILE__) . '/AuthData.php';

class RequestDecoder
{
    const PARAM_TYPE = "t";
    const PARAM_CONTROLLER = "c";
    const PARAM_REQUEST = "r";
    const PARAM_HANDLER = "h";
    const PARAM_MODULE = "m";
    const PARAM_GATE = "g";
    const PARAM_DATA = "data";
    const PARAM_DATA_JSON = "dj";
    const PARAM_CRYPTO = "dc";
    const PARAM_AUTH_TOKEN = "at";
    const PARAM_SESSION_ID = "sid";
    
    const TYPE_DEFAULT = 0;
    const TYPE_JSON = 1;
    const TYPE_ENCRYPTED = 2;
    
    private $requestAuth;
    private $request;
    
    
    public function decodeRequest($data)
    {
        $type = (isset($data[self::PARAM_TYPE])) ? $data[self::PARAM_TYPE] : self::TYPE_DEFAULT;
        
        switch ($type)
        {
            case self::TYPE_JSON:

                if (!isset($data[self::PARAM_DATA_JSON]))
                {
                    return null;
                }
                
                $this->decodeFromJson($data[self::PARAM_DATA_JSON]);
                
                break;
            
            case self::TYPE_ENCRYPTED:
                
                // TODO: Implement!
                
                break;
            
            default:
                
                $this->decodeFromParams($data);
                
                break;
        }

    }
    
    private function decodeFromJson($json)
    {
        $data = json_decode($json, true);
        
        if (!isset($data[self::PARAM_REQUEST]))
        {
            FDebug::log("Request not set!", FDebugChannel::NET);
            return null;
        }
        
        $this->request = $this->parseRequest($data[self::PARAM_REQUEST]);
        $this->requestAuth = $this->parseAuth($data);
    }
    
    private function decodeFromParams($data)
    {
        $this->request = $this->parseRequest($data);
        $this->requestAuth = $this->parseAuth($data);
    }
    
    private function parseRequest($params)
    {
        if (!isset($params[self::PARAM_CONTROLLER]) || !isset($params[self::PARAM_HANDLER]))
        {
            FDebug::log("Request or controller not set!", FDebugChannel::NET);
            return null;
        }
        
        $request = new Request();
        
        $request->controller = $params[self::PARAM_CONTROLLER];
        $request->handler = $params[self::PARAM_HANDLER];
        
        if (isset($params[self::PARAM_MODULE]))
        {
            $request->module = $params[self::PARAM_MODULE];
        }
        
        if (isset($params[self::PARAM_GATE]))
        {
            $request->gate = $params[self::PARAM_GATE];
        }
        
        $request->data = isset($params[self::PARAM_DATA]) ? $params[self::PARAM_DATA] : null;
        
        return $request;
    }
    
    private function escapeParameter($parameter)
    {
        if (get_magic_quotes_gpc())  
        {
            return stripslashes($parameter);
        }
        
        return $parameter;
    }
    
    private function parseAuth($params)
    {
        $requestAuth = new AuthData();
        
        $requestAuth->authToken = isset($params[self::PARAM_AUTH_TOKEN]) ? $params[self::PARAM_AUTH_TOKEN] : null;
        $requestAuth->sessionId = isset($params[self::PARAM_SESSION_ID]) ? $params[self::PARAM_SESSION_ID] : null;
        
        return $requestAuth;
    }
    
    public function getAuthData()     
    {
        return $this->requestAuth;
    }

    public function getRequest()
    {
        return $this->request;
    }


}

?>
