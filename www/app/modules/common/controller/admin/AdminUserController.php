<?php

require_once dirname(__FILE__) . '/../BaseController.php';
require_once dirname(__FILE__) . '/../../model/entities/UserCourseEntity.php';
require_once dirname(__FILE__) . '/../../../../core/mvc/view/SmartyComponent.php';

/**
 * Description of AdminUserController
 *
 * @author XiXao
 */
class AdminUserController extends BaseController
{
    protected $smarty;
    
    public function __construct(FController $controller)
    {
        parent::__construct($controller);
    }
    
    public function defaultHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->smarty = new SmartyComponent(dirname(__FILE__) . '/../../');
        $this->smarty->assignBasic($this->controller);
        
        
        $users = $this->dataContext->load(UserEntity::class)->get();
        $userCourses = $this->dataContext->load(UserCourseEntity::class)->toDictionary('user_id');
        
        $userData = array();
        
        foreach ($users as $user)
        {
            $data = array();
            $data['user'] = $user;
            
            if (isset($userCourses[$user->id]))
            {
                $data['courses'] = $userCourses[$user->id];
            }
            
            $userData[] = $data;
        }
        
        $this->assignByRef('users', $users);
        $this->assignByRef('userData', $userData);
        
        return $this->smarty->fetchViewToResponse('index', 'admin/user/overview');
    }
    
    public function showHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->smarty = new SmartyComponent(dirname(__FILE__) . '/../../');
        $this->smarty->assignBasic($this->controller);
        
        $id = filter_input(INPUT_GET, 'id');
        
        $targetUser = $this->dataContext->loadByPrimaryKey(UserEntity::class, $id)->first();
        
        //$userCourses = $this->dataContext->load(UserCourseEntity::class)->toDictionary('user_id');
        
        $this->assignByRef('targetUser', $targetUser);
        
        return $this->smarty->fetchViewToResponse('index', 'admin/user/user');
    }
    
    public function showEditHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $this->smarty = new SmartyComponent(dirname(__FILE__) . '/../../');
        $this->smarty->assignBasic($this->controller);
        
        $id = filter_input(INPUT_GET, 'id');
        
        $targetUser = $this->dataContext->loadByPrimaryKey(UserEntity::class, $id)->first();
        
        $roleData = array(
            array('value' => 0, 'text' => 'Zakladni'),
            array('value' => 1, 'text' => 'Admin')
        );
                
        
        //$userCourses = $this->dataContext->load(UserCourseEntity::class)->toDictionary('user_id');
        
        $this->assignByRef('targetUser', $targetUser);
        $this->assignByRef('roleData', $roleData);
        
        return $this->smarty->fetchViewToResponse('index', 'admin/user/user-edit');
    }
    
    public function editHandler($data = null)
    {
        if (!$this->controller->isAdmin())
        {
            return new NotAuthorizedResponse();
        }
        
        $id = filter_input(INPUT_GET, 'id');
        $role = filter_input(INPUT_POST, 'role');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        
        $targetUser = $this->dataContext->loadByPrimaryKey(UserEntity::class, $id)->first();
        
        if (!isset($targetUser))
        {
            $this->controller->addMessage('User not found! User id = ' . $id, FMessage::TYPE_ERROR);
        }
        
        $targetUser->role = $role;
        $targetUser->username = $username;
        $targetUser->email = $email;
        
        $this->dataContext->update($targetUser);
        
        return new FRedirectLink('common:admin:AdminUser:default');
    }
}
