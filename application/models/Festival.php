<?php

class Application_Model_Festival
{
 	protected $_Location;
    protected $_Name;
    protected $_Edition;
    protected $_Date;
    protected $_id;

    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid festival property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid festival property');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setLocation($text)
    {
        $this->_Location = (string) $text;
        return $this;
    }

    public function getLocation()
    {
        return $this->_Location;
    }

    public function setName($Name)
    {
        $this->_Name = (string) $Name;
        return $this;
    }

    public function getName()
    {
        return $this->_Name;
    }

  	public function setEdition($Edition)
    {
        $this->_Edition = (string) $Edition;
        return $this;
    }

    public function getEdition()
    {
        return $this->_Edition;
    }
    
    public function setDate($Date)
    {
    	$this->_Date = (string) $Date;
    	return $this;
    }
    
    public function getDate()
    {
    	return $this->_Date;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }

    public function getId()
    {
        return $this->_id;
    }
	
}

