<?php

class Application_Form_User extends Zend_Form
{
    
    
    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	// Add a username element
    	$this->addElement('text', 'username', array(
    			'label'      => '姓名',
    	    //    'label'      => 'Your username:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 10))
    			)
    	));
    	
    	
    	// Add an email element
    	$this->addElement('text', 'email', array(
    			'label'      => '邮箱',
    	     //   'label'      => 'Your email:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					'EmailAddress',array('validator' => 'StringLength', 'options' => array(0, 100))
    			)
    	));
    
    	// Add a password element
    	$this->addElement('password', 'password', array(
    			'label'      => '密码',
    	    //    'label'      => 'Your password:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
    	// Add a repassword element
    	$this->addElement('password', 'repassword', array(
    			'label'      => '密码确认',
    	     //   'label'      => 'Retype your password:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
    	// Add a mobile element
    	$this->addElement('text', 'mobile', array(
    			'label'      => '手机号',
    	     //   'label'      => 'Your mobile:',
    		//	'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 50))
    			)
    	));
    	// Add a telephone element
    	$this->addElement('text', 'tel', array(
    			'label'      => '固定电话',
    	     //   'label'      => 'Your telephone:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 50))
    			)
    	));
    	// Add a unit element
    	$this->addElement('textarea', 'unit', array(
    			'label'      => '单位',
    	     //   'label'      => 'Your unit:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
    	//Add a userstyle element
    	$this->addElement('select', 'userstyle', array(
    			'label'      => '用户类型',
    	    //    'label'      => 'Your userstyle:',
    			'required'   => true,
    			'attribs' =>   array(
    					'id'=>'userstyle',
    			),
    			'multioptions'   => array(
    					'系统管理员' => '系统管理员',
    					'系统管理用户' => '系统管理用户',
    			        '网站注册用户'=>'网站注册用户',
    			),
    	        'value'=>'网站注册用户',
    	));

        //Add a comment element
        $this->addElement('textarea', 'comment', array(
        		'label'      => '备注',
            //    'label'      => 'Your coment:',
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('validator' => 'StringLength', 'options' => array(0, 500))
        		)
        ));
        // Add a state element
        $this->addElement('radio', 'state', array(
        		'label'      => '状态',
          //      'label'      => 'Your state:',
        		'required'   => true,
        		'attribs' =>   array(
        				'id'=>'state',
        		),
        		'multioptions'   => array(
        				'可用' => '可用',
        				'禁用' => '禁用',
        		),
                'value'=>'可用',
        ));

    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '添加',
    	    //    'label'      => 'add',
    	));

    }
    
}
