<?php

class Application_Model_UnitMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if (is_string($dbTable)) {
			$dbTable = new $dbTable();
		}
		if (!$dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception('Invalid table data gateway provided');
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable()
	{
		if (null === $this->_dbTable) {
			$this->setDbTable('Application_Model_Unit');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Unit $unit)
	{
		$id = $unit->getUnitid();
			
		$data = array(
				'unitname' => $unit->getUnitname(),
				'parentid'=> $unit->getParentid(),
				'unitorder'=>$unit->getUnitorder(),
		);
	
		if ($id == 0) {
			unset($data['unitid']);
			$this->getDbTable()->insert($data);
		} else {
			$this->getDbTable()->update($data, array('unitid = ?' => $id));
		}
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll();
		$units   = array();
		foreach ($resultSet as $row) {
			$unit = new Application_Model_Unit();
			$unit->setUnitid($row->unitid);
			$unit->setUnitname($row->unitname);
			$unit->setParentid($row->parentid);
			$unit->setUnitorder($row->unitorder);

			$units[] = $unit;
		}
		return $units;
	}
	
	public function delete($unitid)
	{
		$this->getDbTable()->delete(array('unitid = ?' => $unitid));
	}
	
	public function unitSearch($parentid, $key)
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('unitname like ? and parentid = ?', '%'.$key.'%', $parentid)
				->order('unitorder')
		);
		
		$units   = array();
		foreach ($resultSet as $row) {
			$unit = new Application_Model_Unit();
			$unit->setUnitid($row->unitid);
			$unit->setUnitname($row->unitname);
			$unit->setParentid($row->parentid);
			$unit->setUnitorder($row->unitorder);
		
			$units[] = $unit;
		}
		return $units;
	}
	
	public function parentunit()
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('parentid = ?', 0)
				->order('unitorder')
		);
		
		$units = array();
		foreach ($resultSet as $row) {
			$unit = $row->unitid.'=>'.$row->unitname;

			$units[] = $unit;
		}
		return $units;
	}
}

