<?php
/**
 * Trida, ktera se stara o validaci formu
 *
 * @author XiXao
 */
class FFormValidation {

    private $valid = true;
    const PASS_LENGTH = 3;
    
    const REQUIRED = 'required';
    const EMAIL = 'email';
    const PASSWORD = 'password';
    
    public function __construct() {
        $this->startValidation();
    }

    /**
     * Tato funkce se musi spustit pred kazdou validaci.
     */
    public function startValidation(){
        $this->valid = true;
    }

    /**
     * Funkce, ktera overi vstupni udaj.
     *
     * @param string $data
     * @param string $type
     * @param Messages $messages
     * @param string $message
     * @return <type>
     */
    public function validate($data, $type) 
    {
        if (!isset($data))
        {
            $this->valid = false;
            return false;
        }
        
        switch($type) {
            case self::REQUIRED:
                $reg = ".+";
                break;
            case self::EMAIL:
                $reg = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$";
                break;
            case self::PASSWORD:
                $reg = ".{" . self::PASS_LENGTH . ",}";
                break;
            default:
                return false;
        }
        if (!eregi($reg, $data)) {
            
            $this->valid = false;
            return false;
        }
        
        return true;
    }

    /**
     * Funkce, ktera se musi zavolat po overeni vsech polich, jestli je formular validni.
     *
     * @return boolean
     */
    public function isValid() {
        return $this->valid;
    }

    /**
     * Tato funkce nastavi validnost formulare na false.
     *
     * @param Messages $messages
     * @param string $message
     */
    
    public function notValid() {
        $this->valid = false;
    }
    
    /* TODO
    public function buildModelObjectFromData($modelClassName, $dataArray)
    {
        
    }
    
     * TODO
    public function validateModelObject(FModelObject $modelObject)
    {
        $this->startValidation();
        foreach ($modelObject->getDataTypes() as $key => $value)
        {
            $isValid = 
        }
    }*/

}
?>
