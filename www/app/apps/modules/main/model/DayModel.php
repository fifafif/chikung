<?php

class DayModel extends FModelObject
{    
    protected $dataTypes = array('id' => 0, 'name' => 2, 'theme' => 2);
    
    public function load($dayId)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('day', 'd')
                ->where('id =', $dayId, FQueryParam::INT)
                ->limit(1);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function loadAll()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('day', 'd');
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res);
    }
}

?>
