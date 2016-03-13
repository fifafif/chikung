<?php

/**
 * Trida messages uchovava zpravy, ktere se maji zobrazit uzivateli.
 *
 * @author XiXao
 */
class FMessages
{

    private static $_instance;
    private $_messages;

    private function __construct()
    {
        $this->_messages = array();
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new FMessages();
        }
        return self::$_instance;
    }

    public function loadMessages()
    {
        if (isset($_SESSION['messages']))
        {
            $this->_messages = unserialize($_SESSION['messages']);
            
            FModel::getInstance()->addData('messages', $this->_messages);

            unset($_SESSION['messages']);
        }
    }

    public function saveMessages()
    {
        $_SESSION['messages'] = serialize($this->_messages);
    }

    /**
     * Funkce, ktera prida do objektu dalsi zpravu.
     *
     * @param string $m
     */
    public function addMessage(FMessage $m)
    {
        $this->_messages[] = $m;
        $this->saveMessages();
    }

    public function getMessages()
    {
        return $this->_messages;
    }

    public function hasMessages()
    {
        return count($this->_messages) > 0;
    }

    public function clearMessages()
    {
        $this->_messages = array();
        
        unset($_SESSION['messages']);
    }

}

?>