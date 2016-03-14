<?php


class SettingsModel extends FModelObject
{
    private $settings;
    
    public function load()
    {
        $query = FQuery::getInstance()->create()
                ->select('s.k, s.v')
                ->from('settings', 's');
        
        $res = $this->db->execute($query->getQuery());
        
        $this->settings = array();
        
        while ($row = mysqli_fetch_assoc($res))
        {
            $this->settings[$row['k']] = $row['v'];
        }
    }
    
    public function getValue($key)
    {
        if (!isset($this->settings[$key]))
        {
            return null;
        }
        
        return $this->settings[$key];
    }
}

?>
