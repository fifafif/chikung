<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/UserDataModel.php';
require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/UserDayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';

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

class UserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
    
    public function createHandler($data = null)
    {
        $user = FController::getInstance()->getUser();
        
        // Check if user with the same email or username exists
        $userCheck = new FUserModel(FDatabase::getInstance());
        $userCheck->loadByEmail($data['email']);
        
        if ($userCheck->getResultRowCount() > 0)
        {
            return new ResponseResultJson(2, "email already exists");
        }
        
        $userCheck->loadByUsername($data['username']);
        
        if ($userCheck->getResultRowCount() > 0)
        {
            return new ResponseResultJson(3, "username already exists");
        }
        
        // TODO: Validate email
        
        // Create new user
        $user->updateValue('username', $data['username']);
        $passwordHash = sha1($data['password']);
        $user->updateValue('password', $passwordHash);
        $user->updateValue('email', $data['email']);
        
        $newAccessToken = bin2hex(openssl_random_pseudo_bytes(24));
            
        $user->updateValue('accessToken', $newAccessToken);
        $user->save();
        
        
        // Login user (to get his new Id)
        $user->login($data['username'], $passwordHash);
        
        //$userData = new UserDataModel(FDatabase::getInstance());
        //$userData->updateValue('user_id', $user->data['id']);
        //$userData->save();
        
        $createUserResponse = new CreateUserResponse();
        $createUserResponse->user = $this->streamUser($user);
        $createUserResponse->result = 0;
        
    
        $response = new ResponseDataJson(0, (json_encode($createUserResponse, JSON_FORCE_OBJECT)));

        return $response;
    }
    
    public function loginHandler($data)
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

?>