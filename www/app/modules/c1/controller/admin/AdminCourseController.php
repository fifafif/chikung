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
class AdminCourseController extends BaseController
{
    public function showAllDaysHandler($data = null)
    {
        $this->includeSmarty(dirname(__FILE__) . '/../../', '');
        
        $days = $this->dataContext->loadAll(C1dayEntity::class)->toArray();
        
        $this->assignByRef('days', $days);
        
        $commonTemplate = $this->controller->getModulePath('common') . 'view/templates/index';
        
        return $this->fetchViewToResponse($commonTemplate, 'admin/days');
    }
    
    public function showDayHandler($data = null)
    {
        $this->includeSmarty(dirname(__FILE__) . '/../../', '');
        
        $id = filter_input(INPUT_GET, 'day');
        
        $day = $this->dataContext->loadByPrimaryKey(C1dayEntity::class, $id)->first();
        $this->assignByRef('day', $day);
        
        $exercises = $this->dataContext->loadByKey(C1exerciseEntity::class, C1exerciseEntity::INDEX_c1day_id, $id)->toArray();
        $this->assignByRef('exercises', $exercises);
        
        $commonTemplate = $this->controller->getModulePath('common') . 'view/templates/index';
        
        return $this->fetchViewToResponse($commonTemplate, 'admin/day');
    }
    
    public function completeDayHandler($data = null)
    {
        $this->includeSmarty(dirname(__FILE__) . '/../');
        
        $id = filter_input(INPUT_GET, 'day');
        $userId = $this->controller->getUser()->id;
        
        $count = $this->dataContext->loadByIndex(C1userProgressEntity::class, C1userProgressEntity::INDEX_user_id_c1day_id, $userId, $id)->count();
        if ($count > 0)
        {
            $this->controller->addMessage("Does not compute! Already saved!", FMessage::TYPE_WARNING);
            
            return new FRedirect(FLink::printLinkFromParams('c1:course:showDay', array('day' => $id)), false);
        }
        
        $userProgress = new C1userProgressEntity();
        $userProgress->c1day_id = $id;
        $userProgress->state = 1;
        $userProgress->user_id = $userId;
        
        $this->dataContext->insert($userProgress);
        
        $this->controller->addMessage("Progress saved!", FMessage::TYPE_INFO);
                
        $commonTemplate = dirname(__FILE__) . '/../../common/view/templates/index';
        
        return $this->fetchViewToResponse($commonTemplate, 'day');
    }
}
