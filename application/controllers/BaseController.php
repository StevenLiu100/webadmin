<?php

class BaseController extends Zend_Controller_Action
{

    public function init()
    {
        $uri = $this->_request->getPathInfo();
    	$activeNav = $this->view->navigation()->findByUri($uri);
    	if($activeNav!=null){
    	  $activeNav-> active = true;
    	  $activeNav->setClass("active");
    	}
    }

    public function indexAction()
    {
        // action body
    }


}

