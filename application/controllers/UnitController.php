<?php
require_once 'BaseController.php';
class UnitController extends BaseController
{

    public function init()
    {
       parent::init();
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
    			$unit = new Application_Model_Unit();
    			$grandid= $form->getValue('firstparentid');
    			$parentid=$form->getValue('parentid');
    			$unitname =$form->getValue('unitname');
    			if($parentid==0)
    			{
    				$unit->setParentid($grandid);
    			}
    			else
    			{
    				$unit->setParentid($parentid);
    			}
    			$unit->setUnitname($unitname);
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
    	$this->view->form = $form;
    	$unitid =$this->getRequest()->getParam('unitid');
    	$mapper  = new Application_Model_UnitMapper();
    	$unit = $mapper->findbyid($unitid);
    	
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$unitname = $form->getValue('unitname');
 
    			$unit->setUnitname($unitname);
    			$mapper->save($unit);

    			return $this->_helper->redirector('index');
    		}
    	}
    	else
    	{
    		$parentunit = $mapper->findbyid($unit->getParentid());
    		 
    		$form->getElement('unitname')->setValue($unit->getUnitname());
    		$form->getElement('parentid')->setValue($parentunit->getUnitname());
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
    			
    			$parentid = $form->getValue('parentunitname');
    			$unitname = $form->getValue('unitname');
    			$this->view->units=$mapper->unitSearch($parentid,$unitname);
    		}
    	}
    	$this->view->form = $form;
    }
    /*
     * 级联单位用
     */
    public function getsecondlevelunitAction()
    {    	
    	$this->_helper->layout->disableLayout();    //disable layout
    	$this->_helper->viewRenderer->setNoRender();//suppress auto-rendering
    	$request = $this->getRequest();
    	$parentid=$request->getParam('parentid');
    	$unitselected = array();
    	
		$mapper = new Application_Model_UnitMapper();
		$units = $mapper->getsubunits($parentid);
    	
		foreach ($units as $item)
		{
			$unit = new unitforselect();
			$unit->Value = $item->getUnitid();
			$unit->Text=$item->getUnitname();
			
			$unitselected[] = $unit;
		}
		echo  Zend_Json::encode($unitselected);
    }
}

class unitforselect
{
	public $Text;
	public $Value;
}














