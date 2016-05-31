<?php

require_once dirname(__FILE__) . '/../../common/controller/BaseController.php';
require_once dirname(__FILE__) . '/../model/entities/C1dayEntity.php';
require_once dirname(__FILE__) . '/../model/entities/C1exerciseEntity.php';
require_once dirname(__FILE__) . '/../model/entities/C1userProgressEntity.php';


/**
 * Description of CourseController
 *
 * @author XiXao
 */
class CourseController extends BaseController
{
    public function showAllDaysHandler($data = null)
    {
        $this->includeSmartySimple();
        
        $days = $this->dataContext->loadAll(C1dayEntity::class)->toArray();
        
        $progressData = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id, $this->getUserId())->toDictionary(C1userProgressEntity::INDEX_c1day_id);
        
        $dayData = array();
        
        foreach ($days as $day)
        {
            $data = array();
            $data['day'] = $day;
            $progress = null;
            if (isset($progressData[$day->id]))
            {
                $progress = $progressData[$day->id];
            }
            $data['progress'] = $progress;
            $dayData[] = $data;
        }
        
        $this->assignByRef('days', $dayData);
        
        $commonTemplate = $this->controller->getModulePath('common') . 'view/index';
        
        return $this->fetchViewToResponse($commonTemplate, 'days');
    }
    
    public function showDayHandler($data = null)
    {
        $this->includeSmartySimple();
        
        $id = filter_input(INPUT_GET, 'day');
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $id)->first();
        $this->assignByRef('day', $day);
        
        $exercises = $this->dataContext->loadByKey(C1exerciseEntity::class, C1exerciseEntity::INDEX_c1day_id, $id)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        $isCompleted = false;
        $userProgress = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $this->getUserId(), $id)->first();
        if ($userProgress != null && $userProgress->state == 1)
        {
            $isCompleted = true;
        }
        
        $this->assign('isCompleted', $isCompleted);
        
        $commonTemplate = $this->controller->getModulePath('common') . 'view/index';
        
        return $this->fetchViewToResponse($commonTemplate, 'day');
    }
    
    public function completeDayHandler($data = null)
    {
        $id = filter_input(INPUT_GET, 'day');
        $userId = $this->controller->getUser()->id;
        
        $count = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $userId, $id)->count();
        if ($count > 0)
        {
            $this->controller->addMessage("Does not compute! Already saved!", FMessage::TYPE_WARNING);
            
            return new FRedirect(FLink::printLinkFromParams('c1:Course:showDay', array('day' => $id)), false);
        }
        
        $userProgress = new C1userProgressEntity();
        $userProgress->c1day_id = $id;
        $userProgress->state = 1;
        $userProgress->user_id = $userId;
        
        $this->dataContext->insert($userProgress);
        
        $this->controller->addMessage("Progress saved!", FMessage::TYPE_INFO);
        
        return new FRedirectLink('c1:Course:showAllDays');
    }
    
    public function uncompleteDayHandler($data = null)
    {
        $id = filter_input(INPUT_GET, 'day');
        $userId = $this->controller->getUser()->id;
        
        $userProgress = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $userId, $id)->first();
        
        if ($userProgress == false)
        {
            $this->controller->addMessage("Does not compute! Already saved!", FMessage::TYPE_WARNING);
            
            return new FRedirect(FLink::printLinkFromParams('c1:Course:showDay', array('day' => $id)), false);
        }
        
        $this->dataContext->delete($userProgress);
        
        $this->controller->addMessage("Progress saved!", FMessage::TYPE_INFO);
        
        return new FRedirectLink('c1:Course:showAllDays');
    }

    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../';
    }
    
            
}
