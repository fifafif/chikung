<?php


class NotAuthorizedResponseJson extends FResponse
{
    function __construct()
    {
        parent::__construct('{"error":{"code":1,"message":"Not Authorized!"}}', parent::TYPE_JSON);
    }
}


?>
