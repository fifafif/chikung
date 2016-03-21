<?php

require_once dirname(__FILE__) . '/database/DataContext.php';

/**
 * Description of FModel
 *
 * @author XiXao
 */
class FModel 
{
    private $dataContext;
    private $_dataA;
    private $_modelA;
    
    public function __construct(FDatabase $database) 
    {
        $this->dataContext = new DataContext($database);
        
        $this->_dataA = array();
    }
    
    public function getDataContext()
    {
        return $this->dataContext;
    }
    
    public function addData($dataName, $data) {
        $this->_dataA[$dataName] = $data;
    }
    
    public function addDataByRef($dataName, &$data) {
        $this->_dataA[$dataName] = $data;
    }
    
    public function getData($dataName) {
        if (isset($this->_dataA[$dataName])) {
            return $this->_dataA[$dataName];
        } else {
            return NULL;
        }
    }
    
    public function addModelObject(FModelObject $modelObject) {
        $this->_modelA[$modelObject->getTableName()] = $modelObject;
    }
    
    public function getModelObject($tableName) {
        if (isset($this->_modelA[$tableName])) {
            return $this->_modelA[$tableName];
        } else {
            return NULL;
        }
    }
}

?>