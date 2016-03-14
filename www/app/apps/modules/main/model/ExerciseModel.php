<?php

class ExerciseModel extends ExerciseEntity
{    
    public function load()
    {
        $query = FQuery::getInstance()->create()
                ->select('*')
                ->from('exercise', 'e');
        
        $this->loadFromDB($query->getQuery());
    }
}

?>
