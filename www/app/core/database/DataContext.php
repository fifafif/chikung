<?php

class DataResult
{
    private $data;
    
    function __construct($data)
    {
        $this->data = $data;
    }

    public function get()
    {
        return $this->data;
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
    
    public function first()
    {
        return reset($this->data);
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
        
        $dataResult = new DataResult($objects);
        
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
                ->insert($model::$tableName);
        
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
                    ->update($model::$tableName);
        
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
                ->from($modelClassName::$tableName);
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByPrimaryKey($modelClassName, $id)
    {
        $primaryKeyName = $modelClassName::getPrimaryKeyFieldName();
        
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::$tableName)
                ->where("$primaryKeyName = ", $id, $modelClassName::getColumnType($primaryKeyName));
        
        return $this->loadFromDB($modelClassName, $query->getQuery());
    }
    
    public function loadByKey($modelClassName, $key, $value)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($modelClassName::$tableName)
                ->where("$key = ", $value, $modelClassName::getColumnType($key));
        
        return $this->loadFromDB($query->getQuery());
    }
}
