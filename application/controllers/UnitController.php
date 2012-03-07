<?php

class UnitController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function unitaddAction()
    {
        // action body
    	$form    = new Application_Form_Unitadd();
    	
    	if($this->getRequest()->isPost())
    	{
    		$formData = $this->getRequest()->getPost();
    		 
    		if ($form->isValid($formData)) {
    			$unit = new Application_Model_Unit($form->getValues());
    			$mapper  = new Application_Model_UnitMapper();
    			$mapper->save($unit);
    			return $this->_helper->redirector('index');
    		}
    		else{
    			$form->populate($formData);
    		}
    	}
    		 
    	$this->view->form = $form;
    }

    public function unitdelAction()
    {
        // action body
        
    	$request = $this->getRequest();
    	$unitid=$request->getParam('unitid');
    	
    	$mapper  = new Application_Model_UnitMapper();
    	$mapper->delete($unitid);
    	return $this->_helper->redirector('index');
    }

    public function unitupdAction()
    {
        // action body
    	$request = $this->getRequest();

    	$form = new Application_Form_Unitupd();
    	
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$unitid = $form->getValue('unitid');
    			$unitname = $form->getValue('unitnamenew');
    			$mapper  = new Application_Model_UnitMapper();
    			$unit = $mapper->findbyid($unitid);
    			$unit->setUnitname($unitname);
    			$mapper->save($unit);

    			return $this->_helper->redirector('index');
    		}
    	}
    	
    }

    public function unitsearchAction()
    {
        // action body
    	$request = $this->getRequest();
    	$form    = new Application_Form_Unitsearch();
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$unit = new Application_Model_Unit();
    			$mapper  = new Application_Model_UnitMapper();
    			
    			$parentid = $form->getValue('parentid');
    			$unitname = $form->getValue('unitname');
    			
    			$this->view->units=$mapper->unitSearch($parentid,$unitname);
    		}
    	}
    	
    	$this->view->form = $form;
    }


}















