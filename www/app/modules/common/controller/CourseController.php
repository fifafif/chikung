<?php

require_once dirname(__FILE__) . '/BaseController.php';
require_once dirname(__FILE__) . '/../model/entities/CourseEntity.php';
require_once dirname(__FILE__) . '/../model/entities/UserCourseEntity.php';


/**
 * Description of CourseController
 *
 * @author XiXao
 */
class CourseController extends BaseController
{
    /*function __construct()
    {
        parent::__construct();
    }*/

    public function joinCourse($courseId)
    {
        $userId = $this->controller->getUser()->id;
        
        $course = $this->dataContext->loadByPrimaryKey(CourseEntity::class, $courseId)->first();
        if ($course == false)
        {
            return false;
        }
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = $userId;
        $userCourse->course_id = $course->id;
        
        $res = $this->dataContext->insert($userCourse);
        if ($res == false)
        {
            return fase;
        }
        
        return true;
    }
}
