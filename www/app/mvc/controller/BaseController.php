<?php

//require_once dirname(__FILE__) . '/../config/Settings.php';

define('SMARTY_DIR',str_replace("\\","/",dirname(__FILE__)).'/../../plugins/smarty/');
require_once(SMARTY_DIR . 'Smarty.class.php');

/**
 * Description of BaseController
 *
 * @author XiXao
 */
class BaseController
{
    protected $smarty;
    
    public function __construct()
    {
        $this->smarty = new Smarty();
        
        $this->smarty->setTemplateDir(dirname(__FILE__) . '/../view/templates/');
        $this->smarty->setCompileDir(dirname(__FILE__) . '/../view/templates_c/');
        $this->smarty->setConfigDir(dirname(__FILE__) . '/../view/configs/');
        $this->smarty->setCacheDir(dirname(__FILE__) . '/../view/cache/');

        $this->smarty->assign('name','Ned');

        //** un-comment the following line to show the debug console
        $this->smarty->debugging = true;

        
    }
    
    protected function fetchViewOutput()
    {
        return $this->smarty->fetch('index.tpl');
    }

}

?>
