<?php

/**
 * Description of FModel
 *
 * @author XiXao
 */
class FModelObject implements Serializable
{

    protected $db;
    protected $tableName;
    public $data;
    protected $model;
    protected $resultRowCount = 0;
    protected $dataTypes;

    public function __construct(FDatabase $database)
    {
        $this->db = $database;
        $this->model = FModel::getInstance();
    }

    public function setDatabase(FDatabase $database)
    {
        $this->db = $database;
    }

    public function unsetDatabase()
    {
        $this->db = NULL;
    }

    public function setTableName($tableName)
    {
        $this->tableName = $tableName;
    }

    public function getTableName()
    {
        return $this->tableName;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setValue($key, $value)
    {
        $this->updateValue($key, $value);
    }

    public function updateValue($dataName, $dataValue)
    {
        if (!isset($this->data))
        {
            $this->data = array();
        }

        $this->data[$dataName] = $dataValue;
    }

    protected function dataLoaded()
    {

        if (!isset($this->tableName))
        {
            return;
        }

        $this->model->addDataByRef($this->tableName, $this->data);
    }

    public function serialize()
    {
        return serialize(array(
            'data' => $this->data
        ));
    }

    public function unserialize($data)
    {
        $data = unserialize($data);
        $this->data = $data['data'];
        $this->model = FModel::getInstance();
        $this->db = FDatabase::getInstance();
    }

    protected function parseWithCheckResult($res, $expectedRowCount = -1, $forceArray = false)
    {
        unset($this->data);

        $this->resultRowCount = mysqli_num_rows($res);

        //$fields = mysqli_fetch_fields($res);
        //print_r($fields);
        //$this->getColumnType("type");

        if ($this->resultRowCount == 0)
        {
            $this->data = null;
        } else if ($this->resultRowCount > 1 || $forceArray)
        {
            $this->data = array();

            while ($row = mysqli_fetch_assoc($res))
            {
                $this->data[] = $this->setTypes($row);
//                $this->data[] = $row;
            }
        } else // rowCount = 1
        {
            $this->data = $this->setTypes(mysqli_fetch_assoc($res));
        }


        return $expectedRowCount == -1 || $expectedRowCount == $this->resultRowCount;
    }

    protected function getColumnType($column)
    {
        return -1;
    }

    private function setTypes(&$row)
    {
        if (!isset($this->dataTypes))
        {
            return $row;
        }

        foreach ($row as $key => $value)
        {
            if (isset($this->dataTypes[$key]))
            {
                switch ($this->dataTypes[$key])
                {
                    case 0:

                        settype($row[$key], 'integer');
                        break;

                    case 1:

                        settype($row[$key], 'float');
                        break;

                    default:
                        // String

                        settype($row[$key], 'string');
                        break;
                }
//                settype($row[$column], $this->dataTypes[$column]);
            }
        }

        return $row;
    }

    public function getResultRowCount()
    {
        return $this->resultRowCount;
    }

}

?>