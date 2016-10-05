<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/CourseController.php';


class UserController extends BaseController
{
    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../';
    }
    
    public function createHandler($data = null)
    {
        if (!isset($_POST['submit']))
        {
            FMessages::getInstance()->addMessage(new FMessage("no data", FMessage::TYPE_ERROR));
            
            return new FResponse("no data, no way");
        }
        
        $email = filter_input(INPUT_POST, 'email');
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        $validation = new FFormValidation();
        
        if (!$validation->validate($email, FFormValidation::EMAIL))
        {
            $this->controller->addMessage("wrong email", FMessage::TYPE_ERROR);
        }
        
        if (!$validation->validate($username, FFormValidation::REQUIRED))
        {
            $this->controller->addMessage("username required", FMessage::TYPE_ERROR);
        }
        
        if (!$validation->validate($password, FFormValidation::PASSWORD))
        {
            $this->controller->addMessage("password at least 3 characters", FMessage::TYPE_ERROR);
        }
        
        if (!$validation->isValid())
        {
            return new FRedirect("");
        }
        
        // Check if user with the same email or username exists
//        $userCheck = new FUserModel(FDatabase::getInstance());
        $userCheck = FUserModel::loadByEmail($email);
        
        if (count($userCheck))
        {
            $this->controller->addMessage("email already exists", FMessage::TYPE_ERROR);
            
            return new FRedirect("");
        }
        
        $userCheck = FUserModel::loadByUsername($username);
        
        if (count($userCheck))
        {
            $this->controller->addMessage("username already exists", FMessage::TYPE_ERROR);
            
            return new FRedirect("");
        }
        
        // Create new user
        $user = $this->controller->getUser();
        
        $passwordHash = sha1($password);
        $newAccessToken = bin2hex(openssl_random_pseudo_bytes(24));
        
        $user->username = $username;
        $user->email = $email;        
        $user->password = $passwordHash;
        $user->accessToken = $newAccessToken;
        $user->createDate = FDateTools::getCurrentMysqlDatetime();
        
        $resultSave = $user->insert();
        if ($resultSave)
        {
            $this->controller->addMessage("User created!");
        }
        
        // Login user (to get his new Id)
        $user = FUserModel::login($username, $passwordHash);
        if ($user !== false)
        {
            $this->controller->setUser($user);
            $this->controller->addMessage("Logged in!");
            $this->controller->saveUserToSession();
        }
        
        /*$courseController = new CourseController();
        
        if ($courseController->joinCourse(1))
        {
            $this->controller->addMessage("Course joined!");
        }*/
        
        return new FRedirect();
    }
    
    public function loginHandler($data)
    {
        if (!isset($_POST['submit-login']))
        {
            FMessages::getInstance()->addMessage(new FMessage("no data", FMessage::TYPE_ERROR));
            
            return new FResponse("nmoway");
        }
        
        $username = filter_input(INPUT_POST, 'username-login');
        $password = filter_input(INPUT_POST, 'password-login');
        
        $validation = new FFormValidation();
        $validation->validate($username, FFormValidation::REQUIRED);
        $validation->validate($password, FFormValidation::PASSWORD);
        
        if (!$validation->isValid())
        {
            $this->controller->addMessage("wrong data", FMessage::TYPE_ERROR);
            
            return new FRedirect("");
        }
        
        $passwordHash = sha1($password);
        
        $user = FUserModel::login($username, $passwordHash);
        
        if ($user !== false)
        {
            $this->controller->setUser($user);
            $this->controller->addMessage("Logged in!");
            $this->controller->saveUserToSession();
        }
        else
        {
            $this->controller->addMessage("Wrong login!");
        }
        
        return new FRedirect();
    }
    
    public function logoutHandler($data = null)
    {
        $this->controller->getUser()->logout();
        $this->controller->deleteUserFromSession();
        $this->controller->addMessage("Logged out!");
        
        return new FRedirect();
    }
}
?>