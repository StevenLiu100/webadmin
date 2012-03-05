<?php

class Application_Model_Unit
{
	protected $_unitid;
	protected $_unitname;
	protected $_parentid;
	protected $_unitorder;
	/**
	 * @return the $_unitid
	 */
	public function getUnitid() {
		return $this->_unitid;
	}

	/**
	 * @return the $_unitname
	 */
	public function getUnitname() {
		return $this->_unitname;
	}

	/**
	 * @return the $_parentid
	 */
	public function getParentid() {
		return $this->_parentid;
	}

	/**
	 * @return the $_unitorder
	 */
	public function getUnitorder() {
		return $this->_unitorder;
	}

	/**
	 * @param field_type $_unitid
	 */
	public function setUnitid($_unitid) {
		$this->_unitid = $_unitid;
	}

	/**
	 * @param field_type $_unitname
	 */
	public function setUnitname($_unitname) {
		$this->_unitname = $_unitname;
	}

	/**
	 * @param field_type $_parentid
	 */
	public function setParentid($_parentid) {
		$this->_parentid = $_parentid;
	}

	/**
	 * @param field_type $_unitorder
	 */
	public function setUnitorder($_unitorder) {
		$this->_unitorder = $_unitorder;
	}

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
			throw new Exception('Invalid user property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid user property');
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
	
}

