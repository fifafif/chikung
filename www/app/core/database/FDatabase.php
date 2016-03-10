<?php

/**
 * Description of Database
 *
 * @author XiXao
 */
class FDatabase
{

    private static $_instance;
    private $_server;
    private $_username;
    private $_password;
    private $_database;
    private $_db = NULL;
    private $_debug = false;

    private function __construct()
    {
        $this->_debug = isset($_REQUEST['echo']);
    }

    public static function getInstance()
    {
        if (!isset(self::$_instance))
        {
            self::$_instance = new FDatabase();
        }
        return self::$_instance;
    }

    public function __destruct()
    {
        $this->close();
    }

    public function connect($server, $username, $password, $database)
    {
        if ($this->_db === NULL)
        {

            $this->_server = $server;
            $this->_username = $username;
            $this->_password = $password;
            $this->_database = $database;
            
            $this->_db = mysqli_connect($server, $username, $password, $database);

            if (!$this->_db)
            {
                die('Could not connect: ' . mysqli_error());
            }

            mysqli_select_db($this->_db, $database);
            mysqli_query($this->_db, "SET CHARACTER SET utf8;");
            mysqli_query($this->_db, " SET NAMES utf8;");
        }
        
        return $this->_db;
    }

    /**
     * Uzavreni spojeni s databazi.
     */
    private function close()
    {
        if ($this->_db != NULL)
        {
            mysqli_close($this->_db);
        }
    }

    /**
     * Funkce osetri string pro ulozeni do databaze.
     *
     * @param string $value
     * @return string/bool
     */
    public function parseData($value)
    {
        if ($value != '')
        {
            return '"' . $this->escapeString($value) . '"';
        } else
        {
            return "NULL";
        }
    }

    public function parseString($value)
    {
        if ($value != '')
        {
            return '"' . $this->escapeString($value) . '"';
        } else
        {
            return "NULL";
        }
    }

    /**
     * Osetreni proti injection a xss.
     * @param string $value
     * @return string
     */
    public function escapeString($value)
    {
        return (get_magic_quotes_gpc() ? $value : addslashes($value));
    }

    /**
     * Funkce pro provedeni MySQL prikazu.
     * @param string $query
     * @return array
     */
    public function execute($query)
    {
        if ($this->_debug)
        {
            echo "<p style=\"color:red;\">query: $query</p>";
        }
        $result = mysqli_query($this->_db, $query) or $this->throwException(mysqli_error($this->_db));
        return $result;
    }

    /**
     * Funkce vrati odkaz na databazi.
     *
     * @return mysqli_link
     */
    public function getDBLink()
    {
        return $this->_db;
    }

    /**
     * Funkce vrati naposledy vytvorene autoincrementem id v databazi.
     *
     * @return integer
     */
    public function getLastAutoId()
    {
        return mysqli_insert_id($this->_db);
    }

    public function begin()
    {
        $result = mysqli_query($this->_db, "BEGIN") or $this->throwException(mysqli_error($this->_db));
    }

    public function commit()
    {
        $result = mysqli_query($this->_db, "COMMIT") or $this->throwException(mysqli_error($this->_db));
    }

    public function rollback()
    {
        $result = mysqli_query($this->_db, "ROLLBACK") or $this->throwException(mysqli_error($this->_db));
    }

    function throwException($e)
    {
        echo "throw excepriotn";
        throw new Exception($e);
    }

}

?>
