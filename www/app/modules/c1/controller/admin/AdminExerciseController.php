<?php

require_once dirname(__FILE__) . '/../../../common/controller/BaseController.php';
require_once dirname(__FILE__) . '/../../model/entities/C1dayEntity.php';
require_once dirname(__FILE__) . '/../../model/entities/C1exerciseEntity.php';
require_once dirname(__FILE__) . '/../../model/entities/C1userProgressEntity.php';


/**
 * Description of CourseController
 *
 * @author XiXao
 */
class AdminExerciseController extends BaseController
{
    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../../';
    }
    
    public function addHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        if (!isset($_REQUEST['submit']))
        {
            $this->controller->addMessage('Must submit!');
            
            return new FRedirectLink('c1:admin:AdminExercise:showAdd');
        }
        
        $order = filter_input(INPUT_POST, 'order');
        $name = filter_input(INPUT_POST, 'name');
        $desc = filter_input(INPUT_POST, 'desc');
        $video = filter_input(INPUT_POST, 'video');
        $type = filter_input(INPUT_POST, 'type');
        $dayId = filter_input(INPUT_POST, 'dayId');
        
        $validation = new FFormValidation($this->controller);
        $validation->validateWithMessage($name, FFormValidation::REQUIRED, 'Not valid name!');
        $validation->validateWithMessage($desc, FFormValidation::REQUIRED, 'Not valid description!');
        $validation->validateWithMessage($dayId, FFormValidation::REQUIRED, 'Not valid day id!');
        
        
        if (!$validation->isValid())
        {
            return new FRedirectLink('c1:admin:AdminExercise:showAdd');
        }
        
        $exercise = new C1exerciseEntity();
        $exercise->name = $name;
        $exercise->description = $desc;
        $exercise->type = $type;
        $exercise->video = $video;
        $exercise->c1day_id = $dayId;
        
        $this->dataContext->insert($exercise);
        
        return new FRedirectLink('c1:admin:AdminCourse:default');
    }
    
    public function showAddHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $days = $this->dataContext->loadAll(C1dayEntity::class);//->toKeyValuePair('id', 'name');
        
        $formDayData = array_map(function($model) 
            { 
                return array('value' => $model->id, 'text' => $model->name);
            }, $days->toArray());
        
        $this->assign('dayId', $data['dayId']);
        $this->assignByRef('days', $formDayData);
        
        return $this->fetchViewToResponse('admin/index', 'admin/exercise/exercise-add');
    }
    
    public function showHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $id = $data['id'];
        
        $exercise = $this->dataContext->loadByPrimaryKey(C1exerciseEntity::class, $id)->first();
        $this->assignByRef('exercise', $exercise);
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $exercise->c1day_id)->first();
        $this->assignByRef('day', $day);
        
        return $this->fetchViewToResponse('admin/index', 'admin/exercise/exercise');
    }
    
    public function showAllHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $exercises = $this->dataContext->loadAll(C1exerciseEntity::class)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        return $this->fetchViewToResponse('admin/index', 'admin/exercise/exercise-all');
    }
    
    public function showEditHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $id = $data['id'];
        
        $exercise = $this->dataContext->loadByPrimaryKey(C1exerciseEntity::class, $id)->first();
        $this->assignByRef('exercise', $exercise);
        
        $days = $this->dataContext->loadAll(C1dayEntity::class);//->toKeyValuePair('id', 'name');
        $formDayData = array_map(function($model) 
            { 
                return array('value' => $model->id, 'text' => $model->name);
            }, $days->toArray());
        
        $this->assignByRef('days', $formDayData);
        
        return $this->fetchViewToResponse('admin/index', 'admin/exercise/exercise-edit');
    }
    
    public function editHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        if (!isset($_REQUEST['submit']))
        {
            $this->controller->addMessage('Must submit!');
            
            return new FRedirectLink('c1:admin:AdminCourse:default');
        }
        
        $id = $data['id'];
        
        if (!isset($id))
        {
            $this->controller->addMessage('No data!');
            
            return new FRedirectLink('c1:admin:AdminCourse:default');
        }
        
        $order = filter_input(INPUT_POST, 'order');
        $name = filter_input(INPUT_POST, 'name');
        $desc = filter_input(INPUT_POST, 'desc');
        $video = filter_input(INPUT_POST, 'video');
        $type = filter_input(INPUT_POST, 'type');
        $dayId = filter_input(INPUT_POST, 'dayId');
        
        $validation = new FFormValidation($this->controller);
        $validation->validateWithMessage($name, FFormValidation::REQUIRED, 'Not valid name!');
        $validation->validateWithMessage($desc, FFormValidation::REQUIRED, 'Not valid description!');
        $validation->validateWithMessage($dayId, FFormValidation::NUMBER, 'Not valid day id!');
        
        if (!$validation->isValid())
        {
            return new FRedirectLink('c1:admin:AdminExercise:showEdit', array('id' => $id));
        }
        
        $exercise = $this->dataContext->loadByPrimaryKey(C1exerciseEntity::class, $id)->first();
        $exercise->name = $name;
        $exercise->description = $desc;
        $exercise->type = $type;
        $exercise->video = $video;
        $exercise->c1day_id = $dayId;
        
        $this->dataContext->update($exercise);
        
        return new FRedirectLink('c1:admin:AdminExercise:show', array('id' => $id));
    }
    
    public function deleteHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = $data['id'];
        
        $res = $this->dataContext->deleteByPrimaryKey(C1exerciseEntity::class, $id);
        if ($res)
        {
            $this->controller->addMessage('Cvik smazan');
        }
        
        $dayId = $data['dayId'];
        
        if (isset($dayId))
        {
            return new FRedirectLink('c1:admin:AdminDay:showDay', array('id' => $dayId));
        }
        else
        {
            return new FRedirectLink('c1:admin:AdminCourse:default');
        }
    }
    
}
