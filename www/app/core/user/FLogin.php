<?php

/**
 * Description of FLogin
 *
 * @author XiXao
 */
class FLogin {

    private $_controller;
    
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
            $user = new FUserModel($this->_controller->getDb());
            
            if (isset($authData->authToken))
            {  
                $user->authorizeByToken($authData->authToken);
            }
            else if (isset($authData->sessionId))
            {
                // TODO: Implement
            }
            
            $this->_controller->setUser($user);            
        }
    }

    /**
     * nahrani uzivatele ze session.
     */
    public function checkUserSession() 
    {
        if (isset($_SESSION['user'])) 
        {
            $user = $this->loadUserFromSession();
            $this->_controller->setUser($user);
            
            return true;
        } 
        
        return false;   
    }
    
    public function saveUserToSession() 
    {
        $_SESSION['user'] = serialize($this->_controller->getUser());
    }
    
    public function deleteUserFromSession()
    {
        unset($_SESSION['user']);
    }
    
    public function loadUserFromSession() 
    {
        return unserialize($_SESSION['user']);
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