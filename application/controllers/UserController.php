<?php

/**
 * PersonController
 * 
 * @author xdhan
 * @version 
 */

require_once 'Zend/Controller/Action.php';

class UserController extends Zend_Controller_Action
{

    /**
     * The default action - show the home page
     */
    public function indexAction ()
    {
        // TODO Auto-generated PersonController::indexAction() default action
    }
    public function addAction ()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_User();
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
        		$user = new Application_Model_Acuser($form->getValues());
        		$mapper  = new Application_Model_AcuserMapper();
        		//密码和密码确认工作已经在浏览器端验证了，用户名的是否重复的问题也已经验证过了，因此这里直接插入一条新记录
        		$mapper->save($user);
        		return $this->_helper->redirector('index');
        	}
        }
        $this->view->form = $form;
    }

    public function updatepasswordAction()
    {
        $userid='3';
        $request = $this->getRequest();
        $form    = new Application_Form_Password();
        
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
        	    $password=$form->getValue('oldpassword');
        	    $newpassword=$form->getValue('newpassword');
        	    //$renewpassword=$form->getValue('renewpassword');
        	    //密码和密码确认工作已经在浏览器端验证了，旧的密码也已经验证过了，因此这里直接更新
        		$user = new Application_Model_Acuser();
        		$mapper  = new Application_Model_AcuserMapper();
        		$mapper->find($userid,$user);
        		$userpassword=$user->getPassword();
        		if($userpassword==md5($password+$user->getPasswordsalt())){
        			$user->setPassword(md5($newpassword+$user->getPasswordsalt()));
        			$mapper->save($user);
        			return $this->_helper->redirector('index');
        		}
        		else
        		{
        			$this->view->message='密码不正确.';
        		}
        	}
        }
        $this->view->form = $form;
        
    }
    public function searchAction ()
    {
    	$request = $this->getRequest();
    	$form    = new Application_Form_Search();
    	//$this->view->entries =$this->view->entries==null?array():$this->view->entries;
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$user = new Application_Model_Acuser();
    			$mapper  = new Application_Model_AcuserMapper();
    			$username=$form->getValue('username');
    			$this->view->entries=$mapper->findByName($username);
    			Zend_View_Helper_PaginationControl::setDefaultViewPartial('user/controls.phtml');
    			$paginator = Zend_Paginator::factory($this->view->entries);
    			$paginator->setCurrentPageNumber($this->_getParam('page', 1));
    			$this->view->paginator = $paginator;
    			    			//return $this->_helper->redirector('search');
    		}
    	}
    	else if ($this->_getParam('page')!=null){
    	    
    	    $username=$form->getValue('username');
    	    $mapper  = new Application_Model_AcuserMapper();
    	    $this->view->entries=$mapper->findByName($username);
    	    Zend_View_Helper_PaginationControl::setDefaultViewPartial('user/controls.phtml');
    	    $paginator = Zend_Paginator::factory($this->view->entries);
    	    $paginator->setCurrentPageNumber($this->_getParam('page', 1));
    	    $this->view->paginator = $paginator;
    	}	 
    	$this->view->form = $form;
    	 
    }
    public function updateAction ()
    {
        $request = $this->getRequest();
        $userid=$request->getParam('userid');
        $user = new Application_Model_Acuser();
        $mapper  = new Application_Model_AcuserMapper();
        $mapper->find($userid,$user);

    	$form = new Application_Form_UserUpdate();
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$user_update = new Application_Model_Acuser($form->getValues());
    			$user_update->setUserid($userid);
    			$user_update->setPassword($user->getPassword());
    			$mapper  = new Application_Model_AcuserMapper();
    			$mapper->save($user_update);
    			return $this->_helper->redirector('index');
    		}
    	}
    	$username_element=$form->getElement('username');
    	$username_element->setValue($user->getUsername());

    	$email_element=$form->getElement('email');
    	$email_element->setValue($user->getEmail());

    	$mobile_element=$form->getElement('mobile');
    	$mobile_element->setValue($user->getMobile());

    	$tel_element=$form->getElement('tel');
    	$tel_element->setValue($user->getTel());

    	$unit_element=$form->getElement('unit');
    	$unit_element->setValue($user->getUnit());

     	$userstyle_element=$form->getElement('userstyle');
     	$userstyle_element->setValue($user->getUserstyle());

     	$comment_element=$form->getElement('comment');
     	$comment_element->setValue($user->getComment());

     	$state_element=$form->getElement('state');
     	$state_element->setValue($user->getState());

    	
    	$this->view->form = $form;
    }
    public function deleteAction ()
    {
    	$request = $this->getRequest();
    	$userid=$request->getParam('userid');
    	$state=$request->getParam('state');
    	if($state=='禁用'){
    		$mapper  = new Application_Model_AcuserMapper();
    		$mapper->remove($userid);
    		return $this->_helper->redirector('index');
    	}
    }
}