<?php

class DataResult
{
    private $data;
    private $modelClassName;
    
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
        
}


/**
 * Description of DataContext
 *
 * @author XiXao
 */
class DataContext
{
    private $database;
    
    function __construct(FDatabase $database)
    {
        $this->database = $database;
    }

    public function loadFromDB($modelClassName, $query)
    {
        $res = $this->database->execute($query);
        
        if ($res == false)
        {
            return false;
        }
        
        $objects = &self::parseDataIntoObjects($modelClassName, $res);
        
        $dataResult = new DataResult($objects, $modelClassName);
        
        return $dataResult;
    }
    
    protected function parseDataIntoObjects($modelClassName, $res)
    {
        $objects = array();
        
        while ($row = mysqli_fetch_assoc($res))
        {
            $object = new $modelClassName();
            self::assignDataWithTypeSet($object, $row);
            $objects[] = $object;
        }
        
        return $objects;
    }

    private function assignDataWithTypeSet(FModelObject &$object, &$row)
    {
        foreach ($row as $key => $value)
        {
            $type = $object::getColumnType($key);
            if ($type !== false)
            {
                switch ($type)
                {
                    case FQueryParam::INT:

                        settype($value, 'integer');
                        break;

                    case FQueryParam::FLOAT:

                        settype($value, 'float');
                        break;

                    default:
                        // String

                        settype($value, 'string');
                        break;
                }
            }
            
            $object->$key = $value;
        }
    }


    public function insert(FModelObject $model)
    {
        $query = FQuery::getInstance()->create()
                ->insert($model::getTableName());
        
        foreach ($model::getDataTypes() as $key => $value)
        {
            if ($model::isAutoincrement($key))
            {
                continue;
            }

            $query->insertValue($key, $model->$key, $model->getColumnType($key));
        }
        
        $singleRes = $this->database->execute($query->getQuery());
        if (!$singleRes)
        {
            return false;
        }
        
        return true;
    }
    
    public function update(FModelObject $model)
    {
        $query = FQuery::getInstance()->create()
                    ->update($model::getTableName());
        
        foreach ($model::getDataTypes() as $key => $value)
        {
            if ($model::isAutoincrement($key))
            {
                continue;
            }
            
            $query->set($key, $model->$key, $model::getColumnType($key));
        }
        
        $primaryKey = $model->getPrimaryKeyFieldName();
        $query->where("$primaryKey =", $model->$primaryKey, $model::getColumnType($primaryKey));
        
        $singleRes = $this->database->execute($query->getQuery());
        if (!$singleRes)
        {
            return false;
        }
        
        return true;
    }
    
    public function load($modelClassName)
    {
        return $this->loadAll($modelClassName);
    }
    
    public function loadAll($modelClassName)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::getTableName());
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByPrimaryKey($modelClassName, $id)
    {
        $primaryKeyName = $modelClassName::getPrimaryKeyFieldName();
        
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::getTableName())
                ->where("$primaryKeyName = ", $id, $modelClassName::getColumnType($primaryKeyName));
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByKey($modelClassName, $key, $value)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::getTableName())
                ->where("$key = ", $value, $modelClassName::getColumnType($key));
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByKeyValues($modelClassName, $key, $values)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::getTableName())
                ->whereIn($key, $values, $modelClassName::getColumnType($key));
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByIndex($modelClassName, $index)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::getTableName());
        
        $indexFields = &$modelClassName::getIndexFields($index);
        
        if ($indexFields == false)
        {
            return false;
        }
        
        $count = count($indexFields);
        
        if ($count != func_num_args() - 2)
        {
            return false;
        }
        
        $query->where($indexFields[0] . ' =', func_get_arg(2), $modelClassName::getColumnType($indexFields[0]));
        
        for ($i = 1; $i < $count; ++$i)
        {
            $query->whereAnd($indexFields[$i] . ' =', func_get_arg($i + 2), $modelClassName::getColumnType($indexFields[$i]));    
        }
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }   
    
}
