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
			$this->setDbTable('Application_Model_DbTable_Unit');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Unit $unit)
	{
		$id = $unit->getUnitid();
		$parentid = $unit->getParentid();

		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('parentid = ?', $parentid)
				->order('unitorder')				
		);
		$maxnum = $resultSet->count()+1;
		
		foreach($resultSet as $item)
		{
			if($maxnum<$item->unitorder+1)
			{
				$maxnum = $item->unitorder+1;
			}
		}
		
		if ($id == 0) {
			$data = array(
				'unitname' => $unit->getUnitname(),
				'parentid'=> $parentid,
				'unitorder'=>$maxnum,
			);	
		
			unset($data['unitid']);
			$this->getDbTable()->insert($data);
		} else 
		{
			$data = array(
					'unitname' => $unit->getUnitname(),
					'parentid'=> $parentid,
					'unitorder'=>$unit->getUnitorder(),
			);
			
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
				//->where('unitname like ? and parentid = ?', '%'.$key.'%', $parentid)
				->where('unitname like ? ', '%'.$key.'%')
				->where('parentid = ? ', $parentid)
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
			$units[$row->unitid] = $row->unitname;
		}
		return $units;
	}
	
	public function getsubunits($unitid)
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('parentid = ?', $unitid)
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
	/*
	 * steven 加入为了给第二级单位select赋值
	 */
	public function getsubunitsforselect($unitid)
	{
		$resultSet = $this->getDbTable()->fetchAll(
				$this->getDbTable()->select()
				->where('parentid = ?', $unitid)
				->order('unitorder')
		);
		$units = array();
		$units[0]="无";
		foreach ($resultSet as $row) {
			$units[$row->unitid] = $row->unitname;
		}
		return $units;
	}
	public function findbyid($unitid)
	{
		$unit = new Application_Model_Unit();
	
		$result = $this->getDbTable()->find($unitid);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
	
		$unit->setUnitid($row->unitid);
		$unit->setUnitname($row->unitname);
		$unit->setParentid($row->parentid);
		$unit->setUnitorder($row->unitorder);
	
		return $unit;
	}
}

