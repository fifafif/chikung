<?php

class FDateTools
{
    public static function convertToMysqlDate($date)
    {
        $time = strtotime($date);
        
        if ($time === false)
        {
            return null;
        }
        
        $date = date('Y-m-d', $time);
        
        return $date;
    }
    
    public static function convertToMysqlDatetime($date)
    {
        $time = strtotime($date);
        
        if ($time === false)
        {
            return null;
        }
        
        $date = date('Y-m-d H:i:s', $time);
        
        return $date;
    }
    
    public static function getCurrentMysqlDatetime()
    {
        return date('Y-m-d H:i:s');
    }
}

?>
