<?php

require_once dirname(__FILE__) . '/../../common/controller/BaseController.php';
require_once dirname(__FILE__) . '/../../common/model/CourseModel.php';
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
        if (!$this->isCourseActivated())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $days = $this->dataContext
                ->loadAll(C1dayEntity::class)
                ->sort(C1dayEntity::FIELD_order)
                ->toArray();
        
        $progressData = $this->dataContext
                ->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id, $this->getUserId())
                ->toDictionary(C1userProgressEntity::INDEX_c1day_id);
        
        $dayData = array();
        
        $completedDaysCount = 0;
        
        foreach ($days as $day)
        {
            $data = array();
            $data['day'] = $day;
            $progress = null;
            if (isset($progressData[$day->id]))
            {
                $progress = $progressData[$day->id];
                
                if ($progress->state == 1)
                {
                    ++$completedDaysCount;
                }
            }
            
            $data['progress'] = $progress;
            $dayData[] = $data;
        }
        
        $this->assign('completedDaysCount', $completedDaysCount);
        $this->assignByRef('days', $dayData);
        
        //$commonTemplate = $this->controller->getModulePath('common') . 'view/index';
        //return $this->fetchViewToResponse($commonTemplate, 'days');
        
        return $this->fetchViewToResponse('index', 'days');
    }
    
    public function showDayHandler($data = null)
    {
        if (!$this->isCourseActivated())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $id = filter_input(INPUT_GET, 'id');
        
        $days = $this->dataContext
                ->loadAll(C1dayEntity::class)
                ->toDictionary(C1dayEntity::INDEX_id);
        
        if (!isset($days[$id]))
        {
            $this->controller->addMessage("Den nenalezen! Den id: $id.");
            
            return new FRedirectLink('c1:Course:showAllDays');
        }
        
        $selectedDay = $days[$id];
        $this->assignByRef('day', $selectedDay);
        
        $prevDay = null;
        $nextDay = null;
        
        $day = null;
        
        foreach ($days as $day)
        {
            if ($day->order < $selectedDay->order
                && (!isset($prevDay) || $day->order > $prevDay->order))
            {
                $prevDay = $day;
            }
            
            if ($day->order > $selectedDay->order
                && (!isset($nextDay) || $day->order < $nextDay->order))
            {
                $nextDay = $day;
            }
        }
        
        $exercises = $this->dataContext->loadByKey(C1exerciseEntity::class, C1exerciseEntity::INDEX_c1day_id, $id)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        $prevDayId = isset($prevDay) ? $prevDay->id : -1;
        $nextDayId = isset($nextDay) ? $nextDay->id : -1;
        
        $this->assign('prevDayId', $prevDayId);
        $this->assign('nextDayId', $nextDayId);
        
        $isCompleted = false;
        $userProgress = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $this->getUserId(), $id)->first();
        if ($userProgress != null && $userProgress->state == 1)
        {
            $isCompleted = true;
        }
        
        $this->assign('isCompleted', $isCompleted);
        
        //$commonTemplate = $this->controller->getModulePath('common') . 'view/index';
        //return $this->fetchViewToResponse($commonTemplate, 'day');
        return $this->fetchViewToResponse('index', 'day');
    }
    
    public function completeDayHandler($data = null)
    {
        if (!$this->isCourseActivated())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = filter_input(INPUT_GET, 'id');
        $userId = $this->controller->getUser()->id;
        
        $count = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $userId, $id)->count();
        if ($count > 0)
        {
            $this->controller->addMessage("Does not compute! Already saved!", FMessage::TYPE_WARNING);
            
            return new FRedirect(FLink::printLinkFromParams('c1:Course:showDay', array('id' => $id)), false);
        }
        
        $userProgress = new C1userProgressEntity();
        $userProgress->c1day_id = $id;
        $userProgress->state = 1;
        $userProgress->user_id = $userId;
        $userProgress->completedOn = FDateTools::getCurrentMysqlDatetime();
        
        $this->dataContext->insert($userProgress);
        
        $this->controller->addMessage("Progress saved!", FMessage::TYPE_INFO);
        
        return new FRedirectLink('c1:Course:showAllDays');
    }
    
    public function uncompleteDayHandler($data = null)
    {
        if (!$this->isCourseActivated())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = filter_input(INPUT_GET, 'id');
        $userId = $this->controller->getUser()->id;
        
        $userProgress = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $userId, $id)->first();
        
        if ($userProgress == false)
        {
            $this->controller->addMessage("Does not compute! Already saved!", FMessage::TYPE_WARNING);
            
            return new FRedirect(FLink::printLinkFromParams('c1:Course:showDay', array('id' => $id)), false);
        }
        
        $this->dataContext->delete($userProgress);
        
        $this->controller->addMessage("Progress saved!", FMessage::TYPE_INFO);
        
        return new FRedirectLink('c1:Course:showAllDays');
    }
    
    public function showExerciseHandler($data = null)
    {
        if (!$this->isCourseActivated())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->includeSmartySimple();
        
        $id = filter_input(INPUT_GET, 'id');
        
        $exercise = $this->dataContext->loadByPrimaryKey(C1exerciseEntity::class, $id)->first();
        $this->assignByRef('exercise', $exercise);
        
        //$commonTemplate = $this->controller->getModulePath('common') . 'view/index';
        //return $this->fetchViewToResponse($commonTemplate, 'exercise');
        return $this->fetchViewToResponse('index', 'exercise');
    }

    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../';
    }
    
    protected function isCourseActivated()
    {
        $courseModel = new CourseModel($this->dataContext);
        
        return $courseModel->isCourseActivated($this->controller->getUser()->id, 1);
    }
    
            
}
