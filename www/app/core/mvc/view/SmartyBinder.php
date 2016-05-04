<?php

require_once dirname(__FILE__) . '/IViewBindeable.php';
require_once dirname(__FILE__) . '/FormRenderer.php';

/**
 * Description of ISmartyBinder
 *
 * @author XiXao
 */
class SmartyBinder implements IViewBindeable
{
    public function register($smarty)
    {
        $smarty->registerPlugin('function', 'a', 'SmartyBinder::printSmartyAhref');
        $smarty->registerPlugin('function', 'form', 'SmartyBinder::printSmartyForm');
        $smarty->registerPlugin('function', 'link', 'SmartyBinder::printSmartyLink');
        $smarty->registerPlugin('function', 'form_select', 'SmartyBinder::printFormSelect');
    }
    
    public static function printFormSelect($params, $smarty)
    {
        if (!isset($params['data']))
        {
            return '';
        }
        
        if (!isset($params['name']))
        {
            return '';
        }
        
        return FormRenderer::renderSelect($params['name'], $params['data']);
    }
    
    public static function printSmartyLink($params, $smarty)
    {
        $flink = FLink::getInstance();

        if (isset($params['a']))
        {
            $link = $params['a'];
            unset($params['a']);
        }
        else
        {
            return '';
        }
        
        return '"' . $flink->decodeAndPrint($link, $params) . '"';
    }
    
    public static function printSmartyAhref($params, $smarty)
    {
        $flink = FLink::getInstance();

        if (isset($params['href']))
        {
            $link = $params['href'];
            unset($params['href']);
        }
        else
        {
 
        }
        
        return 'a href="' . $flink->decodeAndPrint($link, $params) . '"';
    }
    
    public static function printSmartyForm($params, $smarty)
    {
        $flink = FLink::getInstance();

        $link = $params['action'];
        unset($params['action']);
        
        return 'form action="' . $flink->decodeAndPrint($link, $params) . '"';
    }
}
