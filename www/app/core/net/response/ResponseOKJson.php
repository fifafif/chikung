<?php

class ResponseOKJson extends FResponse
{
    function __construct()
    {
        parent::__construct('{"status":0,"message":"OK"}', parent::TYPE_JSON);
    }

}

?>
