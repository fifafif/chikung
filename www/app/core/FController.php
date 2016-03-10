<?php

require_once dirname(__FILE__) . '/../config/Params.php';
require_once dirname(__FILE__) . '/FConfigBase.php';

require_once dirname(__FILE__) . '/net/request/RequestDecoder.php';
require_once dirname(__FILE__) . '/net/response/FResponse.php';

// TODO: Move somewhere else
require_once dirname(__FILE__) . '/net/response/NotAuthorizedResponse.php';
require_once dirname(__FILE__) . '/net/response/NotAuthorizedResponseJson.php';
require_once dirname(__FILE__) . '/net/response/ResponseOK.php';
require_once dirname(__FILE__) . '/net/response/ResponseOKJson.php';
require_once dirname(__FILE__) . '/net/response/ResponseErrorJson.php';
require_once dirname(__FILE__) . '/net/response/ResponseDataJson.php';
require_once dirname(__FILE__) . '/net/response/ResponseResultJson.php';

require_once dirname(__FILE__) . '/database/FDatabase.php';
require_once dirname(__FILE__) . '/database/FQuery.php';
require_once dirname(__FILE__) . '/FModel.php';
require_once dirname(__FILE__) . '/FModelObject.php';
require_once dirname(__FILE__) . '/messages/FMessage.php';
require_once dirname(__FILE__) . '/messages/FMessages.php';

require_once dirname(__FILE__) . '/utils/FDateTools.php';

require_once dirname(__FILE__) . '/user/FLogin.php';
require_once dirname(__FILE__) . '/user/FUser.php';



/**
 * Description of Controller
 *
 * @author XiXao
 */
class FController {

    private $db;
    private $user;
    private $_page;
    private $_dirGate;
    private $_messages;
    private static $instance;
    
    private $request;
    private $response;
    private $authData;
    private $login;
    
    
    const DEFAULT_CONTROLLER = 'Default';
    const REQUEST_FN_SUFFIX = 'Handler';

    private function __construct() {

        $config = new FConfigBase;
        $config->loadSettings();

        $this->connectDB();

        FMessages::checkMessages();
        $this->_messages = FMessages::getInstance();
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new FController();
        }
        return self::$instance;
    }

    public function connectDB() 
    {        
        $this->db = FDatabase::getInstance();
        $this->db->connect(FConfigBase::$config['db_host'], FConfigBase::$config['db_username'], FConfigBase::$config['db_password'], FConfigBase::$config['db_name']);
    }

    public function handleRequest()
    {
        $requestDecoder = new RequestDecoder();
        $requestDecoder->decodeRequest($_REQUEST);
        
        $this->request = $requestDecoder->getRequest();
        $this->authData = $requestDecoder->getAuthData();
        
        $this->authorizeUser();
        
        $this->executeRequestController();
        
        $this->returnResponse();
    }
    
    private function authorizeUser()
    {
        $this->user = new FUserModel($this->db);
        
        $this->login = new FLogin($this);
        $this->login->authorizeUser($this->authData);
    }

    public function getDb() {

        return $this->db;
    }

    public function setDb($db) {

        $this->db = $db;
    }

    public function getUser() {

        return $this->user;
    }

    public function setUser(FUserModel $user) {

        $this->user = $user;
    }

    public function getControllerName() 
    {
        return $this->request->controller;
    }

    public function getControllerFilename() {

        return $this->_dirGate . $this->request->controller . 'Controller.php';
    }

    private function executeRequestController() 
    {
        if (!isset($this->request))
        {
            return;
        }
        
        FDebug::log("Loading controller: " . $this->request->controller . " -> " . $this->request->handler, FDebugChannel::SYSTEM);
        
        if (!file_exists(dirname(__FILE__) . '/../mvc/controller/' . $this->getControllerFilename())) 
        {
            return;
        }

        include dirname(__FILE__) . '/../mvc/controller/' . $this->getControllerFilename();

        $className = $this->getControllerName() . 'Controller';

        $controllerClass = new $className();
        $function = $this->request->handler . self::REQUEST_FN_SUFFIX;
        
        FDebug::log("Executing controller: " . $className . " -> " . $function, FDebugChannel::SYSTEM);
        
        // Execute controller with handler function
        $this->response = $controllerClass->$function($this->request->data);
        
        FDebug::log("Controller executed", FDebugChannel::SYSTEM);
    }

    public function displayIndex() {

        header('Content-type: text/html; charset=utf-8');

//        $viewGate = isset($_REQUEST[Params::VIEW_GATE]) ? $_REQUEST[Params::VIEW_GATE] : '';
        include dirname(__FILE__) . '/../view/' . $this->_dirGate . 'index.php';
    }

    public function displayPage() {

        if ($this->_page != '') {
            include dirname(__FILE__) . '/../view/' . $this->getPageViewFilename();
        }
    }



    public function setLanguage($language = 'cs_CZ') {
        setlocale(LC_ALL, $language);
    }

    
    public function requireUserLogged($pageToRedirect = '/index.php', $messageWhenFail = null) 
    {
        if (!isset($this->user) || !$this->user->isLogged()) {

            if ($messageWhenFail) 
            {
                $this->_messages->addMessage($messageWhenFail);
            }
            
            $this->redirect($pageToRedirect);
        }
    }
    
    public function returnResponse()
    {
        if (isset($this->response))
        {
            $this->response->sendResponse();
        }
    }
    
    public function getLogin()     
    {
        return $this->login;
    }


}

?>