<?php
/**
 *
 * @author steven
 * @version 
 */
require_once 'Zend/Loader/PluginLoader.php';
require_once 'Zend/Controller/Action/Helper/Abstract.php';

/**
 * SitmapHelper Action Helper
 *
 * @uses actionHelper Zend_Controller_Action_Helper
 */
class Zend_Controller_Action_Helper_SitmapHelper extends Zend_Controller_Action_Helper_Abstract {
	/**
	 *
	 * @var Zend_Loader_PluginLoader
	 */
	public $pluginLoader;
	
	/**
	 * Constructor: initialize plugin loader
	 *
	 * @return void
	 */
	public function __construct() {
		// TODO Auto-generated Constructor
		$this->pluginLoader = new Zend_Loader_PluginLoader ();
	}
	
	/**
	 * Strategy pattern: call helper as broker method
	 */
	public function direct() {
		// TODO Auto-generated 'direct' method
	}
	public function iniSitmap($_currentcontroller)
	{
		$uri = $_this->_request->getPathInfo();
		$activeNav = $_this->view->navigation()->findByUri($uri);
		$activeNav-> active = true;
		$activeNav->setClass("active");
	}
}
