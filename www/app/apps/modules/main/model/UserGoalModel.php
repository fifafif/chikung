<?php

class UserGoalModel extends FModelObject
{
    protected $dataTypes = array('id' => 0, 'user_id' => 0, 'type' => 0, 'priority' => 0, 'title' => 2);
    
    public function loadByUserId($userId)
    {
        $query = FQuery::getInstance()->create()
                ->select('g.id, g.user_id, g.type, g.title, g.priority')
                ->from('userGoal', 'g')
                ->where('user_id =', $userId, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, -1, true);
    }
    
    public function loadByType($userId, $type)
    {
        $query = FQuery::getInstance()->create()
                ->select('g.id, g.user_id, g.type, g.title, g.priority')
                ->from('userGoal', 'g')
                ->where('user_id =', $userId, FQueryParam::INT)
                ->whereAnd('type =', $type, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, -1, true);
    }
    
    public function loadByPriority($userId, $type, $priority)
    {
        $query = FQuery::getInstance()->create()
                ->select('g.id, g.user_id, g.type, g.title, g.priority')
                ->from('userGoal', 'g')
                ->where('user_id =', $userId, FQueryParam::INT)
                ->whereAnd('type =', $type, FQueryParam::INT)
                ->whereAnd('priority =', $priority, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function load($id)
    {
        $query = FQuery::getInstance()->create()
                ->select('g.id, g.user_id, g.type, g.title, g.priority')
                ->from('userGoal', 'g')
                ->where('id =', $id, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function update()
    {
        $this->updateValue($this->data);
        /*$query = FQuery::getInstance()->create()
                ->update('userGoal')
                ->set('type', $this->data['type'], FQueryParam::INT)
                ->setNext('priority', $this->data['priority'], FQueryParam::INT)
                ->setNext('title', $this->data['title'], FQueryParam::INT)
                ->where('id =', $this->data['id'], FQueryParam::INT)
                ->whereAnd('user_id =', $this->data['user_id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());*/
    }
    
    public function updateByData($data)
    {
        $query = FQuery::getInstance()->create()
                ->update('userGoal')
                ->set('type', $data['type'], FQueryParam::INT)
                ->setNext('priority', $data['priority'], FQueryParam::INT)
                ->setNext('title', $data['title'], FQueryParam::STRING)
                ->where('id =', $data['id'], FQueryParam::INT)
                ->whereAnd('user_id =', $data['user_id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    
    public function save()
    {
        $query = FQuery::getInstance()->create()
                ->insert('userGoal')
                ->insertValue('user_id', $this->data['user_id'], FQueryParam::INT)
                ->insertValue('type', $this->data['type'], FQueryParam::INT)
                ->insertValue('priority', $this->data['priority'], FQueryParam::INT)
                ->insertValue('title', $this->data['title'], FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
    }
    
}

?>
