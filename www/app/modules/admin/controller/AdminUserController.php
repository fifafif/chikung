<?php

require_once dirname(__FILE__) . '/../../common/controller/BaseController.php';
require_once dirname(__FILE__) . '/../../common/model/entities/UserCourseEntity.php';

/**
 * Description of AdminUserController
 *
 * @author XiXao
 */
class AdminUserController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function defaultHandler($data = null)
    {
        $this->includeSmarty(dirname(__FILE__) . '/../');
        
        $users = $this->dataContext->load(UserEntity::class)->get();
        $userCourses = $this->dataContext->load(UserCourseEntity::class)->toDictionary('user_id');
        
        $userData = array();
        
        foreach ($users as $user)
        {
            $userData[] = array('user' => $user, 'courses' => $userCourses[$user->id]);
        }
        
        $this->assignByRef('users', $users);
        $this->assignByRef('userData', $userData);
        
        return $this->fetchViewToResponse('index', 'users/overview');
    }
}
