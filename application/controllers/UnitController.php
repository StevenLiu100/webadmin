<?php
require_once 'BaseController.php';
class UnitController extends BaseController {
	
	public function init() {
		parent::init ();
	}
	
	public function indexAction() {
		// action body
	}
	
	public function unitaddAction() {
		// action body
		$form = new Application_Form_Unitadd ();
		
		if ($this->getRequest ()->isPost ()) {
			$formData = $this->getRequest ()->getPost ();
			
			if ($form->isValid ( $formData )) {
				$unit = new Application_Model_Unit ();
				$grandid = $form->getValue ( 'firstparentid' );
				$parentid = $form->getValue ( 'parentid' );
				$unitname = $form->getValue ( 'unitname' );
				if ($parentid == 0) {
					$unit->setParentid ( $grandid );
				} else {
					$unit->setParentid ( $parentid );
				}
				$unit->setUnitname ( $unitname );
				$mapper = new Application_Model_UnitMapper ();
				$mapper->save ( $unit );
				return $this->_helper->redirector ( 'index' );
			} else {
				$form->populate ( $formData );
			}
		}
		
		$this->view->form = $form;
	}
	
	public function unitdelAction() {
		// action body
		
		$request = $this->getRequest ();
		$unitid = $request->getParam ( 'unitid' );
		
		$mapper = new Application_Model_UnitMapper ();
		$mapper->delete ( $unitid );
		return $this->_helper->redirector ( 'index' );
	}
	
	public function unitupdAction() {
		// action body
		$request = $this->getRequest ();
		
		$form = new Application_Form_Unitupd ();
		$this->view->form = $form;
		$unitid = $this->getRequest ()->getParam ( 'unitid' );
		$mapper = new Application_Model_UnitMapper ();
		$unit = $mapper->findbyid ( $unitid );
		
		$this->view->form = $form;
		
		if ($this->getRequest ()->isPost ()) {
			if ($form->isValid ( $request->getPost () )) {
				$unitname = $form->getValue ( 'unitname' );
				
				$unit->setUnitname ( $unitname );
				$mapper->save ( $unit );
				
				return $this->_helper->redirector ( 'index' );
			}
		} else {
			$parentunit = $mapper->findbyid ( $unit->getParentid () );
			
			$form->getElement ( 'unitname' )->setValue ( $unit->getUnitname () );
			$form->getElement ( 'parentid' )->setValue ( $parentunit->getUnitname () );
		}
	
	}
	
	public function unitsearchAction() {
		// action body
		$request = $this->getRequest ();
		$form = new Application_Form_Unitsearch ();
		$this->view->units = array ();
		if ($this->getRequest ()->isPost ()) {
			if ($form->isValid ( $request->getPost () )) {
				$unit = new Application_Model_Unit ();
				$mapper = new Application_Model_UnitMapper ();
				
				$grandid = $form->getValue ( 'parentunitname1' );
				$parentid = $form->getValue ( 'parentunitname' );
				$unitname = $form->getValue ( 'unitname' );
				$this->view->units = $mapper->unitSearch ( $grandid, $parentid, $unitname );
				
				$prevs = array ();
				$prevs [] = 0;
				foreach ( $this->view->units as $item ) {
					$prevs [] = $item->unitid;
				}
				$nexts = array_slice ( $prevs, 2 );
				$nexts [] = 0;
				$this->view->prevs = $prevs;
				$this->view->nexts = $nexts;
			}
		}
		$this->view->form = $form;
	}
	
	public function getsecondlevelunitAction() {
		$this->_helper->layout->disableLayout (); // disable layout
		$this->_helper->viewRenderer->setNoRender (); // suppress auto-rendering
		$request = $this->getRequest ();
		$parentid = $request->getParam ( 'parentid' );
		$unitselected = array ();
		
		$mapper = new Application_Model_UnitMapper ();
		$units = $mapper->getsubunits ( $parentid );
		
		foreach ( $units as $item ) {
			$unit = new unitforselect ();
			$unit->Value = $item->getUnitid ();
			$unit->Text = $item->getUnitname ();
			
			$unitselected [] = $unit;
		}
		echo Zend_Json::encode ( $unitselected );
	}
	
	public function unitupAction() {
		// action body
		$request = $this->getRequest ();
		$id = $request->getParam ( 'unitid' );
		$prev = $request->getParam ( 'prev' );
		if ($prev != 0) {
			$mapper = new Application_Model_UnitMapper ();
			$mapper->swapapporder ( $id, $prev );
		}
		return $this->_helper->redirector ( 'unitsearch' );
	}
	
	public function unitdownAction() {
		// action body
		$request = $this->getRequest ();
		$id = $request->getParam ( 'unitid' );
		$next = $request->getParam ( 'next' );
		
		if ($next != 0) {
			$mapper = new Application_Model_UnitMapper ();
			$mapper->swapapporder ( $id, $next );
		}
		return $this->_helper->redirector ( 'unitsearch' );
	}
	public function unitsearchforajaxAction() {
		
		$this->_helper->layout->disableLayout (); // disable layout
		$this->_helper->viewRenderer->setNoRender ();
		$request = $this->getRequest ();
		$unit = new Application_Model_Unit ();
		$mapper = new Application_Model_UnitMapper ();
		$grandid = $request->getParam ( 'unit1' );
		$parentid = $request->getParam ( 'unit2' );
		$unitname = $request->getParam ( 'unitname' );
		$units = $mapper->unitSearch ( $grandid, $parentid, $unitname );
		$unitArray = array ();
		$index = 0;
		$previd = 0;
		$nextid = 0;
		foreach ( $units as $item ) {
			$aunit = new fullunitinfo ();
			$aunit->unitid = $item->unitid;
			$aunit->parentid = $item->parentid;
			$aunit->grandunitname = $item->grandunitname;
			$aunit->parentunitname = $item->parentunitname;
			$aunit->unitname = $item->unitname;
			$aunit->unitorder = $item->unitorder;
			
			
			$aunit->updateunit = "<a class='btn_edit' href='/unit/unitupd/unitid/" . $item->unitid . "'></a>";
			$aunit->deleteunit = "<a class='btn_del' href='/unit/unitdel/unitid/" . $item->unitid . "'></a>";

			if ($index != 0) {
				$previd=$units[$index - 1]->unitid;
				//如果是最后一行
				if ($index == count ( $units ) - 1) {
					$nextid = 0;
				} else {
			 		$nextid=$units[$index]->unitid;
				}
			}else{//第一行赋值
				$previd=0;
				if(count($units)>1){
					$nextid=$units[1]->unitid;
				}else{
					$nextid=0;//只有一行值的情况
				}
				
			}
			$aunit->orderunit = "<button class='orderup' tag='/unit/unitup/unitid/" . $item->unitid . "/prev/".$previd."'></button>" . "<button class='orderdown' tag='/unit/unitdown/unitid/" . $item->unitid ."/next/".$nextid. "'></button>";
			$aunit->order = $item->order;
			$unitArray [] = $aunit;

			$index = $index + 1;
		}
		// $this->view->units=$units;
		$output = array ("sEcho" => 1, "iTotalRecords" => count ( $units ), "iTotalDisplayRecords" => 10, "aaData" => array () );
		$output ['aaData'] = $unitArray;
		// $this->view->units=$units;
		echo json_encode ( $output );
	}

}

class unitforselect {
	public $Text;
	public $Value;
}

class fullunitinfo {
	public $unitid;
	public $grandunitname;
	public $parentid;
	public $parentunitname;
	public $unitname;
	public $unitorder;
	public $updateunit;
	public $deleteunit;
	public $orderunit;
	public $order;
}




















