<?php

class Application_Form_UserUpdate extends Zend_Form
{

    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	// Add a username element
    	$this->addElement('text', 'username', array(
    			'label'      => '姓名',
    	        'readonly'   => true,
    	));
    	// Add an email element
    	$this->addElement('text', 'email', array(
    			'label'      => '邮箱',
    	    	'readonly'   => true,
    	));
    	// Add a mobile element
    	$this->addElement('text', 'mobile', array(
    			'label'      => '手机号',
    	    	'readonly'   => true,
    	));
    	// Add a telephone element
    	$this->addElement('text', 'tel', array(
    			'label'      => '固定电话',
    	    	'readonly'   => true,
    	));
    	// Add a unit element
    	$this->addElement('textarea', 'unit', array(
    			'label'      => '单位',
    	  		'readonly'   => true,
    	));
    	//Add a userstyle element
    	$this->addElement('select', 'userstyle', array(
    			'label'      => '用户类型',
    			'attribs' =>   array(
    					'id'=>'userstyle',
    			),
    			'multioptions'   => array(
    					'系统管理员' => '系统管理员',
    					'系统管理用户' => '系统管理用户',
    			        '网站注册用户'=>'网站注册用户',
    			),
    	));

        //Add a comment element
        $this->addElement('textarea', 'comment', array(
        		'label'      => '备注',
        		'filters'    => array('StringTrim'),
        		'validators' => array(
        				array('validator' => 'StringLength', 'options' => array(0, 500))
        		)
        ));
        // Add a state element
        $this->addElement('radio', 'state', array(
        		'label'      => '状态',
        		'required'   => true,
        		'attribs' =>   array(
        				'id'=>'state',
        		),
        		'multioptions'   => array(
        				'可用' => '可用',
        				'禁用' => '禁用',
        		),
        ));

    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '修改',
    	));

    }


}

