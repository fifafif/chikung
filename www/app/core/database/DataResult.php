<?php

class DataResult
{
    private $data;
    private $modelClassName;
    private $sortingIndex;
    
    function __construct($data, $modelClassName)
    {
        $this->data = $data;
        $this->modelClassName = $modelClassName;
    }
    
    function getModelClassName()
    {
        return $this->modelClassName;
    }

    public function get()
    {
        return $this->data;
    }
    
    public function toArray()
    {
        return $this->data;
    }
    
    public function toKeyValuePair($keyName, $valueName)
    {
        $array = array();
        
        foreach ($this->data as $object)
        {
            $array[$object->$keyName] = $object->$valueName;
        }
        
        return $array;
    }
    
    public function toDictionary($key)
    {
        $dict = array();
        
        foreach ($this->data as $value)
        {
            $dict[$value->$key] = $value;
        }
        
        return $dict;
    }
    
    public function toLookup($key)
    {
        $dict = array();
        
        foreach ($this->data as $value)
        {
            if (!isset($dict[$value->$key]))
            {
                $dict[$value->$key] = array();
            }
            
            $dict[$value->$key][] = $value;
        }
        
        return $dict;
    }
    
    public function first()
    {
        return reset($this->data);
    }
    
    public function join(DataResult $other, $key)
    {
        $keys = explode('_', $key);
        
        $keyModelName = $keys[0];
        $otherKey = $keys[1];
        
        $otherDict = $other->toDictionary($otherKey);
        
        foreach ($this->data as $model)
        {
            if (isset($otherDict[$model->$key]))
            {
                $model->$keyModelName = $otherDict[$model->$key];
            }
            else
            {
                $model->$keyModelName = null;
            }
        }
    }
    
    public function count()
    {
        if (!isset($this->data))
        {
            return 0;
        }
        
        return count($this->data);
    }
        
    public function sort($index, $asc = true)
    {
        $this->sortingIndex = $index;
        
        // TODO: More than just Int.
        usort($this->data, $this->buildSorter($index, $asc));
        
        return $this;
    }
    
    private function buildSorter($index, $asc)
    {
        return function ($a, $b) use ($index, $asc) 
        {
            $valueA = $a->$index;
            $valueB = $b->$index;
            
            return $this->compareInt($valueA, $valueB, $asc);
        };
    }
    
    private function compareInt($a, $b, $asc = true)
    {
        if ($a == $b)
        {
            return 0;
        }
        else if ($a < $b)
        {
            return $asc ? -1 : 1;
        }
        else
        {
            return $asc ? 1 : -1;
        }
    }
}