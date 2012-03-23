<?php

class Application_Form_Unitsearch extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$mapper = new Application_Model_UnitMapper();
    	$this->setMethod('post');

    	$this->addElement('select', 'parentunitname1', array(
    			'label'      => '一级单位选择',
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    	
    			'multioptions'   => $mapper->parentunit()
    	));
    	
    	$this->addElement('select', 'parentunitname', array(
    			'label'      => '二级单位选择',
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			'multioptions'   => $mapper->getsubunitsforselect(1)
    	));

    	$this->addElement('text', 'unitname', array(
    			'label'      => '单位名称',
    			'required'   => false,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			)
    	));
    	 
    	// Add a submit button
    	$this->addElement('button', 'submitsearch', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    	
    	/* Form Elements & Other Definitions Here ... */
    	$unitid = new Zend_Form_Element_Hidden('unitid');
    	$unitid->addFilter('Int');
    	$this->addElement($unitid);
    }


}

