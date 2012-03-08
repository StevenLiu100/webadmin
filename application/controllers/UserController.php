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
        $form    = new Application_Form_UserInfo();
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
        		$user = new Application_Model_Acuser($form->getValues());
        		$appMapper=new Application_Model_AcapplicationMapper();
        		$apps=$appMapper->fetchAll();
        		$userstyle=implode('#', $user->getUserstyle());
        		$user->setUserstyle($userstyle);
        		$mapper  = new Application_Model_AcuserMapper();
        		//密码和密码确认工作已经在浏览器端验证了，用户名的是否重复的问题也已经验证过了，因此这里直接插入一条新记录
        		$mapper->save($user);
        		$logMapper=new Application_Model_AcsyslogMapper();
        		$logMapper->addSyslog('10000', '添加用户，用户名为'.$user->getUsername().',注册邮箱为'.$user->getEmail(), '系统');
        		return $this->_helper->redirector('index');
        	}
        }
        $this->view->form = $form;
    }

    public function updatepasswordAction()
    {
        $userid='9';
        $request = $this->getRequest();
        $form    = new Application_Form_UserPassword();
        
        if ($this->getRequest()->isPost()) {
        	if ($form->isValid($request->getPost())) {
        	    $password=$form->getValue('password');
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
        			$logMapper=new Application_Model_AcsyslogMapper();
        			$logMapper->addSyslog($userid, '修改密码为'.$password, '系统');
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
    	$form    = new Application_Form_UserSearch();
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$user = new Application_Model_Acuser();
    			$mapper  = new Application_Model_AcuserMapper();
    			$username=$form->getValue('username');
    			$sortfield=$form->getValue('sortfield');
    			$users=$mapper->findByName($username,$sortfield);
    			$this->processUserStyle($users);
    			$this->view->entries=$users;
    			$this->view->username=$username;
    			$this->view->sortfield=$sortfield;
    			$logMapper=new Application_Model_AcsyslogMapper();
    			$logMapper->addSyslog('10000', '搜索用户信息，搜素关键字为'.$username.'，排序属性为'.$sortfield, '系统');
    			$this->getRequest()->setParam('page', 1);
    		}
    	}
    	else if ($this->_getParam('page')!=null){
    		$username=$request->getParam('username');
    		$sortfield=$request->getParam('sortfield');
    		$mapper  = new Application_Model_AcuserMapper();
    		$users=$mapper->findByName($username,$sortfield);
    		$this->processUserStyle($users);
    		$this->view->entries=$users;
    		$this->view->username=$username;
    		$this->view->sortfield=$sortfield;		
    	}
    	else
    	{
    		$this->view->entries=array();
    	}
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial('user/controls.phtml');
    	$paginator = Zend_Paginator::factory($this->view->entries);
    	$paginator->setCurrentPageNumber($this->_getParam('page', 1));
    	$this->view->paginator = $paginator;
    	$this->view->form = $form;
    	 
    }
    public function updateAction ()
    {
        $request = $this->getRequest();
        $userid=$request->getParam('userid');
        $user = new Application_Model_Acuser();
        $mapper  = new Application_Model_AcuserMapper();
        $mapper->find($userid,$user);
        $appMapper=new Application_Model_AcapplicationMapper();
        $apps=$appMapper->fetchAll();
        
    	$form = new Application_Form_UserInfoUpdate();
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$user_update = new Application_Model_Acuser($form->getValues());
    			$user_update->setUserid($userid);
    			$user_update->setPassword($user->getPassword());
    			$userstyle=implode('#', $user_update->getUserstyle());
        		$user_update->setUserstyle($userstyle);
    			$mapper  = new Application_Model_AcuserMapper();
    			$mapper->save($user_update);
    			$logMapper=new Application_Model_AcsyslogMapper();
    			$logMapper->addSyslog('10000', '修改用户信息', '系统');
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
    	
		$userstyle_array=explode('#',$user->getUserstyle());

     	$userstyle_element=$form->getElement('userstyle');
     	$userstyle_element->setValue($userstyle_array);

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
    private function processUserStyle($users)
    {
    	foreach ($users as $user)
    	{
    		$userstyle=explode('#', $user->getUserstyle());
    		$appMapper=new Application_Model_AcapplicationMapper();
    		$userstyle_name=array();
    		foreach ($userstyle as $appid)
    		{
    			$app=$appMapper->findbyid($appid);
    			if($app!=null)
    				$userstyle_name[]=$app->getApplicationname();
    		}
    		$user->setUserstyle(implode(';', $userstyle_name));
    	}
    }
}
