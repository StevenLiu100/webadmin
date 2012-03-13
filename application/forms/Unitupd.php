<?php

class Application_Form_Unitupd extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
    	$unitid = new Zend_Form_Element_Hidden('unitid');
    	$unitid->addFilter('Int');
    	$this->addElement($unitid);
    	 
    	$this->addElement('text', 'parentid', array(
    			'label'      => '归属大单位',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    	));
    	 
    	$this->addElement('text', 'unitname', array(
    			'label'      => '原二级单位名称',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 100))
    			)
    	));
    	
    	$this->addElement('text', 'unitnamenew', array(
    			'label'      => '新名称',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 100))
    			)
    	));

    	$unitorder = new Zend_Form_Element_Hidden('unitorder');
    	$unitorder->addFilter('Int');
    	$this->addElement($unitorder);
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '保存',
    	));
    }

}

