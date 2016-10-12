<?php

require_once dirname(__FILE__) . '/DataResult.php';

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
        
        $objects = self::parseDataIntoObjects($modelClassName, $res);
        
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
        
        $indexFields = $modelClassName::getIndexFields($index);
        
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
    
    public function delete(FModelObject $model)
    {
        $primaryIndex = $model::getPrimaryKeyFieldName();
        $primaryIndexValue = $model->getValue($primaryIndex);
        
        return $this->deleteByKey($model, $primaryIndex, $primaryIndexValue);
    }
    
    public function deleteByPrimaryKey($modelClassName, $value)
    {
        $primaryIndex = $modelClassName::getPrimaryKeyFieldName();
        
        return $this->deleteByKey($modelClassName, $primaryIndex, $value);
    }
    
    public function deleteByKey($modelClassName, $key, $value)
    {
        $query = FQuery::getInstance()->create()
                ->delete($modelClassName::getTableName())
                ->where("$key = ", $value, $modelClassName::getColumnType($key));
        
        $res = $this->database->execute($query->getQuery());
        if (!$res)
        {
            return false;
        }
        
        return true;
    }
    
}
