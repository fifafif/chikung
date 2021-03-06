<?php

class FQueryParam
{
    const INT = 0;
    const FLOAT = 1;
    const STRING = 2;
    const DATETIME = 3;
    
    public static function getDefaultValue($param)
    {
        switch ($param)
        {
            case self::INT:
            case self::FLOAT:
                return '0';
                
            case self::STRING:
                return '';
                
            case self::DATETIME:
                return '';
                
            default:
                return 'NULL';
        }
    }
}


/**
 * Description of FQuery
 *
 * @author XiXao
 */
class FQuery
{
    const SPACE = ' ';
    const COMMA = ',';
    const DOUBLE_QUOTE = '"';
    
    const SELECT = 'SELECT';
    const QFROM = 'FROM';
    const QAS = 'AS';
    const INSERT = 'INSERT INTO';
    const WHERE = 'WHERE';
    const WHERE_AND = 'AND';
    const WHERE_OR = 'OR';
    const LIMIT = 'LIMIT';
    
    private static $instance = null;
    private $query;
    
    private $insertArgs;
    private $insertValues;
    
    private $type;
    private $isBuilt;
    
    private $updateColumnCount = 0;
    
    const TYPE_INSERT = 1;
    
    private function __constructor()
    {
        self::$instance = $this;
    }
    
    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new FQuery();
        }
               
        return self::$instance;
    }
    
    public function create()
    {
        $this->query = '';
        $this->insertArgs = '';
        $this->insertValues = '';
        
        $this->isBuilt = false;
        $this->type = 0;
        $this->updateColumnCount = 0;
        
        return $this;
    }
    
    public function select()
    {
        $query = self::SELECT . self::SPACE;
        
        $args = func_get_args();
        end($args);
        $lastKey = key($args);
        
        foreach ($args as $key => $arg)
        {   
            $query .= $arg;
            
            if ($lastKey != $key)
            {
                $query .= self::COMMA;
            }
            
            $query .= self::SPACE;
        }
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function from($tableName, $alias = null)
    {
        $query = self::QFROM . self::SPACE . $this->escapeString($tableName) . self::SPACE;
        
        if ($alias != null)
        {
            $query .= self::QAS . self::SPACE . $this->escapeString($alias) . self::SPACE;
        }
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function where($arg, $value, $type = 0)
    {
        $query = self::WHERE . self::SPACE . $arg . self::SPACE . $this->escapeParam($value, $type) . self::SPACE;
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function whereAnd($arg, $value, $type = 0)
    {
        $query = self::WHERE_AND . self::SPACE . $arg . self::SPACE . $this->escapeParam($value, $type) . self::SPACE;
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function whereOr($arg, $value, $type = 0)
    {
        $query = self::WHERE_OR . self::SPACE . $arg . self::SPACE . $this->escapeParam($value, $type) . self::SPACE;
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function whereIn($arg, $values, $type = 0)
    {
        $query = self::WHERE . self::SPACE . $arg . self::SPACE . 'IN (';
        
        foreach ($values as $value)
        {
            $query .= ' ' . $this->escapeParam($value, $type) . ',';
        }
        
        $query[strlen($query) - 1] = ' ';
        $query .= ')';
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function limit($from, $to = 0)
    {
        $query = self::LIMIT . self::SPACE . (int)$from . self::SPACE;
        if ($to > 0)
        {
            $query .= self::COMMA . self::SPACE . (int)$to . self::SPACE;
        }
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function update($tableName)
    {
        $this->query .= 'UPDATE ' . $this->escapeString($tableName) . ' SET ';
        
        return $this;
    }
    
    public function set($arg, $value, $type = 0)
    {
        $query = ($this->updateColumnCount > 0 ? ', ' : '') . '`' . $arg . '` = ' . $this->escapeParam($value, $type) . ' ';
        ++$this->updateColumnCount;
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function setNext($arg, $value, $type = 0)
    {
        $query = ', `' . $arg . '` = ' . $this->escapeParam($value, $type) . ' ';
        
        $this->query .= $query;
        
        return $this;
    }
    
    public function insert($tableName)
    {
        $this->query .= 'INSERT INTO `' . $this->escapeString($tableName) . '` ';
        
        $this->type = self::TYPE_INSERT;
        
        return $this;
    }
    
    public function insertValue($arg, $value, $type = 0)
    {
        $this->insertArgs .= "`$arg`, ";
        $this->insertValues .= $this->escapeParam($value, $type) . ', ';
        
        return $this;
    }
    
    private function buildInsert()
    {
        if (strlen($this->insertArgs) < 3)
        {
            return;
        }
        
        $this->insertArgs = substr($this->insertArgs, 0, strlen($this->insertArgs) - 2);
        $this->insertValues = substr($this->insertValues, 0, strlen($this->insertValues) - 2);
                
        $this->query .= '(' . $this->insertArgs . ' ) VALUES ( ' . $this->insertValues . ' );';
    }
    
    public function delete($tableName)
    {
        $this->query .= 'DELETE FROM `' . $this->escapeString($tableName) . '` ';
        
        $this->type = self::TYPE_INSERT;
        
        return $this;
    }
    
    private function buildQuery()
    {
        if ($this->isBuilt == true)
        {
            return;
        }
        
        $this->isBuilt = true;
        
        if ($this->type == self::TYPE_INSERT)
        {
            $this->buildInsert();
        }
    }
    
    public function getQuery()
    {
        $this->buildQuery();
        
        return $this->query;
    }
    
    
    private function escapeParam($param, $type = 0)
    {
        switch ($type)
        {
            case FQueryParam::FLOAT:
                
                return (float) $param;
                
            case FQueryParam::STRING:
            case FQueryParam::DATETIME:
                
                return self::DOUBLE_QUOTE . $this->escapeString($param) . self::DOUBLE_QUOTE;
            
            // Integer
            default:
                
                return (int) $param;
        }
    }
    
    private function escapeString($value)
    {
        return (get_magic_quotes_gpc() ? $value : addslashes($value));
    }
}

?>