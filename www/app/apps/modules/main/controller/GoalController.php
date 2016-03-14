<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/UserDataModel.php';
require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';
require_once dirname(__FILE__) . '/../model/UserDayModel.php';
require_once dirname(__FILE__) . '/../model/UserGoalModel.php';


class GoalDTO
{
    public $id;
    public $title;
    public $type;
    public $priority;
}

class AddGoalResponse
{
    public $result;
    public $goalDTO;
}

class GoalController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
    
    public function addGoalHandler($data)
    {
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        FDebug::log("addGoalHandler", FDebugChannel::SERVICE);
        
        $userId = FController::getInstance()->getUser()->getId();
        $type = $data['type'];
        $priority = isset($data['priority']) ? int($data['priority']) : 0;
        
        $goalModel = new UserGoalModel(FDatabase::getInstance());
        $goalModel->updateValue('user_id', $userId);
        $goalModel->updateValue('type', $type);
        $goalModel->updateValue('priority', $priority);
        $goalModel->updateValue('title', $data['title']);
        
        $this->correctAddGoalPriorityCollisions($userId, $type, $priority);
        
        $goalModel->save();
        
        // Load saved goal to get its id.
        $goalModel->loadByPriority($userId, $type, $priority);
        
        $response = new AddGoalResponse();
        $response->result = 1;
        $response->goalDTO = $this->streamGoal($goalModel);
        
        return new ResponseDataJson(0, json_encode($response, JSON_FORCE_OBJECT));
    }   
    
    // Just editing text right now.
    public function editGoalHandler($data)
    {
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        FDebug::log("editGoalHandler", FDebugChannel::SERVICE);
        
        $userId = FController::getInstance()->getUser()->getId();
//        $type = $data['type'];
//        $priority = $data['priority'];
        
        
        $goalModel = new UserGoalModel(FDatabase::getInstance());
        $goalModel->load($data['id']);
        
        if ($goalModel->getResultRowCount() == 0)
        {
            return new ResponseStatusJson(2, "Does not exists!");
        }
        
        if ($goalModel->data['user_id'] != $userId)
        {
            return new ResponseStatusJson(1, "Does not belong to user!");
        }
        
        if ($priority != $goalModel->data['priority'])
        {
            $this->correctEditGoalPriorityCollisions($userId, $type, $priority);
        }
        
//        $goalModel->updateValue('priority', $priority);
        $goalModel->updateValue('title', $data['title']);
        
        $goalModel->update();
        
        return new ResponseDataJson(0, json_encode($goalModel->data, JSON_FORCE_OBJECT));
    }   
    
    private function correctAddGoalPriorityCollisions($userId, $type, $priority)
    {
        // Correct by priority
        $userGoalsModel = new UserGoalModel(FDatabase::getInstance());
        $userGoalsModel->loadByType($userId, $type);
        
        if ($userGoalsModel->getResultRowCount() > 0)
        {
            // Sort by lowest priority
            usort($userGoalsModel->data, array('GoalController', 'sortByPriority'));

            if ($userGoalsModel->data[0]['priority'] >= $priority)
            {
                foreach ($userGoalsModel->data as $goal)
                {
                    if ($goal['priority'] < $priority)
                    {
                        break;
                    }
                    
                    $goal['priority'] += 1;
                    $userGoalsModel->updateByData($goal);
                }
            }
        }
    }
    
    // TODO: Implement, this does not work for changing!
    private function correctEditGoalPriorityCollisions($userId, $type, $priority)
    {
        // Correct by priority
        $userGoalsModel = new UserGoalModel(FDatabase::getInstance());
        $userGoalsModel->loadByType($userId, $type);
        
        if ($userGoalsModel->getResultRowCount() > 0)
        {
            // Sort by lowest priority
            usort($userGoalsModel->data, array('GoalController', 'sortByPriority'));

            if ($userGoalsModel->data[0]['priority'] >= $priority)
            {
                foreach ($userGoalsModel->data as $goal)
                {
                    if ($goal['priority'] < $priority)
                    {
                        break;
                    }
                    
                    $goal['priority'] += 1;
                    $userGoalsModel->updateByData($goal);
                }
            }
        }
    }
    
    private function sortByPriority($a, $b)
    {
        if ($a['priority'] > $b['priority'])
        {
            return -1;
        }
        else if ($a['priority'] < $b['priority'])
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function streamGoal(UserGoalModel $goal)
    {
        $goalDTO = new GoalDTO();
        $goalDTO->id = $goal->data['id'];
        $goalDTO->title = $goal->data['title'];
        $goalDTO->type = $goal->data['type'];
        $goalDTO->priority = $goal->data['priority'];
        
        return $goalDTO;
    }
}

?>