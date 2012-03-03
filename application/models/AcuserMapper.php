<?php

class Application_Model_AcuserMapper
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
            $this->setDbTable('Application_Model_DbTable_Acuser');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Acuser $user)
    {
        
        $data = array(
            'username' => $user->getUsername(),
            'email'=> $user->getEmail(),
            'mobile'=>$user->getMobile(),
            'tel' => $user->getTel(),
            'unit'=> $user->getUnit(),
            'comment'=>$user->getComment(),
            'password' => $user->getPassword(),
            'userstyle'=> $user->getUserstyle(),
            'state'=>$user->getState(),
        );

        if (null === ($id = $user->getUserId())) {
            unset($data['userid']);
            $data['passwordsalt']=rand(0,10000);
            date_default_timezone_set('PRC');  
            $data['createdate']=date('Y-m-d H:i:s');
            $data['password']=md5($data['passwordsalt']+ $data['password']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('userid = ?' => $id));
        }
    }
    public function find($id, Application_Model_Acuser $user)
    {
    	$result = $this->getDbTable()->find($id);
    	if (0 == count($result)) {
    		return;
    	}
    	$row = $result->current();
    	$user->setUserId($row->userid);
    	$user->setEmail($row->email);
    	$user->setUserstyle($row->userstyle);
    	$user->setMobile($row->mobile);
    	$user->setTel($row->tel);
    	$user->setUnit($row->unit);
    	$user->setPassword($row->password);
    	$user->setState($row->state);
    	$user->setPasswordsalt($row->passwordsalt);
    	$user->setCreatedate($row->createdate);
    	$user->setUserName($row->username);
    	$user->setComment($row->comment);
    }
    public function fetchAll()
    {
    	$resultSet = $this->getDbTable()->fetchAll();
    	$entries   = array();
    	foreach ($resultSet as $row) {
    		$user = new Application_Model_Acuser();
    		$user->setUserId($row->userid);
    		$user->setEmail($row->email);
    		$user->setUserstyle($row->userstyle);
    		$user->setMobile($row->mobile);
    		$user->setTel($row->tel);
    		$user->setUnit($row->unit);
    		$user->setPassword($row->password);
    		$user->setState($row->state);
    		$user->setPasswordsalt($row->passwordsalt);
    		$user->setCreatedate($row->createdate);
    		$user->setUserName($row->username);
    		$entries[] = $user;
    	}
    	return $entries;
    }
    public function findByName($username)
    {
        if($username==null){
            return $this->fetchAll();
        }
    	//$resultSet = $this->getDbTable()->fetchRow(array('username like ?'=>$username));
    	$resultSet = $this->getDbTable()->fetchAll(
    			$this->getDbTable()->select()
    			->where('username like ?', '%'.$username.'%')
    			->order('username')
    	);
    	$entries   = array();
    	foreach ($resultSet as $row) {
    		$user = new Application_Model_Acuser();
    		$user->setUserId($row->userid);
    	    $user->setEmail($row->email);
    	    $user->setUserstyle($row->userstyle);
    	    $user->setMobile($row->mobile);
    	    $user->setTel($row->tel);
    	    $user->setUnit($row->unit);
    	    $user->setPassword($row->password);
    	    $user->setState($row->state);
    	    $user->setPasswordsalt($row->passwordsalt);
    	    $user->setCreatedate($row->createdate);
    	    $user->setUserName($row->username);
    		$entries[] = $user;
    	}
    	
    	return $entries;
    }
    
    public function remove($userid)
    {
        $this->getDbTable()->delete(array('userid = ?' => $userid));
    }
	}
