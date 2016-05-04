<?php

/**
 * Description of FArray
 *
 * @author XiXao
 */
class FArray
{
    public static function convertObjectsToArray($objects, $keyName, $valueName)
    {
        $array = array();
        
        foreach ($objects as $object)
        {
            $array[$object->$keyName] = $object->$valueName;
        }
        
        return $array;
    }
}
