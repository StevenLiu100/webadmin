<?php

class Application_Form_Unitadd extends Zend_Form
{

    public function init()
    {
    	$mapper = new Application_Model_UnitMapper();
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post');
    	
    	
    	$this->addElement('select', 'parentid', array(
    			'label'      => '一级单位选择',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			
    			'multioptions'   => $mapper->parentunit()
    	));
    	
    	$this->addElement('select', 'subparentid', array(
    			'label'      => '二级单位选择',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			 
    			'multioptions'   => $mapper->parentunit()
    	));
    	
    	$this->addElement('text', 'unitname', array(
    			'label'      => '单位名称',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(2, 100))
    			)
    	));
    	
//     	$unitorder = new Zend_Form_Element_Hidden('unitorder');
//     	$unitorder->addFilter('Int');
//     	$this->addElement($unitorder);
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    	$unitid = new Zend_Form_Element_Hidden('unitid');
    	$unitid->addFilter('Int');
    	$this->addElement($unitid);
    }


}

