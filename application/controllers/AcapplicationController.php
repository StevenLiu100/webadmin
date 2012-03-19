<?php
require_once 'BaseController.php';
class AcapplicationController extends BaseController
{

    public function init()
    {
    	parent::init();
    }

    public function indexAction()
    {
        // action body
    	$mapper  = new Application_Model_AcapplicationMapper();
    	$this->view->apps = $mapper->fetchAll();
    	
    	$prevs = array();
    	$prevs[] = 0;
    	foreach ($this->view->apps as $item)
    	{
    		$prevs[] = $item->applicationid;
    	}
    	$nexts = array_slice($prevs, 2);
    	$nexts[] = 0;
    	$this->view->prevs = $prevs;
    	$this->view->nexts = $nexts;
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

    public function appupAction()
    {
        // action body
    	$request = $this->getRequest();
    	$id = $request->getParam('appid');
    	$prev = $request->getParam('prev');
    	if($prev!=0)
    	{
    		$mapper = new Application_Model_AcapplicationMapper();
    		$mapper->swapapporder($id, $prev);
    	}
    	return $this->_helper->redirector('index');
    	$this->indexAction();
    }

    public function appdownAction()
    {
        // action body
    	$request = $this->getRequest();
    	$id = $request->getParam('appid');
    	$next = $request->getParam('next');
    	 
    	if($next !=0)
    	{
    		$mapper = new Application_Model_AcapplicationMapper();
    		$mapper->swapapporder($id, $next );
    	}
    	return $this->_helper->redirector('index');
    	$this->indexAction();
    }


}











