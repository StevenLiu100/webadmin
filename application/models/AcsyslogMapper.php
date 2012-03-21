<?php

class Application_Model_AcsyslogMapper {
	
	protected $_dbTable;
	
	public function setDbTable($dbTable) {
		if (is_string ( $dbTable )) {
			$dbTable = new $dbTable ();
		}
		if (! $dbTable instanceof Zend_Db_Table_Abstract) {
			throw new Exception ( 'Invalid table data gateway provided' );
		}
		$this->_dbTable = $dbTable;
		return $this;
	}
	
	public function getDbTable() {
		if (null === $this->_dbTable) {
			$this->setDbTable ( 'Application_Model_DbTable_Acsyslog' );
		}
		return $this->_dbTable;
	}
	
	public function getAllSyslogs($start_date,$end_date) {
		
		$resultSet = $this->getDbTable ()->select()
		->where('date_format(createdate,\'%Y-%m-%d\') >= ?',$start_date)
		->where('date_format(createdate,\'%Y-%m-%d\') <= ?',$end_date)
		->order("createdate DESC")
		->query()->fetchAll();
		
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$syslog = new Application_Model_Acsyslog ();
			$syslog->setLogid ( $row['logid'] );
			$syslog->setUserid ( $row['userid'] );
			
			$user = new Application_Model_Acuser ();
			$userMapper = new Application_Model_AcuserMapper ();
			$userMapper->find ( $row['userid'], $user );
			$syslog->setUsername ( $user->getUsername () );
			
			$syslog->setEvent ( $row['event'] );
			$syslog->setEventtype ( $row['eventtype'] );
			$syslog->setCreatedate ( $row['createdate'] );
			$entries [] = $syslog;
		}
		return $entries;
		// return $resultSet;
	}
	
	public function getSyslogsBySearchContent($username,$start_date,$end_date) {
		if ($username == null){
			return $this->getAllSyslogs($start_date,$end_date);
		} else {		
			$entries = array ();
			$userMapper = new Application_Model_AcuserMapper ();
			$users = $userMapper->findByName ( $username,$username);
			foreach ( $users as $user ) {
				$rows = $this->getDbTable ()->select()->where( 'userid = ?', $user->getUserid () )
													  ->where('date_format(createdate,\'%Y-%m-%d\') >= ?',$start_date)
													  ->where('date_format(createdate,\'%Y-%m-%d\') <= ?',$end_date)
													  ->order("createdate DESC")
													  ->query()->fetchAll();
				//Zend_Debug::dump($start_date);
				foreach($rows as $row)
				if ($row) {
					$syslog = new Application_Model_Acsyslog ();
					$syslog->setLogid ( $row ['logid'] );
					$syslog->setUserid ( $row ['userid'] );
					$syslog->setUsername ( $user->getUsername () );
					$syslog->setEvent ( $row ['event'] );
					$syslog->setEventtype ( $row ['eventtype'] );
					$syslog->setCreatedate ( $row ['createdate'] );
					$entries [] = $syslog;
				}
			}
			return $entries;
		}
	
	}
	
	public function addSyslog($userid,$event,$eventtype){		
		$data = array(
				'userid' => $userid,
				'event'=> $event,
				'eventtype'=>$eventtype,
				'createdate'=>date('Y-m-d H:i:s')
		);
		$this->getDbTable()->insert($data);
	}
	
	public function getSyslog($id) {
		$id = ( int ) $id;
		$row = $this->getDbTable ()->fetchRow ( 'logid = ' . $id );
		if (! $row) {
			throw new Exception ( "Could not find row $id" );
		}
		return $row->toArray ();
	}
	
	public function clearSyslog() {
		$this->getDbTable ()->delete ( '' );
	}
	
	public function deleteSyslog($id) {
		$this->getDbTable ()->delete ( 'logid =' . ( int ) $id );
	}

}

