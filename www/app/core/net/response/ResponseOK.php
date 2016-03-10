<?php

class ResponseOK extends FResponse
{
    function __construct()
    {
        parent::__construct('OK', parent::TYPE_TEXT);
    }

}

?>
