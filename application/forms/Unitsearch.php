<?php

class Application_Form_Unitsearch extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$mapper = new Application_Model_UnitMapper();
    	/* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post');
    	$unitid = new Zend_Form_Element_Hidden('unitid');
    	$unitid->addFilter('Int');
    	$this->addElement($unitid);
    	 
    	$this->addElement('select', 'parentunitname', array(
    			'label'      => '大单位选择',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			 
    			'multioptions'   => $mapper->parentunit()
    	));
    	 
    	$this->addElement('text', 'unitname', array(
    			'label'      => '二级单位',
    			'required'   => false,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			)
    	));
    	 
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    }


}

