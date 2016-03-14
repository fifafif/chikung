<?php

require_once dirname(__FILE__) . '/UserEntity.php';

/**
 * Description of FUser
 *
 * @author XiXao
 */
class FUserModel extends UserEntity
{
    protected $id;
    protected $_isLogged = false;
    
    function __construct(FDatabase $database)
    {
        parent::__construct($database);
    }

    
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

    public function login($username, $password) 
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user', 'u')
                ->where('username =', $username, FQueryParam::STRING)
                ->whereAnd('password =', $password, FQueryParam::STRING)
                ->limit(1);
        
        $result = $this->db->execute($query->getQuery());
        
        $this->parseData($result);
        
        if (mysqli_num_rows($result) == 1) 
        {
            $this->id = $this->data[0]['id'];
            $this->_isLogged = true;
            
            return true;    
        } 
        else 
        {
            return false;
        }
    }
    
    public function loadByUsername($username)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('username =', $username, FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
        
        $this->parseData($result);
    }
    
    public function loadByEmail($email)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('email =', $email, FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
        
        $this->parseData($result);
    }
    
    public function logout() 
    {
        $this->_isLogged = false;
    }
    
    public function isLogged() 
    {
        return $this->_isLogged;
    }
    
    public function serialize() 
    {
        return serialize(array
        (
            'data' => $this->data,
            'tableName' => $this->tableName,
            'isLogged' => $this->_isLogged
        ));
    }
    
    public function unserialize($data) 
    {
        $data = unserialize($data);        
        $this->data = $data['data'];
        $this->_isLogged = $data['isLogged'];
        $this->tableName = $data['tableName'];
        $this->model = FModel::getInstance();
        $this->db = FDatabase::getInstance();        
    }
    
    public function getId()     
    {
        return $this->id;
    }

    public function hasRole($role)
    {
        return $this->getValue(UserEntity::FIELD_ROLE) === $role;
    }
    
    public function isAdmin()
    {
        return $this->hasRole(1);
    }

}

?>