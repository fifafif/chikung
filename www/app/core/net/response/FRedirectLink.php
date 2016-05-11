<?php

/**
 * Description of FResponseLink
 *
 * @author XiXao
 */
class FRedirectLink extends FRedirect
{
    function __construct($link, $params = null)
    {
        $link = FLink::printLinkFromParams($link, $params);
        
        parent::__construct($link, false);
    }

}
