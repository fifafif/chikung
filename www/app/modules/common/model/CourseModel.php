<?php

require_once dirname(__FILE__) . '/entities/CourseEntity.php';
require_once dirname(__FILE__) . '/entities/UserCourseEntity.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CourseModel
 *
 * @author Purchaser
 */
class CourseModel
{
    private $dataContext;
    
    function __construct($dataContext)
    {
        $this->dataContext = $dataContext;
    }

    public function joinCourse($userId, $courseId)
    {
        $course = $this->dataContext->loadByPrimaryKey(CourseEntity::class, $courseId)->first();
        if ($course == false)
        {
            return false;
        }
        
        $userCourse = new UserCourseEntity();
        $userCourse->user_id = $userId;
        $userCourse->course_id = $course->id;
        $userCourse->status = 1;
        
        $res = $this->dataContext->insert($userCourse);
        if ($res == false)
        {
            return fase;
        }
        
        return true;
    }
    
    public function isCourseActivated($userId, $courseId)
    {
        $course = $this->dataContext->loadByIndex(UserCourseEntity::class, UserCourseEntity::INDEX_user_id_course_id, $userId, $courseId)->first();
        
        return $course != false && $course->status == 1;
    }
}
