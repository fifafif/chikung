<?php

/**
 * Description of FLogin
 *
 * @author XiXao
 */
class FLogin {

    private $_controller;
    private $_user;
    
    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    function __construct(FController $controller) 
    {
        $this->_controller = $controller;
    }
    
    public function authorizeUser(AuthData $authData)
    {
        if (!$this->checkUserSession())
        {
            $this->_user = new FUserModel($this->_controller->getDb());
            
            if (isset($authData->authToken))
            {  
                $this->_user->authorizeByToken($authData->authToken);
            }
            else if (isset($authData->sessionId))
            {
                // TODO: Implement
            }
        }
        
        $this->_controller->setUser($this->_user);
    }

    public function createUser() 
    {
        $this->checkUserSession();
        $this->loginCheck();
        $this->logoutCheck();
    }

    /**
     * Skript overi, zda-li se uzivatel pokusil prihlasit.
     *
     * @author XiXao
     */
    public function loginCheck() {

        if (isset($_POST['login'])) 
        {

            /**
             * Zjisteni, je-li uzivatel s heslem a jmenem v databazi.
             */
            $success = $this->_user->login($_POST['user'], $_POST['password']);

            if ($success) 
            {
                $this->saveUserToSession();
                unset($_POST['login']);
            } 
            else {
                FMessages::getInstance()->addMessage(new FMessage('Access denided!', FMessage::TYPE_ERROR));
            }

            $this->_controller->redirect('admin/');
        }
    }

    /**
     * nahrani uzivatele ze session.
     */
    public function checkUserSession() 
    {
        if (isset($_SESSION['user'])) 
        {
            $this->loadUserFromSession();
            
            return true;
        } 
        
        return false;   
    }

    /**
     * Overeni, jestli se uzivatel chtel odhlasit.
     */
    public function logoutCheck() {

        if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            
            unset($_GET['logout']);
            
            $this->_user->logout();
            
            if (isset($_SESSION['user'])) {
                unset($_SESSION['user']);
            }
            
            $this->_controller->reloadWithoutParameters();
        }
    }
    
    public function saveUserToSession() 
    {
        $_SESSION['user'] = serialize($this->_user);
    }
    
    public function deleteUserFromSession()
    {
        unset($_SESSION['user']);
    }
    
    public function loadUserFromSession() 
    {
        $this->_user = unserialize($_SESSION['user']);
    }
    
    public function isGranted($role = 0)
    {
        if ($this->_user->isLogged())
        {
            return true;
        }
        
        return false;
    }

}

?>