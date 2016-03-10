<?php

class ResponseDataJson extends FResponse
{
    function __construct($status, $data)
    {
        parent::__construct('{"status":' . $status . ',"data":' . $data . '}', parent::TYPE_JSON);
    }

}

?>
