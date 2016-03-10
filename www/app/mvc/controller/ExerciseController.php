<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/UserDataModel.php';
require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';
require_once dirname(__FILE__) . '/../model/UserDayModel.php';

class ExerciseResponse
{
    public $result;
    public $isCompleted;
    public $exerciseId;
    public $completedDayId;
}


class ExerciseController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
   
    
    public function completeHandler($data)
    {
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        FDebug::log("CompleteExerciseHandler", FDebugChannel::SERVICE);
        
        $userId = FController::getInstance()->getUser()->getId();
        
        $progressModel = new UserDataModel(FDatabase::getInstance());
        $progressModel->load($userId);
        
        $exerciseId = $data['exerciseId'];
        $isCompleted = $data['isCompleted'];
        
        $progressModel->parseProgress();
        $progressModel->setExerciseCompletedById($exerciseId, $isCompleted);
        $progressModel->parseProgressToData();
        $progressModel->update();
        
        
        // Check if whole day is completed
        $exVarModel = new ExerciseVariationModel(FDatabase::getInstance());
        $exVarModel->load($exerciseId);
        
        $dayId = $exVarModel->data['day_id'];
        
        $exVarModel->loadByDayId($dayId);
        
        $isDayCompleted = true;
        
        foreach ($exVarModel->data as $exVar)
        {
            if (!$progressModel->isExerciseCompleted($exVar['id']))
            {
                $isDayCompleted = false;
                break;
            }
        }
        
        $this->completeDay($userId, $dayId, $isDayCompleted);
        
        $response = new ExerciseResponse();
        $response->completedDayId = $isDayCompleted ? $dayId : -1;
        $response->isCompleted = $isCompleted;
        $response->exerciseId = $exerciseId;
        $response->result = 1;        
        
        
        return new ResponseDataJson(0, json_encode($response, JSON_FORCE_OBJECT));
    }
    
    private function completeDay($userId, $dayId, $isCompleted)
    {
        $userDayModel = new UserDayModel(FDatabase::getInstance());
        $userDayModel->loadByDayId($userId, $dayId);
        
        if ($isCompleted)
        {
            if (!isset($userDayModel->data))
            {
                $userDayModel->updateValue('day_id', $dayId);
                $userDayModel->updateValue('user_id', $userId);
                $userDayModel->updateValue('completed', 1);
                $userDayModel->save();
            } 
            else if (!$userDayModel->isCompleted())
            {
                $userDayModel->updateValue('completed', 1);
                $userDayModel->update();
            }
        }
        else
        {
            if (isset($userDayModel->data) && $userDayModel->data['completed'])
            {
                $userDayModel->updateValue('completed', 0);
                $userDayModel->update();
            }
        }
    }
    
    
}

?>
