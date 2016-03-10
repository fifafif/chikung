<?php

class UserDataModel extends FModelObject
{
    protected $dataTypes = array('id' => 0, 'user_id' => 0, 'exerciseCompleted' => 2, 'alarmTimes' => 2, 'hasStarted' => 1);
    
    private $exerciseCompletedMap;
    
    public function load($userId)
    {
        $query = FQuery::getInstance()->create()
                ->select('p.user_id, p.exerciseCompleted, p.hasStarted, p.alarmTimes, p.startDate')
                ->from('userData', 'p')->where('user_id =', $userId, FQueryParam::INT)
                ->limit(1);
        
        $res = $this->db->execute($query->getQuery());
        
        $this->parseWithCheckResult($res, 1);
    }
    
    public function update()
    {
        $query = FQuery::getInstance()->create()
                ->update('userData')
                ->set('exerciseCompleted', $this->data['exerciseCompleted'], FQueryParam::STRING)
                ->setNext('hasStarted', $this->data['hasStarted'], FQueryParam::INT)
                ->setNext('startDate', $this->data['startDate'], FQueryParam::STRING)
                ->where('user_id =', $this->data['user_id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function save()
    {
        $query = FQuery::getInstance()->create()
                ->insert('userData')
                ->insertValue('user_id', $this->data['user_id'], FQueryParam::INT);
        
        $result = $this->db->execute($query->getQuery());
    }
    
    public function parseProgress()
    {
        $this->exerciseCompletedMap = json_decode($this->data['exerciseCompleted'], true);
        
    }
    
    public function parseProgressToData()
    {
        $this->updateValue('exerciseCompleted', json_encode($this->exerciseCompletedMap));
    }
    
    public function getExerciseCompleted()     
    {
        return $this->exerciseCompletedMap;
    }
    
    public function setExerciseCompleted($exerciseCompleted)     
    {
        $this->exerciseCompletedMap = $exerciseCompleted;
    }
    
    public function setExerciseCompletedById($id, $isCompleted = true)
    {
        $this->exerciseCompletedMap[$id] = $isCompleted ? 1 : 0;
    }
    
    public function isExerciseCompleted($id)
    {
        return isset($this->exerciseCompletedMap[$id]) && $this->exerciseCompletedMap[$id] == 1;
    }
}

?>
