<?php

class ResponseErrorJson extends FResponse
{
    function __construct($code = 0, $message = "")
    {
        parent::__construct('{"error":{"code":' . $code . ',"message":"' . $message . '"}}', parent::TYPE_JSON);
    }
}

?>
