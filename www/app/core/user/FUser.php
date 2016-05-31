<?php

require_once dirname(__FILE__) . '/UserEntity.php';

/**
 * Description of FUser
 *
 * @author XiXao
 */
class FUserModel extends UserEntity
{
    protected $_isLogged = false;
    
    
    public function authorizeByToken($token)
    {
        // FDebug::log("token: " . $token, FDebugChannel::NET);
        
        $query = FQuery::getInstance()
                ->create()->select('*')->from('user', 'u')->where('accessToken =', $token, FQueryParam::STRING)->limit(1);
        
        $res = $this->db->execute($query->getQuery());
        
        if (mysqli_num_rows($res) != 1)
        {
            return false;
        }
        
        FDebug::log($res, FDebugChannel::NET);
        
        $this->data = mysqli_fetch_assoc($res);
        $this->id = $this->data['id'];
        $this->_isLogged = true;
        
        return true;
    }

    public static function login($username, $password) 
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user', 'u')
                ->where('username =', $username, FQueryParam::STRING)
                ->whereAnd('password =', $password, FQueryParam::STRING)
                ->limit(1);
        
        $users = self::loadFromDB($query->getQuery());
        
        return reset($users);
    }
    
    public static function loadByUsername($username)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('username =', $username, FQueryParam::STRING);
        
        return self::loadFromDB($query->getQuery());
    }
    
    public static function loadByEmail($email)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('email =', $email, FQueryParam::STRING);
        
        return self::loadFromDB($query->getQuery());
    }
    
    public function logout() 
    {
        $this->_isLogged = false;
    }
    
    public function isLogged() 
    {
        return isset($this->id);
    }
    
    public function getId()     
    {
        return $this->id;
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }
    
    public function isAdmin()
    {
        return $this->hasRole(FLogin::ROLE_ADMIN);
    }

}

?>