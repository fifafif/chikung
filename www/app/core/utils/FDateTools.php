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
}

?>
