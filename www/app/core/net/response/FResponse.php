<?php

class FResponse implements IResponseable
{
    const TYPE_HTML = 0;
    const TYPE_TEXT = 1;
    const TYPE_JSON = 2;
    
    const ENCODING_UTF8 = 0;
    
    const CODE_OK = 200;
    const CODE_NOT_AUTHORIZED = 401;
    
    protected $body;
    protected $type;
    protected $encoding;
    protected $code;
    
    function __construct($body, $type = 0, $encoding = 0, $code = FResponse::CODE_OK)
    {
        $this->body = $body;
        $this->type = $type;
        $this->encoding = $encoding;
        $this->code = $code;
    }
    
    public function getBody()     
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
    
    public function sendResponse()
    {
        $this->buildHeader();
        $this->printResponse();
    }
    
    public function buildHeader()
    {
        header('Content-Type: ' . self::getHeaderTypeString($this->type) . '; charset=' . self::getEncodingString($this->encoding), false, $this->code);
    }
    
    public function printResponse()
    {
        echo $this->body;
    }
    
    public static function getHeaderTypeString($type)
    {
        switch ($type)
        {
            case self::TYPE_JSON:
                return "application/json";
                
            case self::TYPE_TEXT:
                return "text/plain";
                
            default: // TYPE_TEXT
                return "text/html";
        }
    }
    
    public static function getEncodingString($type)
    {
        switch ($type)
        {                
            default: // ENCODING_UTF8
                return "utf-8";
        }
    }
}

?>
