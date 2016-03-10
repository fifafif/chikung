<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/UserDataModel.php';
require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';
require_once dirname(__FILE__) . '/../model/UserDayModel.php';

class DayController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
    
    public function setDateHandler($data)
    {
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        FDebug::log("setDateHandler", FDebugChannel::SERVICE);
        
        $userId = FController::getInstance()->getUser()->getId();
        
        $dayId = $data['id'];
        $date = FDateTools::convertToMysqlDate($data['date']);
        
        $userDayModel = new UserDayModel(FDatabase::getInstance());
        $userDayModel->loadByDayId($userId, $dayId);
        
        if (!isset($userDayModel->data))
        {
            $userDayModel->updateValue('day_id', $dayId);
            $userDayModel->updateValue('user_id', $userId);
            $userDayModel->updateValue('effectiveDate', $date);
            $userDayModel->save();
        }
        else
        {
            $userDayModel->updateValue('effectiveDate', $date);
            $userDayModel->update();
        }
        
        return new ResponseOKJson();
    }    
}

?>
