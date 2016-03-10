<?php

/**
 * Description of FUser
 *
 * @author XiXao
 */
class FUserModel extends FModelObject 
{
    protected $id;
    protected $_isLogged = false;
    
    function __construct(FDatabase $database)
    {
        parent::__construct($database);
        
        $this->tableName = 'user';
    }

    
    public function authorizeByToken($token)
    {
        // FDebug::log("token: " . $token, FDebugChannel::NET);
        
        $query = FQuery::getInstance()
                ->create()->select('u.id, u.username, u.accessToken')->from('user', 'u')->where('accessToken =', $token, FQueryParam::STRING)->limit(1);
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
                ->select('u.id, u.username, u.email, u.accessToken')
                ->from('user', 'u')
                ->where('username =', $username, FQueryParam::STRING)
                ->whereAnd('password =', $password, FQueryParam::STRING)
                ->limit(1);
        
        $result = $this->db->execute($query->getQuery());
        
        if (mysqli_num_rows($result) == 1) 
        {
            $this->data = mysqli_fetch_assoc($result);
            $this->id = $this->data['id'];
            $this->_isLogged = true;
            
            return true;    
        } 
        else 
        {
            return false;
        }
    }
    
    public function update()
    {
        $query = FQuery::getInstance()->create()
                ->update('user')
                ->set('accessToken', $this->data['accessToken'], FQueryParam::STRING)
                ->where('id =', $this->data['id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function save()
    {
        $query = FQuery::getInstance()->create()
                ->insert('user')
                ->insertValue('username', $this->data['username'], FQueryParam::STRING)
                ->insertValue('email', $this->data['email'], FQueryParam::STRING)
                ->insertValue('password', $this->data['password'], FQueryParam::STRING)
                ->insertValue('accessToken', $this->data['accessToken'], FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function loadByUsername($username)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('username =', $username, FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($result, 1);
    }
    
    public function loadByEmail($email)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('user')
                ->where('email =', $email, FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($result, 1);
    }
    
    public function logout() {
        $this->_isLogged = false;
    }
    
    public function isLogged() {
        return $this->_isLogged;
    }
    
    public function serialize() {
        return serialize(array(
            'data' => $this->data,
            'tableName' => $this->tableName,
            'isLogged' => $this->_isLogged
        ));
    }
    
    public function unserialize($data) {
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



}

?>