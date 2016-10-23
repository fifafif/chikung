<?php

class FPerf
{
    private static $times = array();
    
    
    public static function start($name)
    {
        self::$times[$name] = microtime(true);
    }
    
    public static function end($name)
    {
        if (!isset(self::$times[$name]))
        {
            return -1;
        }
        
        return round((microtime(true) - self::$times[$name]) * 1000);
    }
}
