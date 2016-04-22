<?php

class EntitySchema
{
    const DESC_TYPE = 0;
    const DESC_INDEX = 2;
    const DESC_AUTOINCREMENT = 4;
}


/**
 * Description of FModel
 *
 * @author XiXao
 */
abstract class FModelObject// implements Serializable
{
    public static $tableName;
    
    protected static $dataTypes;
    protected static $indexFields;
    
    
    public static function getDataTypes()
    {
        return static::$dataTypes;
    }
    
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
    
    public function updateValueSetType($key, $value)
    {
        self::setDataType($key, $value);
        
        $this->$dataName = $value;
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
    
    public static function getIndexFields($index)
    {
        if (!isset(static::$indexFields[$index]))
        {
            return false;    
        }
        
        return static::$indexFields[$index];
    }
    
    public function getColumnDescription($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column];
    }
    
    public static function getColumnType($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][EntitySchema::DESC_TYPE];
    }
    
    public static function isAutoincrement($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][EntitySchema::DESC_AUTOINCREMENT];
    }
    
    public static function getPrimaryKeyFieldName()
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
    
    public static function loadByKey($key, $value)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from(static::$tableName)
                ->where("$key = ", $value, self::getColumnType($key));
        
        return self::loadFromDB($query->getQuery());
    }
    
    public function fillDataFromArray($dataArray)
    {
        foreach (static::getDataTypes() as $key => $value)
        {
            if (isset($dataArray[$key]))
            {
                $this->updateValueSetType($key, $dataArray[$key]);
            }
        }
    }
    
    public static function setDataType($columnName, &$value)
    {
        $type = self::getColumnType($columnName);
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
    }
}

?>