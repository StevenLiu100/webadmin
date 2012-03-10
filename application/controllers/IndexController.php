<?php
require_once 'BaseController.php';
class IndexController extends BaseController
{

    public function init()
    {
    	parent::init();
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

