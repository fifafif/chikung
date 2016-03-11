<?php

class ExerciseModel extends ExerciseEntity
{    
    //protected $dataTypes = array('id' => 0, 'name' => 2, 'description' => 2, 'video' => 2, 'images' => 2);

    public function load()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('exercise', 'e');
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res);
    }
}

?>
