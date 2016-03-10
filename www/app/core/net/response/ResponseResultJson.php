<?php

class ResponseResultJson extends FResponse
{
    function __construct($result = 0, $message = "")
    {
        parent::__construct('{"status":0,"data":{"result":' . (int) $result . '},"message":"' . $message . '"}', parent::TYPE_JSON);
    }
}

?>
