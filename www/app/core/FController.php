<?php

require_once dirname(__FILE__) . '/../config/Params.php';
require_once dirname(__FILE__) . '/FConfigBase.php';

require_once dirname(__FILE__) . '/net/request/RequestDecoder.php';
require_once dirname(__FILE__) . '/net/response/IResponseable.php';
require_once dirname(__FILE__) . '/net/response/FResponse.php';
require_once dirname(__FILE__) . '/net/response/FRedirect.php';

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
class FController 
{

    private $db;
    private $user;
    private $moduleName;
    private $gate;
    /* @var $_messages FMessages */
    private $_messages;
    private $model;
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

        $this->_messages = FMessages::getInstance();
        $this->_messages->loadMessages();
        
        $this->model = new FModel($this->db);
    }
    
    public function getMessages()
    {
        return $this->_messages;
    }

    public static function getInstance() {

        if (!isset(self::$instance)) {
            self::$instance = new FController();
        }
        return self::$instance;
    }
    
    public function getModel()
    {
        return $this->model;
    }

    public function connectDB() 
    {        
        $this->db = FDatabase::getInstance();
        $this->db->connect(FConfigBase::$config['db_host'], FConfigBase::$config['db_username'], FConfigBase::$config['db_password'], FConfigBase::$config['db_name']);
    }

    public function handleRequest()
    {
        FDebug::log("=== Begin request ===", FDebugChannel::NET);
        
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
    
    public function saveUserToSession()
    {
        $this->login->saveUserToSession();
    }
    
    public function deleteUserFromSession()
    {
        $this->login->deleteUserFromSession();
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

        return $this->moduleName . $this->request->controller . 'Controller.php';
    }
    
    public function getControllerPath()
    {
        $path = dirname(__FILE__) . '/../modules/';
        
        if (isset($this->request->module))
        {
            $path .= FConfigBase::getModulePath($this->request->module);
        }
        else
        {
            $path .= FConfigBase::getDefaultModulePath();
        }
        
        $path .= "controller/";
        
        if (isset($this->request->gate))
        {
            $path .= $this->request->gate . "/";
        }
        
        return $path;
    }

    private function executeRequestController() 
    {
        if (!isset($this->request))
        {
            return;
        }
        
        $controllerFilePath = $this->getControllerPath() . $this->getControllerFilename();
        
        FDebug::log("Loading controller: " . $this->request->controller . " -> " . $this->request->handler . " at path: $controllerFilePath", FDebugChannel::SYSTEM);
        
        if (!file_exists($controllerFilePath)) 
        {
            FDebug::log("Controller: " . $controllerFilePath . " does not exist!", FDebugChannel::SYSTEM);
            
            return;
        }

        include $controllerFilePath;

        $className = $this->getControllerName() . 'Controller';

        $controllerClass = new $className();
        $function = $this->request->handler . self::REQUEST_FN_SUFFIX;
        
        FDebug::log("Executing controller: " . $className . " -> " . $function, FDebugChannel::SYSTEM);
        
        // Execute controller with handler function
        $this->response = $controllerClass->$function($this->request->data);
        
        FDebug::log("=== End request ===", FDebugChannel::SYSTEM);
    }

    public function setLanguage($language = 'cs_CZ') {
        setlocale(LC_ALL, $language);
    }

    
    public function requireUserLogged() 
    {
        return isset($this->user) && $this->user->isLogged();
    }
    
    public function requireAdmin()
    {
        if (!$this->requireUserLogged())
        {
            return false;
        }
        
        return $this->user->isAdmin();
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
    
    public function addMessage($message, $type = FMessage::TYPE_INFO)
    {
        $this->_messages->addMessage(new FMessage($message, $type));
    }
    


}

?>