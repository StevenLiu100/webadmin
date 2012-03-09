<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    	$uri = $this->_request->getPathInfo();
		$activeNav = $this->view->navigation()->findByUri($uri);
		$activeNav-> active = true;
		$activeNav->setClass("active");
    }

    public function indexAction()
    {
        // action body
    }
    public function sitemapAction()
    {
    	$this->view->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender(true);
    	echo $this->view->navigation()->sitemap();
    
    }

}

