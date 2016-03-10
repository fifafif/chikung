<?php

class NotAuthorizedResponse extends FResponse
{
    function __construct()
    {
        parent::__construct('Not Authorized!', parent::TYPE_TEXT);
    }

}

?>
