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
    protected function getPathToView()
    {
        return dirname(__FILE__) . '/../../';
    }
    
    public function defaultHandler($data = null)
    {
        $this->includeSmartySimple();
        
        $days = $this->dataContext->loadAll(C1dayEntity::class)->toArray();
        
        $this->assignByRef('days', $days);
        
        $commonTemplate = $this->controller->getModulePath('common') . 'view/templates/index';
        
        return $this->fetchViewToResponse('admin/index', 'admin/days');
    }   
}
