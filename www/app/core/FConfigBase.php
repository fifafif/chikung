<?php

/**
 * Description of Bootstrap
 *
 * @author XiXao
 */
class FConfigBase {
    
    const CONFIG_FILEPATH = '/../config/config.php';
    
    public static $config = NULL;
    
    public function loadSettings() {
        
        $configA = parse_ini_file(dirname(__FILE__) . self::CONFIG_FILEPATH, TRUE);
        
        foreach ($configA as $key => $valueA) {
            $keyA = explode(':', $key);
            if (isset($keyA[1])) {
                $domain = substr($keyA[1], strpos($keyA[1], '=') + 1);
                
                $serverName = $_SERVER['SERVER_NAME'];
                
                if (strpos($serverName, 'www.') === 0) {
                    $serverName = substr($serverName, 4);
                }
                
//                echo 'domain: ' . $domain . ' === ' . $_SERVER['SERVER_NAME'] . '<br>';
                if ($domain === $serverName) {
                    self::$config = $valueA;
                }
            }
           
        }
    }
}

?>