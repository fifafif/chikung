<?php

/**
 * Trida messages uchovava zpravy, ktere se maji zobrazit uzivateli.
 *
 * @author XiXao
 */
class FMessages {

    private static $_instance;
    
    private $_messages;

    private function __construct() {
        $this->_messages = array();
    }
    
    public static function getInstance() {

        if (!isset(self::$_instance)) {
            self::$_instance = new FMessages();
        }
        return self::$_instance;
    }

    /**
     * Nahrani Messages ze session.
     */
    public static function checkMessages() {
        
//        unset ($_SESSION['messages']);
        
        if (!isset($_SESSION['messages'])) {
            self::getInstance();
            $_SESSION['messages'] = serialize(self::$_instance);
        } else {
            self::$_instance = unserialize($_SESSION['messages']);
            FModel::getInstance()->addData('messages', self::$_instance->getMessages());
//            $smarty->assign('messages', $messages->getMessages());
            self::$_instance->clearMessages();
        }
    }
    
    public function saveMessages() {
        $_SESSION['messages'] = serialize(self::$_instance);
    }

    /**
     * Funkce, ktera prida do objektu dalsi zpravu.
     *
     * @param string $m
     */
    public function addMessage($m) {
        $this->_messages[] = $m;
        $this->saveMessages();
    }

    public function getMessages() {
        return $this->_messages;
    }

    /**
     * Funkce smaze vsechny zpravy.
     */
    public function clearMessages() {
        $this->_messages = array();
        $this->saveMessages();
    }

}

?>