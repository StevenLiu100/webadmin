<?php

class Application_Model_Acapplication
{
	protected $_applicationid;
	protected $_applicationname;
	protected $_description;
	protected $_enable;
	protected $_apporder;
	/**
	 * @return the $_applicationid
	 */
	public function getApplicationid() {
		return $this->_applicationid;
	}

	/**
	 * @return the $_applicationname
	 */
	public function getApplicationname() {
		return $this->_applicationname;
	}

	/**
	 * @return the $_description
	 */
	public function getDescription() {
		return $this->_description;
	}

	/**
	 * @return the $_enable
	 */
	public function getEnable() {
		return $this->_enable;
	}

	/**
	 * @return the $_apporder
	 */
	public function getApporder() {
		return $this->_apporder;
	}

	/**
	 * @param field_type $_applicationid
	 */
	public function setApplicationid($_applicationid) {
		$this->_applicationid = $_applicationid;
	}

	/**
	 * @param field_type $_applicationname
	 */
	public function setApplicationname($_applicationname) {
		$this->_applicationname = $_applicationname;
	}

	/**
	 * @param field_type $_description
	 */
	public function setDescription($_description) {
		$this->_description = $_description;
	}

	/**
	 * @param field_type $_enable
	 */
	public function setEnable($_enable) {
		$this->_enable = $_enable;
	}

	/**
	 * @param field_type $_apporder
	 */
	public function setApporder($_apporder) {
		$this->_apporder = $_apporder;
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
			throw new Exception('Invalid application property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid application property');
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

