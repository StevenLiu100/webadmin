<?php

class Application_Form_UserSearch extends Zend_Form
{
    
    
    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	// Add a username element
    	$this->addElement('text', 'searchinput', array(
    			'label'      => '查询条件:',
    	));
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    	//add a sort field element
//     	$this->addElement('select', 'sortfield', array(
//     			'label'      => '排序属性:',
// 				'required'   => true,
//     			'multioptions'   => array(
//     					'username' => '用户名',
//     					'email' => '邮箱',
//     			        'unit'=>'单位',
//     					'state' => '状态',
//     					'createdate' => '创建时间',
//     			),
//     	        'value'=>'username',
//     	));
//     	// Add a submit button
//     	$this->addElement('submit', 'submit', array(
//     			'ignore'   => true,
//     			'label'    => '',
//     	));

    }
    
}
