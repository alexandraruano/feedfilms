<?php

class Application_Model_FestivalMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Festival');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Festival $Festival)
    {
        $data = array(
            'name'   => $Festival->getName(),
            'location' => $Festival->getLocation(),
        	'edition'   => $Festival->getEdition(),
        	'date' => $Festival->getDate(),
            //'created' => date('Y-m-d H:i:s'),
        );

        if (null === ($id = $Festival->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }

    public function find($id, Application_Model_Festival $Festival)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $Festival->setId($row->id)
                  ->setName($row->name)
                  ->setLocation($row->location)
			      ->setEdition($row->edition)
			      ->setDate($row->date);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Festival();
            $entry->setId($row->id)
                  ->setName($row->name)
                  ->setLocation($row->location)
		          ->setEdition($row->edition)
		          ->setDate($row->date);
            $entries[] = $entry;
        }
        return $entries;
    }
}

