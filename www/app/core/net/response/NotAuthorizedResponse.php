<?php

class NotAuthorizedResponse extends FResponse
{
    function __construct()
    {
        parent::__construct('Not Authorized!', parent::TYPE_TEXT);
        
        $this->code = FResponse::CODE_NOT_AUTHORIZED;
    }

}

?>
