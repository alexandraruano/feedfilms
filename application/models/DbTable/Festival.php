<?php

class Application_Model_DbTable_Festival extends Zend_Db_Table_Abstract
{
    protected $_name = 'festivals';

    public function getFestival($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addFestival($name, $location, $edition, $date)
    {
        $data = array(
            'name' => $name,
            'location' => $location,
        	'edition' => $edition,
        	'date' => $date
        );
        $this->insert($data);
    }

    public function updateFestival($id, $name, $location, $edition, $date)
    {
        $data = array(
            'name' => $name,
            'location' => $location,
        	'edition' => $edition,
        	'date' => $date
        );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteFestival($id)
    {
        $this->delete('id =' . (int)$id);
    }

}

