<?php

class Application_Model_AcapplicationMapper
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
			$this->setDbTable('Application_Model_DbTable_Acapplication');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Acapplication $app)
	{
		$id = $app->getApplicationid();

		$resultSet = $this->getDbTable()->fetchAll();
		$maxsum = $resultSet->count()+1;
		foreach ($resultSet as $row)
		{
			if($maxsum<$row->apporder+1)
			{
				$maxsum = $row->apporder+1;
			}
		}
		
		if($id == 0)
		{
			$data = array(
				'applicationname' => $app->getApplicationname(),
				'description'=> $app->getDescription(),
				'enable'=>$app->getEnable(),
				'apporder'=>$maxsum,
			);
			unset($data['applicationid']);
			$this->getDbTable()->insert($data);
		}
		else 
		{
			$data = array(
					'applicationname' => $app->getApplicationname(),
					'description'=> $app->getDescription(),
					'enable'=>$app->getEnable(),
					'apporder'=>$app->getApporder(),
			);
			$this->getDbTable()->update($data, array('applicationid = ?' => $id));
		}
	}
	
	public function fetchAll()
	{
		$resultSet = $this->getDbTable()->fetchAll(null,'apporder asc');

		$apps   = array();
		foreach ($resultSet as $row) {
			$app = new Application_Model_Acapplication();
			$app->setApplicationid($row->applicationid);
			$app->setApplicationname($row->applicationname);
			$app->setDescription($row->description);
			$app->setEnable($row->enable);
			$app->setApporder($row->apporder);
			$apps[] = $app;
		}
		return $apps;
	}
	
	public function delete($applicationid)
	{
		$this->getDbTable()->delete(array('applicationid = ?' => $applicationid));
	}
	
	public function findbyid($appid)
	{
		$app = new Application_Model_Acapplication();
		
		$result = $this->getDbTable()->find($appid);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		
		$app->setApplicationid($row->applicationid);
		$app->setApplicationname($row->applicationname);
		$app->setDescription($row->description);
		$app->setEnable($row->enable);
		$app->setApporder($row->apporder);
		
		return $app;
	}
	
	public function getrowbyid($appid)
	{
		$result = $this->getDbTable()->find($appid);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
	
		return $row->toArray();
	}
	
	public function swapapporder($appid1,$appid2)
	{
		$app1=$this->findbyid($appid1);
		$app2=$this->findbyid($appid2);
		
		$unitid= $app1->getApporder();
		
		$app1->setApporder($app2->getApporder());
		$app2->setApporder($unitid);
		
		$this->save($app1);
		$this->save($app2);	
	}
}

