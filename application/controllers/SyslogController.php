<?php

require_once 'BaseController.php';
class SyslogController extends BaseController
{

    public function init()
    {
    	parent::init();
    	$this->entries = null;
    	$this->start_date = null;
    	$this->end_date = null;
    }

    public function indexAction()
    {
    	
    	/* $request = $this->getRequest();
    	$form    = new Application_Form_SyslogSearch();
    	//$this->entries=$form->getValue('usernamelog');
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$syslog = new Application_Model_Acsyslog();
     			$usernamelog=$form->getValue('usernamelog');
     			$start_date=$form->getValue('start_date');
     			$end_date=$form->getValue('end_date');
     			$mapper = new Application_Model_AcsyslogMapper();
     			$this->entries = $mapper->getSyslogsBySearchContent($usernamelog,$start_date,$end_date);
     			
     			$this->view->usernamelog = $usernamelog;
     			$this->view->start_date = $start_date;
     			$this->view->end_date = $end_date;
    		}
    	}
    	else if ($this->_getParam('page')!=null){
    			
    		$usernamelog=$request->getParam('usernamelog');
    		$start_date=$request->getParam('start_date');
     		$end_date=$request->getParam('end_date');
    		$mapper = new Application_Model_AcsyslogMapper();
    		$this->entries = $mapper->getSyslogsBySearchContent($usernamelog,$start_date,$end_date);

    		$this->view->usernamelog = $usernamelog;
    		$this->view->start_date = $start_date;
    		$this->view->end_date = $end_date;
    	}
    	else {
    		$this->entries = array();
    	}
    		
    	$this->view->form = $form;
    	
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial('../views/scripts/syslog/pagelist.phtml');
    	$paginator = Zend_Paginator::factory($this->entries);
    	$paginator->setCurrentPageNumber($this->_getParam('page', 1));
    	
    	$this->view->paginator = $paginator; */
    	
    	$request = $this->getRequest();
    	$form    = new Application_Form_SyslogSearch();
    	//$this->entries=$form->getValue('usernamelog');
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$syslog = new Application_Model_Acsyslog();
    			$usernamelog=$form->getValue('usernamelog');
    			$start_date=$form->getValue('start_date');
    			$end_date=$form->getValue('end_date');
    			$mapper = new Application_Model_AcsyslogMapper();
    			$this->view->entries = $mapper->getSyslogsBySearchContent($usernamelog,$start_date,$end_date);
    	
    			$this->view->usernamelog = $usernamelog;
    			$this->view->start_date = $start_date;
    			$this->view->end_date = $end_date;
    		}
    	}
    	else {
    		$this->view->entries = array();
    	}
    	
    	$this->view->form = $form;

    }

    public function pagelistAction()
    {

    }

    public function deleteAction()
    {
    	// action body
    	if ($this->getRequest()->isPost()) {
    			$del = $this->getRequest()->getPost('del');
    			if ($del == 'Yes') {
    				$id = $this->getRequest()->getPost('logid');
    				$mapper = new Application_Model_AcsyslogMapper();
    				$mapper->deleteSyslog($id);
    			}
    			$this->_helper->redirector('index');
    		}
    }
    
    public function clearAction()
    {
    	// action body
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == '是') {
    			$syslog = new Application_Model_AcsyslogMapper();
    			$syslog->clearSyslog();
    		}
    		$this->_helper->redirector('index');
    	}
    }
    /*
     * action for ajax
     */
    public function searchAction()
    {
    	$this->_helper->layout->disableLayout (); // disable layout
    	$this->_helper->viewRenderer->setNoRender ();
    	
    	$request = $this->getRequest();
    	$form    = new Application_Form_SyslogSearch();

    	$syslog = new Application_Model_Acsyslog();
    	$usernamelog=$form->getValue('usernamelog');
    	$start_date=$form->getValue('start_date');
    	$end_date=$form->getValue('end_date');
    	$mapper = new Application_Model_AcsyslogMapper();
    	$this->entries = $mapper->getSyslogsBySearchContent($usernamelog,$start_date,$end_date);
    }


}



