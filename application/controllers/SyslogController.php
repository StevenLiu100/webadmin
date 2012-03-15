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
    	
    	$request = $this->getRequest();
    	$form    = new Application_Form_SyslogSearch();
    	//$this->entries=$form->getValue('usernamelog');
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$syslog = new Application_Model_Acsyslog();
     			$this->entries=$form->getValue('usernamelog');
     			$this->start_date=$form->getValue('start_date');
     			$this->end_date=$form->getValue('end_date');
     			$mapper = new Application_Model_AcsyslogMapper();
     			$this->entries = $mapper->getSyslogsBySearchContent($this->entries,$this->start_date,$this->end_date);
    		}
    	}
    	else if ($this->_getParam('page')!=null){
    			
    		$this->entries=$request->getParam('usernamelog');
    		$this->start_date=$request->getParam('start_date');
     		$this->end_date=$request->getParam('end_date');
    		$mapper = new Application_Model_AcsyslogMapper();
    		$this->entries = $mapper->getSyslogsBySearchContent($this->entries,$this->start_date,$this->end_date);    		
    	}
    	else {
    		$this->entries = array();
    	}
    		
    	$this->view->form = $form;
    	  	
    	$page = 1;
    	if(isset($_GET['page']) && is_numeric($_GET['page'])){
    		$page = $_GET['page'];
    	}
    	$this->page($page);

    }

    public function page($page)
    {
    	$paginator = Zend_Paginator::factory($this->entries);
    	$paginator->setCurrentPageNumber($page);
    	$paginator->setDefaultPageRange(10);
    
    	$this->view->paginator = $paginator;
    }

    public function pagelistAction()
    {
    	Zend_Paginator::setDefaultScrollingStyle('Elastic');
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial('../views/scripts/syslog/pagelist.phtml');
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
    		} else {
    			$id = $this->_getParam('logid', 0);
    			$mapper = new Application_Model_AcsyslogMapper();
    			$this->view->syslog = $mapper->getSyslog($id);
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


}



