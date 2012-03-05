<?php

class Application_Model_Acsyslog
{
	protected $_logid;
	protected $_userid;
	protected $_username;
	protected $_event;
	protected $_eventtype;
	protected $_createdate;
	
	
	/**
	 * @return the $_logid
	 */
	public function getLogid() {
		return $this->_logid;
	}

	/**
	 * @return the $_userid
	 */
	public function getUserid() {
		return $this->_userid;
	}

	/**
	 * @return the $_event
	 */
	public function getEvent() {
		return $this->_event;
	}

	/**
	 * @return the $_eventtype
	 */
	public function getEventtype() {
		return $this->_eventtype;
	}

	/**
	 * @return the $_createdate
	 */
	public function getCreatedate() {
		return $this->_createdate;
	}

	/**
	 * @param field_type $_logid
	 */
	public function setLogid($_logid) {
		$this->_logid = $_logid;
	}

	/**
	 * @param field_type $_userid
	 */
	public function setUserid($_userid) {
		$this->_userid = $_userid;
	}

	/**
	 * @param field_type $_event
	 */
	public function setEvent($_event) {
		$this->_event = $_event;
	}

	/**
	 * @param field_type $_eventtype
	 */
	public function setEventtype($_eventtype) {
		$this->_eventtype = $_eventtype;
	}

	/**
	 * @param field_type $_createdate
	 */
	public function setCreatedate($_createdate) {
		$this->_createdate = $_createdate;
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
			throw new Exception('Invalid syslog property');
		}
		$this->$method($value);
	}
	
	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid syslog property');
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
	/**
	 * @return the $_username
	 */
	public function getUsername() {
		return $this->_username;
	}

	/**
	 * @param field_type $_username
	 */
	public function setUsername($_username) {
		$this->_username = $_username;
	}


}

