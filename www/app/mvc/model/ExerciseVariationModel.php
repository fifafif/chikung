<?php

class ExerciseVariationModel extends FModelObject
{   
    protected $dataTypes = array('id' => 0, 'day_id' => 0, 'exercise_id' => 0, 'time' => 0, 'name' => 2, 'description' => 2);
    
    public function load($id)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('exerciseVariation', 'e')
                ->where('id =', $id, FQueryParam::INT);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function loadAll()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('exerciseVariation', 'e');
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res);
    }
    
    public function loadByDayId($dayId)
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('exerciseVariation', 'e')
                ->where('day_id =', $dayId, FQueryParam::INT);
                
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, -1, true);
    }
}

?>
