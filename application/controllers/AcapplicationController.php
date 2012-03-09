<?php

class AcapplicationController extends Zend_Controller_Action
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
    	$mapper  = new Application_Model_AcapplicationMapper();
    	$this->view->apps = $mapper->fetchAll();
    }

    public function appdeleteAction()
    {
        // action body
    	$request = $this->getRequest();
    	$applicationid=$request->getParam('applicationid');
    	$enable=$request->getParam('enable');

    	$mapper  = new Application_Model_AcapplicationMapper();
    	$mapper->delete($applicationid);
    	return $this->_helper->redirector('index');    	
    }

    public function appupdateAction()
    {
        // action body
    	$form    = new Application_Form_Application();
    	$this->view->form = $form;
    	
    	$form->submit->setLabel('保存');
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    	
    		if ($form->isValid($formData)) {
    			$app = new Application_Model_Acapplication($form->getValues());
//     			$app->setApplicationid($form->getValue('appid'));
//     			$app->setApplicationname($form->getValue('appname'));
//     			$app->setDescription($form->getValue('appdesc'));
//     			$app->setEnable($form->getValue('appstate'));
//     			$app->setApporder($form->getValue('apporder'));
    			$mapper  = new Application_Model_AcapplicationMapper();
    			$mapper->save($app);
    			return $this->_helper->redirector('index');
    		}
    		else{
    			$form->populate($formData);
    		}
    	}
    	else {
    		$id = $this->_getParam('applicationid', 0);
    		if ($id > 0) {
    			$mapper = new Application_Model_AcapplicationMapper();
    			$form->populate($mapper->getrowbyid($id));
    		}
    	}
    	
    	$this->view->form = $form;
    }

    public function appaddAction()
    {
        // action body
    	$form    = new Application_Form_Application();
    	$this->view->form = $form;
    	$form->submit->setLabel('增加');
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		
    		if ($form->isValid($formData)) {
    			$app = new Application_Model_Acapplication($form->getValues());
//     			$app->setApplicationname($form->getValue('appname'));
//     			$app->setDescription($form->getValue('appdesc'));
//     			$app->setEnable($form->getValue('appstate'));
//     			$app->setApporder($form->getValue('apporder'));
    			$mapper  = new Application_Model_AcapplicationMapper();
    			$mapper->save($app);
    			return $this->_helper->redirector('index');
    		}
    		else{
    			$form->populate($formData);
    		}
    	}
    	$this->view->form = $form;
    }


}







