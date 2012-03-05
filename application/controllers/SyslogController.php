<?php


require_once 'Zend/Controller/Action.php';

class SyslogController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
//    	$this->view->addHelperPath('ZendX/JQuery/View/Helper', 'ZendX_JQuery_View_Helper');
    	$this->entries = null;
    }

    public function indexAction()
    {
    	
    	$request = $this->getRequest();
    	$form    = new Application_Form_SyslogSearch();
    	//$this->view->entries =$this->view->entries==null?array():$this->view->entries;
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$syslog = new Application_Model_Acsyslog();
//     			$mapper  = new Application_Model_AcuserMapper();
     			$this->entries=$form->getValue('username');
//     			$this->view->entries=$mapper->findByName($username);
//     			Zend_View_Helper_PaginationControl::setDefaultViewPartial('user/controls.phtml');
//     			$paginator = Zend_Paginator::factory($this->view->entries);
//     			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
//     			$this->view->paginator = $paginator;
    			//return $this->_helper->redirector('search');
    		}
    	}
    	else if ($this->_getParam('page')!=null){
    			
     		$this->entries=$form->getValue('username');
//     		$mapper  = new Application_Model_AcuserMapper();
//     		$this->view->entries=$mapper->findByName($username);
//     		Zend_View_Helper_PaginationControl::setDefaultViewPartial('user/controls.phtml');
//     		$paginator = Zend_Paginator::factory($this->view->entries);
//     		$paginator->setCurrentPageNumber($this->_getParam('page', 1));
//     		$this->view->paginator = $paginator;
    		

    	}
    	$this->view->form = $form;
    	
    	$page = 1;
    	$numPerPage = 5;
    	if(isset($_GET['page']) && is_numeric($_GET['page'])){
    		$page = $_GET['page'];
    	}
    	$this->page($page,$numPerPage);

    }

    public function page($page, $numPerPage)
    {
    	$mapper = new Application_Model_AcsyslogMapper();
		$array = $mapper->getSyslogsByUserName($this->entries);
    
    	$paginator = Zend_Paginator::factory($array);
    	$paginator->setCurrentPageNumber($page)
    	->setItemCountPerPage($numPerPage);
    
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
    	} /*else {
    	$id = $this->_getParam('logid', 0);
    	$syslog = new Application_Model_DbTable_Syslog();
    	$this->view->syslog = $syslog->getSyslog($id);
    	}*/
    }


}



