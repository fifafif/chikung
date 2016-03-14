<?php

/**
 * Description of FModel
 *
 * @author XiXao
 */
abstract class FModelObject implements Serializable
{
    public $data;
    
    protected $db;
    protected $resultRowCount = 0;
    
    const DESC_TYPE = 0;
    const DESC_INDEX = 2;
    const DESC_AUTOINCREMENT = 4;
    
    protected static $dataTypes;
    

    public function __construct(FDatabase $database)
    {
        $this->db = $database;
    }

    public function setDatabase(FDatabase $database)
    {
        $this->db = $database;
    }

    public function unsetDatabase()
    {
        $this->db = NULL;
    }

    public abstract function getTableName();

    public function getData()
    {
        return $this->data;
    }
    
    public function getValue($key)
    {
        $a = &$this->single();
        
        return $a[$key];
    }

    public function setValue($key, $value)
    {
        $this->updateValue($key, $value);
    }

    public function updateValue($dataName, $dataValue)
    {
        if (!isset($this->data))
        {
            $this->data = array();
        }
        
//        $data = &$this->single();
               
        if (!isset($this->data[0]))
        {
            $this->data[0] = array();
        }

        $this->data[0][$dataName] = $dataValue;
    }
    
    protected function loadFromDB($query)
    {
        $res = $this->db->execute($query);
        
        if ($res == false)
        {
            return false;
        }
        
        $this->parseData($res);
        
        return true;
    }
    
    public function serialize()
    {
        return serialize(array(
            'data' => $this->data
        ));
    }

    public function unserialize($data)
    {
        $data = unserialize($data);
        $this->data = $data['data'];
        $this->db = FDatabase::getInstance();
    }

    protected function parseWithCheckResult($res, $expectedRowCount = -1, $forceArray = false)
    {
        unset($this->data);

        $this->resultRowCount = mysqli_num_rows($res);

        //$fields = mysqli_fetch_fields($res);
        //print_r($fields);
        //$this->getColumnType("type");

        if ($this->resultRowCount == 0)
        {
            $this->data = null;
        } 
        else if ($this->resultRowCount > 1 || $forceArray)
        {
            $this->data = array();

            while ($row = mysqli_fetch_assoc($res))
            {
                $this->data[] = $this->setTypes($row);
//                $this->data[] = $row;
            }
        } else // rowCount = 1
        {
            $this->data = $this->setTypes(mysqli_fetch_assoc($res));
        }


        return $expectedRowCount == -1 || $expectedRowCount == $this->resultRowCount;
    }
    
    protected function parseData($res)
    {
        $this->data = array();

        $this->resultRowCount = mysqli_num_rows($res);

        while ($row = mysqli_fetch_assoc($res))
        {
            $this->data[] = $this->setTypes($row);
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
    
    protected function getColumnType($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][self::DESC_TYPE];
    }
    
    protected function isAutoincrement($column)
    {
        if (!isset(static::$dataTypes[$column]))
        {
            return false;
        }
        
        return static::$dataTypes[$column][self::DESC_AUTOINCREMENT];
    }
    
    protected function getPrimaryKeyFieldName()
    {
        foreach (static::$dataTypes as $key => $value)
        {
            if ($value[self::DESC_INDEX] == 2)
            {
                return $key;
            }
        }
        
        return null;
    }

    private function setTypes(&$row)
    {
        if (!isset(static::$dataTypes))
        {
            return $row;
        }

        foreach ($row as $key => $value)
        {
            $type = $this->getColumnType($key);
            if ($type !== false)
            {
                switch ($type)
                {
                    case FQueryParam::INT:

                        settype($row[$key], 'integer');
                        break;

                    case FQueryParam::FLOAT:

                        settype($row[$key], 'float');
                        break;

                    default:
                        // String

                        settype($row[$key], 'string');
                        break;
                }
//                settype($row[$column], $this->dataTypes[$column]);
            }
        }

        return $row;
    }

    public function getResultRowCount()
    {
        return $this->resultRowCount;
    }
    
    public function insert()
    {
        foreach ($this->data as $row)
        {
            $query = $this->buildInsertQuery($row);
            $singleRes = $this->db->execute($query);
            if (!$singleRes)
            {
                return false;
            }
        }
        
        return true;
    }
    
    public function update()
    {
        foreach ($this->data as $row)
        {
            $query = $this->buildUpdateQuery($row);
            $singleRes = $this->db->execute($query);
            if (!$singleRes)
            {
                return false;
            }
        }
        
        return true;
    }
    
    public function loadAll()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($this->getTableName());
        
        return $this->loadFromDB($query->getQuery());
    }
    
    private function buildInsertQuery($data)
    {
        $query = FQuery::getInstance()->create()
                ->insert($this->getTableName());
        
        foreach ($data as $key => $value)
        {
            if ($this->isAutoincrement($key))
            {
                continue;
            }
            
            $query->insertValue($key, $value, $this->getColumnType($key));
        }
        
        return $query->getQuery();
    }
    
    private function buildUpdateQuery($data)
    {
        print_r($data);
        
        $query = FQuery::getInstance()->create()
                ->update($this->getTableName());
        
        foreach ($data as $key => $value)
        {
            if ($this->isAutoincrement($key))
            {
                continue;
            }
            
            $query->set($key, $value, $this->getColumnType($key));
        }
        
        $primaryKey = $this->getPrimaryKeyFieldName();
        $query->where("$primaryKey =", $data[$primaryKey], $this->getColumnType($primaryKey));
        
        return $query->getQuery();
    }
    
    public function loadByPrimaryKey($id)
    {
        $primaryKeyName = $this->getPrimaryKeyFieldName();
        
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from($this->getTableName())
                ->where("$primaryKeyName = ", $id, $this->getColumnType($primaryKeyName));
        
        return $this->loadFromDB($query->getQuery());
    }

    
    public function single()
    {
        if (!is_array($this->data))
        {
            return false;
        }
        return reset($this->data);
    }
}

?>