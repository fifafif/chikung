<?php

/**
 * Description of FModel
 *
 * @author XiXao
 */
class FModel {

    private static $_instance;
    private $_dataA;
    private $_modelA;
    
    private function __construct() {
        $this->_dataA = array();
    }
    
    public static function getInstance() {
        if (!isset(self::$_instance)) {
            self::$_instance = new FModel();
        }
        return self::$_instance;
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