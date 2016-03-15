<?php

require_once dirname(__FILE__) . '/BaseController.php';
//require_once dirname(__FILE__) . '/../model/UserDataModel.php';
require_once dirname(__FILE__) . '/../../../../core/forms/FFormValidation.php';
/*require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/UserDayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';*/



class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
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
        
        $this->assignBase();
        
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
        
        print_r($user);
        
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
        
    function loginToken($data = null)
    {
        FDebug::log("login handler", FDebugChannel::SERVICE);
        
        $user = FController::getInstance()->getUser();
        
        if (!$user->login($data['username'], sha1($data['password'])))
        {
            $response = new ResponseStatusJson(1, "Wrong login information!");
        
            return $response;
        }
        
        $newAccessToken = bin2hex(openssl_random_pseudo_bytes(24));
        FDebug::log($newAccessToken, FDebugChannel::SERVICE);

        $user->data['accessToken'] = $newAccessToken;

        $user->update();

        $userDataResponse = $this->buildUserDataResponse($user);

        $response = new ResponseDataJson(0, (json_encode($userDataResponse, JSON_FORCE_OBJECT)));

        return $response;       
    }
    
    public function getUserDataHandler($data)
    {
        FDebug::log("getUserData handler", FDebugChannel::SERVICE);
        
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        $user = FController::getInstance()->getUser();
        
        $userDataResponse = $this->buildUserDataResponse($user);
        
        $response = new ResponseDataJson(0, (json_encode($userDataResponse, JSON_FORCE_OBJECT)));

        return $response;
    }
    
    public function updateUserDataHandler($data)
    {
        FDebug::log("updateUserDataHandler", FDebugChannel::SERVICE);
        
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        $user = FController::getInstance()->getUser();
        
        $progress = $this->loadUserProgress($user);
        $newProgressMap = $data['progress'];
        foreach ($newProgressMap as $exerciseId => $isCompleted)
        {
            $progress->setExerciseCompletedById($exerciseId, $isCompleted);
        }
        $progress->update();
        
        $userDataResponse = new UpdateUserDataResponse();
        $userDataResponse->progress = $progress->getExerciseCompleted();
        $userDataResponse->result = 1;
        
        $response = new ResponseDataJson(0, (json_encode($userDataResponse, JSON_FORCE_OBJECT)));

        return $response;
    }

    public function startProgressHandler($data)
    {
        FDebug::log("startProgress handler", FDebugChannel::SERVICE);
        
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        $user = FController::getInstance()->getUser();
        $ndUserModel = new UserDataModel(FDatabase::getInstance());
        $ndUserModel->load($user->getId());
        
        if ($ndUserModel->data['hasStarted'] == 1)
        {   
            return new ResponseResultJson(1, "Already started!");
        }
        else
        {
            date_default_timezone_set("UTC");
            $time = time();
            $startDate = date("Y-m-d H:i:s", $time);
            
            $ndUserModel->updateValue('hasStarted', 1);
            $ndUserModel->updateValue('startDate', $startDate);
            $ndUserModel->update();
                        
            $dayModel = new UserDayModel(FDatabase::getInstance());
            $dayModel->updateValue('user_id', $user->getId());
            $dayModel->updateValue('day_id', 1);
            $dayModel->updateValue('effectiveDate', $startDate);
            $dayModel->save();
            
            return new ResponseResultJson(0);
        }
    }
    
    
    // ====================================================================================================
    // END HANDLERS ===============================================================================================
    // ====================================================================================================
    
    private function loadUserProgress($user)
    {
        // Load user's progress
        $progressModel = new UserDataModel(FDatabase::getInstance());
        $progressModel->load($user->data['id']);
        $progressModel->parseProgress();

        return $progressModel;
    }
    
    private function buildUserDataResponse($user)
    {
        $userDataResponse = new UserDataResponse();
        $userDataResponse->user = $this->streamUser($user);
        
        $ndUserModel = $this->loadUserProgress($user); 
        
        $userDataResponse->ndUser = $this->streamNDUser($ndUserModel);
        $userDataResponse->progress = $ndUserModel->getExerciseCompleted();

        
        return $userDataResponse;
    }
    
    private function streamUser($user)
    {
        $userDTO = new UserDTO();
        $userDTO->id = $user->data['id'];
        $userDTO->username = $user->data['username'];
        $userDTO->accessToken = $user->data['accessToken'];
        
        return $userDTO;
    }
    
    private function streamNDUser($ndUser)
    {
        $userDTO = new NDUserDTO();
        $userDTO->hasStarted = $ndUser->data['hasStarted'] ? true : false;
        $userDTO->progress = $ndUser->data['exerciseCompleted'];
        $userDTO->alarmTimes = $ndUser->data['alarmTimes'];
        
        return $userDTO;
    }
}

class UserDTO
{
    public $id;
    public $username;
    public $accessToken;
}

class NDUserDTO
{
    public $progress;
    public $hasStarted;
    public $alarmTimes;
}

class UserDataResponse
{
    public $user;
    public $ndUser;
    public $progress;
}

class CreateUserResponse
{
    public $user;
    public $result;
}

class UpdateUserDataResponse
{
    public $progress;
    public $result;
}

?>