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
	
	public function getAllSyslogs() {
		$resultSet = $this->getDbTable ()->fetchAll ();
		$entries = array ();
		foreach ( $resultSet as $row ) {
			$syslog = new Application_Model_Acsyslog ();
			$syslog->setLogid ( $row->logid );
			$syslog->setUserid ( $row->userid );
			
			$user = new Application_Model_Acuser ();
			$userMapper = new Application_Model_AcuserMapper ();
			$userMapper->find ( $row->userid, $user );
			$syslog->setUsername ( $user->getUsername () );
			
			$syslog->setEvent ( $row->event );
			$syslog->setEventtype ( $row->eventtype );
			$syslog->setCreatedate ( $row->createdate );
			$entries [] = $syslog;
		}
		return $entries;
		// return $resultSet;
	}
	
	public function getSyslogsByUserName($username) {
		if ($username == null) {
			return $this->getAllSyslogs ();
		} else {
			
			$entries = array ();
			
			$userMapper = new Application_Model_AcuserMapper ();
			$users = $userMapper->findByName ( $username );
			foreach ( $users as $user ) {
				$rows = $this->getDbTable ()->select()->where( 'userid = ?', $user->getUserid () )->query()->fetchAll();
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
			
			// $select = $this->getDbTable ()->select ()->where ( 'userid = ?',
			// $un[0] )->order ( 'logid DESC' );
			
			// $stmt = $select->query ();
			// $results = $stmt->fetchall ();
			
			// $entries = array ();
			// foreach ( $results as $row ) {
			// $syslog = new Application_Model_Acsyslog ();
			// $syslog->setLogid ( $row->logid );
			// $syslog->setUserid ( $row->userid );
			
			// $user = new Application_Model_Acuser ();
			
			// $userMapper->find ( $row->userid, $user );
			// $syslog->setUsername ( $user->getUsername () );
			
			// $syslog->setEvent ( $row->event );
			// $syslog->setEventtype ( $row->eventtype );
			// $syslog->setCreatedate ( $row->createdate );
			// $entries [] = $syslog;
			// }
			return $entries;
		}
	
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

