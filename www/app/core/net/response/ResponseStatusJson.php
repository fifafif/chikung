<?php

class ResponseStatusJson extends FResponse
{
    function __construct($status = 0, $message = "")
    {
        parent::__construct('{"status":' . $status . ',"message":"' . $message . '"}}', parent::TYPE_JSON);
    }
}

?>
