<?php

/**
 * Description of FResponseLink
 *
 * @author XiXao
 */
class FRedirectLink extends FRedirect
{
    function __construct($link)
    {
        $link = FLink::printLinkFromParams($link);
        
        parent::__construct($link, false);
    }

}
