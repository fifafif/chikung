<?php

/**
 * Description of FMessage
 *
 * @author XiXao
 */
class FMessage
{

    private $_message;
    private $_priority;
    private $_type;

    const TYPE_INFO = 0;
    const TYPE_ERROR = 1;
    const TYPE_WARNING = 2;

    function __construct($message, $type = 0, $priority = 0)
    {
        $this->_message = $message;
        $this->_priority = $priority;
        $this->_type = $type;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function getPriority()
    {
        return $this->_priority;
    }

    public function getType()
    {
        return $this->_type;
    }

}

?>