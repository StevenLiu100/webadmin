<?php

class Application_Model_Acuser
{
	
	protected $_username;
	protected $_email;
	protected $_userid;
	protected $_tel;
	protected $_mobile;
	protected $_state;
	protected $_userstyle;
	protected $_password;
	protected $_repassword;
	protected $_unit;
	protected $_comment;
	protected $_createdate;
	protected $_passwordsalt;
	
	
	/**
	 * @return the $_repassword
	 */
	public function getRepassword() {
		return $this->_repassword;
	}
	
	/**
	 * @param field_type $_repassword
	 */
	public function setRepassword($_repassword) {
		$this->_repassword = $_repassword;
	}
	
	/**
	 * @return the $_createdate
	 */
	public function getCreatedate() {
		return $this->_createdate;
	}
	
	/**
	 * @return the $_passwordsalt
	 */
	public function getPasswordsalt() {
		return $this->_passwordsalt;
	}
	
	/**
	 * @param field_type $_createdate
	 */
	public function setCreatedate($_createdate) {
		$this->_createdate = $_createdate;
	}
	
	/**
	 * @param field_type $_passwordsalt
	 */
	public function setPasswordsalt($_passwordsalt) {
		$this->_passwordsalt = $_passwordsalt;
	}
	
	/**
	 * @return the $_username
	 */
	public function getUsername() {
		return $this->_username;
	}
	
	/**
	 * @return the $_email
	 */
	public function getEmail() {
		return $this->_email;
	}
	
	/**
	 * @return the $_userid
	 */
	public function getUserid() {
		return $this->_userid;
	}
	
	/**
	 * @return the $_tel
	 */
	public function getTel() {
		return $this->_tel;
	}
	
	/**
	 * @return the $_mobile
	 */
	public function getMobile() {
		return $this->_mobile;
	}
	
	/**
	 * @return the $_state
	 */
	public function getState() {
		return $this->_state;
	}
	
	/**
	 * @return the $_userstyle
	 */
	public function getUserstyle() {
		return $this->_userstyle;
	}
	
	/**
	 * @return the $_password
	 */
	public function getPassword() {
		return $this->_password;
	}
	
	/**
	 * @return the $_unit
	 */
	public function getUnit() {
		return $this->_unit;
	}
	
	/**
	 * @return the $_comment
	 */
	public function getComment() {
		return $this->_comment;
	}
	
	/**
	 * @param field_type $_username
	 */
	public function setUsername($_username) {
		$this->_username = $_username;
	}
	
	/**
	 * @param field_type $_email
	 */
	public function setEmail($_email) {
		$this->_email = $_email;
	}
	
	/**
	 * @param field_type $_userid
	 */
	public function setUserid($_userid) {
		$this->_userid = $_userid;
	}
	
	/**
	 * @param field_type $_tel
	 */
	public function setTel($_tel) {
		$this->_tel = $_tel;
	}
	
	/**
	 * @param field_type $_mobile
	 */
	public function setMobile($_mobile) {
		$this->_mobile = $_mobile;
	}
	
	/**
	 * @param field_type $_state
	 */
	public function setState($_state) {
		$this->_state = $_state;
	}
	
	/**
	 * @param field_type $_userstyle
	 */
	public function setUserstyle($_userstyle) {
		$this->_userstyle = $_userstyle;
	}
	
	/**
	 * @param field_type $_password
	 */
	public function setPassword($_password) {
		$this->_password = $_password;
	}
	
	/**
	 * @param field_type $_unit
	 */
	public function setUnit($_unit) {
		$this->_unit = $_unit;
	}
	
	/**
	 * @param field_type $_comment
	 */
	public function setComment($_comment) {
		$this->_comment = $_comment;
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

