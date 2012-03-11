<?php

class Application_Form_Application extends Zend_Form
{

	public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    	$appid = new Zend_Form_Element_Hidden('applicationid');
    	$appid->addFilter('Int');
    	$this->addElement($appid);
    	
    	// Add a username element
    	$this->addElement('text', 'applicationname', array(
    			'label'      => '系统名称',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 50))
    			)
    	));
    	
    	$this->addElement('textarea', 'description', array(
    			'label'      => '系统描述',
    			'required'   => false,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 200))
    			)
    	));
    	
    	$this->addElement('radio', 'enable', array(
    			'label'      => '系统状态',
    			'required'   => true,
    			'attribs' =>   array(
    					'id'=>'state',
    			),
    			'multioptions'   => array(
    					'1' => '可用',
    					'0' => '禁用',
    			),
    			'value'=>'1',
    	));
    	
    	$this->addElement('text', 'apporder', array(
    			'label'      => '系统编号',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 50))
    			)
    	));
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '增加',
    			//    'label'      => 'add',
    	));
    }

}

