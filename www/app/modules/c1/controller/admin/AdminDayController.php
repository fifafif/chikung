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
class AdminDayController extends BaseController
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
            
            return new FRedirectLink('c1:admin:AdminDay:showAdd');
        }
        
        $order = filter_input(INPUT_POST, 'order');
        $name = filter_input(INPUT_POST, 'name');
        $desc = filter_input(INPUT_POST, 'description');
        
        $validation = new FFormValidation($this->controller);
        $validation->validateWithMessage($name, FFormValidation::REQUIRED, 'Not valid name!');
        
        if (!$validation->isValid())
        {
            return new FRedirectLink('c1:admin:AdminDay:showAdd');
        }
        
        $day = new C1dayEntity();
        $day->name = $name;
        $day->description = $desc;
        $day->order = $order;
        
        $this->dataContext->insert($day);
        
        return new FRedirectLink('c1:admin:AdminCourse:default');
    }
    
    public function showAddHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        return $this->fetchViewToResponse('admin/index', 'admin/days/day-add');
    }
    
    public function showDayHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }   
        
        $this->includeSmartySimple();
        
        $id = filter_input(INPUT_GET, 'day');
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $id)->first();
        $this->assignByRef('day', $day);
        
        $exercises = $this->dataContext->loadByKey(C1exerciseEntity::class, C1exerciseEntity::INDEX_c1day_id, $id)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        return $this->fetchViewToResponse('admin/index', 'admin/days/day');
    }
    
    public function showEditHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $id = filter_input(INPUT_GET, 'day');
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $id)->first();
        $this->assignByRef('day', $day);
        
        $exercises = $this->dataContext->loadByKey(C1exerciseEntity::class, C1exerciseEntity::INDEX_c1day_id, $id)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        return $this->fetchViewToResponse('admin/index', 'admin/days/day-edit');
    }
    
    public function editHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = filter_input(INPUT_GET, 'day');
        
        if (!isset($_REQUEST['submit']))
        {
            $this->controller->addMessage('Must submit!');
            
            return new FRedirectLink('c1:admin:AdminDay:showEdit', array('day' => $id));
        }
        
        $order = filter_input(INPUT_POST, 'order');
        $name = filter_input(INPUT_POST, 'name');
        $desc = filter_input(INPUT_POST, 'description');
        
        $validation = new FFormValidation($this->controller);
        $validation->validateWithMessage($id, FFormValidation::REQUIRED, 'Not valid id!');
        $validation->validateWithMessage($name, FFormValidation::REQUIRED, 'Not valid name!');
        
        if (!$validation->isValid())
        {
            return new FRedirectLink('c1:admin:AdminDay:showEdit', array('day' => $id));
        }
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $id)->first();
        
        if ($day == null)
        {
            $this->controller->addMessage('Must submit!');
            
            return new FRedirectLink('c1:admin:AdminDay:showEdit');
        }
        
        $day->name = $name;
        $day->description = $desc;
        $day->order = $order;
        
        $res = $this->dataContext->update($day);
        if ($res)
        {
            $this->controller->addMessage('Day updated');
        }
        else
        {
            $this->controller->addMessage('Day update failed!');
        }
        
        return new FRedirectLink('c1:admin:AdminDay:showDay', array('day' => $id));
    }
    
    public function deleteHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = filter_input(INPUT_GET, 'day');
        
        $res = $this->dataContext->deleteByPrimaryKey(C1dayEntity::class, $id);
        if ($res)
        {
            $this->controller->addMessage('Day deleted');
        }
        
        return new FRedirectLink('c1:admin:AdminCourse:default');
    }
    
}
