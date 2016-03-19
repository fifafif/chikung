<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/SettingsModel.php';
require_once dirname(__FILE__) . '/../model/DayModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseModel.php';
require_once dirname(__FILE__) . '/../model/ExerciseVariationModel.php';

class StaticDataController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }   
    
    public function getDataHandler($data)
    {
        if (!FController::getInstance()->getLogin()->isGranted())
        {
            return new NotAuthorizedResponse();
        }
        
        FDebug::log("GetDataHandler", FDebugChannel::SERVICE);
        
        $settingsModel = new SettingsModel(FDatabase::getInstance());
        $settingsModel->load();
        
        $respData = array();
        
        $staticDataVersion = $settingsModel->getValue('staticDataVersion');
        
        if ($staticDataVersion == null || !isset($data['version']) || $data['version'] != $staticDataVersion)
        {
            $respData['result'] = 1;
            $respData['version'] = $staticDataVersion;
            $respData['data'] = $this->loadStaticData();
        }
        else
        {
            $respData['result'] = 0;
            $respData['message'] = 'Up to date';
        }
        
        $response = new ResponseDataJson(0, json_encode($respData));
        
        return $response;
    }
    
    private function loadStaticData()
    {
        $staticData = array();
        
        $dayModel = new DayModel(FDatabase::getInstance());
        $dayModel->loadAll();
        
        $staticData['days'] = base64_encode(json_encode($dayModel->data));
        
        $exerciseModel = new ExerciseModel(FDatabase::getInstance());
        $exerciseModel->load();
        
//        print_r(json_encode($exerciseModel->data));
//        print_r(base64_encode(json_encode($exerciseModel->data)));
        
        $staticData['exercises'] = base64_encode(json_encode($exerciseModel->data));
//        $staticData['exercises'] = addslashes(json_encode($exerciseModel->data));
        
        $exerciseVarModel = new ExerciseVariationModel(FDatabase::getInstance());
        $exerciseVarModel->loadAll();
        $staticData['exerciseVariations'] = base64_encode(json_encode($exerciseVarModel->data));
        
        return $staticData;
    }
}

?>
