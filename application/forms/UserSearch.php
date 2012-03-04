<?php

class Application_Form_UserSearch extends Zend_Form
{
    
    
    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	// Add a username element
    	$this->addElement('text', 'username', array(
    			'label'      => '用户名:',
    	    //    'label'      => 'username:',
//     			'filters'    => array('StringTrim'),
//     	        'validators' => array(
//     	        		array('validator' => 'StringLength', 'options' => array(0, 10))
//     	        )
    	));
    	$this->addElement('select', 'sortfield', array(
    			'label'      => '排序属性:',
				'required'   => true,
//     			'attribs' =>   array(
//     					'id'=>'userstyle',
//     			),
    			'multioptions'   => array(
    					'username' => '用户名',
    					'email' => '邮箱',
    			        'unit'=>'单位',
    					'state' => '状态',
    					'createdate' => '创建时间',
    			),
    	        'value'=>'username',
    	));
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '查找',
    	    //    'label'      => 'search',
    	));

    }
    
}
