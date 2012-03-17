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
    public function getfirstlevelunit()
    {
    	/*
    	 * 得到一级单位列表，返回格式应该是
    	*
    	*    [{
    	*        "Text": "一级单位1",
    	*        "Value": "1"
    	*    },
    	*    {
    	*        "Text": "一级单位2",
    	*        "Value": "2"
    	*    }]
    	*    其中text是单位名称，value是unitid
    	*    
    	*/
    	$unitnames = array();
    	
		$mapper = new Application_Model_UnitMapper();
		$units = $mapper->getsubunits('0');
    	
		foreach ($units as $item)
		{
			$unit = new unitname();
			$unit->unitid = $item->getUnitid();
			$unit->unitname=$item->getUnitname();
			
			$unitnames[] = $unit;
		}

		return $unitnames;
    }
    public function getsecondlevelunit($parentid)
    {
    	/*
    	 * 通过一级单位的ID,得到二级单位列表，返回格式应该是
    	*
    	*    [{
    	*        "Text": "二级单位1",
    	*        "Value": "5"
    	*    },
    	*    {
    	*        "Text": "二级单位2",
    	*        "Value": "6"
    	*    }]
    	*    其中text是单位名称，value是unitid
    	*
    	*/
    	$unitnames = array();
    	
		$mapper = new Application_Model_UnitMapper();
		$units = $mapper->getsubunits($parentid);
    	
		foreach ($units as $item)
		{
			$unit = new unitname();
			$unit->unitid = $item->getUnitid();
			$unit->unitname=$item->getUnitname();
			
			$unitnames[] = $unit;
		}
		
		return $unitnames;
    }


}

class unitname
{
	public $unitname;
	public $unitid;
}














