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
    public static $defaultModule = NULL;
    
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
                    if (isset($valueA['tables']))
                    {
                        $module['tables'] = explode(',', $valueA['tables']);
                    }
                    
                    if (isset($valueA['default']) && $valueA['default'] == true)
                    {
                        self::$defaultModule = $name;
                    }
                    
                    self::$modules[$name] = $module;
                    
                    break;
            }
        }
    }
    
    public static function getDefaultModulePath()
    {
        if (!isset(self::$modules) || !isset(self::$defaultModule))
        {
            return 'main/';
        }
        
        return self::$modules[self::$defaultModule]['path'];
    }
    
    public static function getModulePath($module)
    {
        if (!isset(self::$modules) || !isset(self::$modules[$module]) || !isset(self::$modules[$module]['path']))
        {
            return $module . '/';
        }
        
        return self::$modules[$module]['path'];
    }
}

?>
