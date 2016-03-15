<?php

class EntitySchema
{
    const DESC_TYPE = 0;
    const DESC_INDEX = 2;
    const DESC_AUTOINCREMENT = 4;
}

class FDAO
{
    
}


/**
 * Description of FModel
 *
 * @author XiXao
 */
abstract class FModelObject// implements Serializable
{
    protected static $dataTypes;
    public static $tableName;
    
    //public abstract function getTableName();

    /**
     * @deprecated user OOP
     */
    public function getValue($key)
    {
        return $this->$key;
    }

    /**
     *  @deprecated user object oriented approach
     */
    public function setValue($key, $value)
    {
        $this->updateValue($key, $value);
    }

    /**
     *  @deprecated user object oriented approach
     */
    public function updateValue($dataName, $dataValue)
    {
        $this->$dataName = $dataValue;
    }
    
    public static function loadFromDB($query)
    {
        $database = FDatabase::getInstance();
        $res = $database->execute($query);
        
        if ($res == false)
        {
            return false;
        }
        
        $objects = &self::parseDataIntoObjects($res);
        
        return $objects;
    }
    
    protected static function parseDataIntoObjects($res)
    {
        $objects = array();
        
        while ($row = mysqli_fetch_assoc($res))
        {
            $object = new static();
            self::assignDataWithTypeSet($object, $row);
            $objects[] = $object;
        }
        
        return $objects;
    }

    private static function assignDataWithTypeSet(&$object, &$row)
    {
        if (!isset(static::$dataTypes))
        {
            return $row;
        }

        foreach ($row as $key => $value)
        {
            $type = self::getColumnType($key);
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
    
    protected function getColumnDescription($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column];
    }
    
    protected static function getColumnType($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][EntitySchema::DESC_TYPE];
    }
    
    protected static function isAutoincrement($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][EntitySchema::DESC_AUTOINCREMENT];
    }
    
    protected static function getPrimaryKeyFieldName()
    {
        foreach (static::$dataTypes as $key => $value)
        {
            if ($value[EntitySchema::DESC_INDEX] == 2)
            {
                return $key;
            }
        }
        
        return null;
    }

    public function insert()
    {
        $query = FQuery::getInstance()->create()
                ->insert(static::$tableName);
        
        foreach (static::$dataTypes as $key => $value)
        {
            if (self::isAutoincrement($key))
            {
                continue;
            }

            $query->insertValue($key, $this->$key, $this->getColumnType($key));
        }
        
        $singleRes = FDatabase::getInstance()->execute($query->getQuery());
        if (!$singleRes)
        {
            return false;
        }
        
        return true;
    }
    
    public function update()
    {
        $query = FQuery::getInstance()->create()
                    ->update(static::$tableName);
        
        foreach (static::$dataTypes as $key => $value)
        {
            if (self::isAutoincrement($key))
            {
                continue;
            }
            
            $query->set($key, $this->$key, self::getColumnType($key));
        }
        
        $primaryKey = $this->getPrimaryKeyFieldName();
        $query->where("$primaryKey =", $this->$primaryKey, self::getColumnType($primaryKey));
        
        $singleRes = FDatabase::getInstance()->execute($query->getQuery());
        if (!$singleRes)
        {
            return false;
        }
        
        return true;
    }
    
    public static function loadAll()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from(static::$tableName);
        
        return self::loadFromDB($query->getQuery());
    }
    
    public static function loadByPrimaryKey($id)
    {
        $primaryKeyName = self::getPrimaryKeyFieldName();
        
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from(static::$tableName)
                ->where("$primaryKeyName = ", $id, self::getColumnType($primaryKeyName));
        
        return self::loadFromDB($query->getQuery());
    }
    
    public static function first()
    {
        
    }
}

?>