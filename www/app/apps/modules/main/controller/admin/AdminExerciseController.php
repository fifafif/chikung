<?php

require_once dirname(__FILE__) . '/../BaseController.php';
require_once dirname(__FILE__) . '/../../model/ExerciseModel.php';

/**
 * Description of AdminExerciseController
 *
 * @author XiXao
 */
class AdminExerciseController extends BaseController
{
    public function showAllHandler($data = null)
    {
        $exercises = ExerciseModel::loadAll();
        
        $this->assignByRef('exercises', $exercises);
        
        return $this->fetchViewToResponse('admin/index', 'exercise/exercise-all');
    }
    
    public function addFormHandler($data = null)
    {
        return $this->fetchViewToResponse('admin/index', 'exercise/exercise-add');
    }
    
    public function addHandler($data)
    {
        if (!isset($_POST['submit']))
        {
            FMessages::getInstance()->addMessage(new FMessage("no data", FMessage::TYPE_ERROR));
            
            return new FResponse("no data, no way");
        }
        
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        
        $validation = new FFormValidation();
        
        if (!$validation->validate($name, FFormValidation::REQUIRED))
        {
            $this->controller->addMessage("name required", FMessage::TYPE_ERROR);
        }
        
        if (!$validation->isValid())
        {
            return new FRedirect("");
        }
        
        $exercise = new ExerciseModel();
        $exercise->name = $name;
        $exercise->description = $description;
        
        $resultSave = $exercise->insert();
        if ($resultSave)
        {
            $this->controller->addMessage("Exercise created!");
        }
        
        return new FRedirect("admin/cviceni");
    }
}
