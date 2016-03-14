<?php

class UserDayModel extends FModelObject
{    
    public function load($userId)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('userDay', 'd')
                ->where('user_id =', $userId, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res);
    }
    
    public function loadByDayId($userId, $dayId)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('userDay', 'd')
                ->where('user_id =', $userId, FQueryParam::INT)
                ->whereAnd('day_id =', $dayId, FQueryParam::INT);
                
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function update()
    {
        $query = FQuery::getInstance()->create()
                ->update('userDay')
                ->set('completed', $this->data['completed'], FQueryParam::INT)
                ->setNext('effectiveDate', $this->data['effectiveDate'], FQueryParam::STRING)
                ->where('id =', $this->data['id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function save()
    {
        $query = FQuery::getInstance()->create()
                ->insert('userDay')
                ->insertValue('user_id', $this->data['user_id'], FQueryParam::INT)
                ->insertValue('day_id', $this->data['day_id'], FQueryParam::INT)
                ->insertValue('completed', $this->data['completed'], FQueryParam::INT)
                ->insertValue('effectiveDate', $this->data['effectiveDate'], FQueryParam::STRING);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function isCompleted()
    {
        return $this->data['completed'] == 1;
    }
}

?>
