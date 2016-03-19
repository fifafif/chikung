<?php

/**
 * Description of Bootstrap
 *
 * @author XiXao
 */
class FConfigBase {
    
    const CONFIG_FILEPATH = '/../config/config.php';
    
    public static $config = NULL;
    public static $modules = NULL;
    
    public function loadSettings() {
        
        $configA = parse_ini_file(dirname(__FILE__) . self::CONFIG_FILEPATH, TRUE);
        
        $serverName = '';
        
        if (isset($_SERVER['SERVER_NAME']))
        {
            $serverName = $_SERVER['SERVER_NAME'];
        }
        else  
        {
            $serverName = 'localhost';
        }
        
        self::$modules = array();
        
        foreach ($configA as $key => $valueA) 
        {
            $keyA = explode(':', $key);
            
            switch ($keyA[0])
            {
                case "dev":
                case "prod":
                    
                    if (!isset(self::$config))
                    {
                        if (isset($keyA[1])) 
                        {
                            $domain = substr($keyA[1], strpos($keyA[1], '=') + 1);

                            if (strpos($serverName, 'www.') === 0) 
                            {
                                $serverName = substr($serverName, 4);
                            }

                            if ($domain === $serverName) 
                            {
                                self::$config = $valueA;
                            }
                        }
                    }
                    break;
                    
                case 'module':
                    
                    $name = substr($keyA[1], strpos($keyA[1], '=') + 1);
                    
                    $module = array();
                    $module['name'] = $name;
                    $module['path'] = $valueA['path'];
                    $module['tables'] = explode(',', $valueA['tables']);
                    
                    self::$modules[$name] = $module;
                    
                    break;
            }
        }
    }
}

?>
