<?php

class Application_Form_Unitadd extends Zend_Form
{

    public function init()
    {
    	$mapper = new Application_Model_UnitMapper();
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post');
    	$validator_isEmpty = new Zend_Validate_NotEmpty();
    	$validator_isEmpty->setMessage('这里不能为空',Zend_Validate_NotEmpty::IS_EMPTY);
    	 
    	$validator_stringlength_2_100 =new Zend_Validate_StringLength(array('min' => 2,'max' => 100));
    	$validator_stringlength_2_100->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_2_100->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	
    	$this->addElement('select', 'firstparentid', array(
    			'label'      => '一级单位选择',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			
    			'multioptions'   => $mapper->parentunit()
    	));
    	
    	$this->addElement('select', 'parentid', array(
    			'label'      => '二级单位选择',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    			 
    			'multioptions'   => $mapper->parentunit()
    	));
    	
    	$unitname = new Zend_Form_Element_Text('unitname');
    	$unitname->setLabel('单位名称')
    	->setRequired(true)
    	->setFilters(array('StringTrim'))
    	->addValidator($validator_stringlength_2_100);
    	$this->addElement($unitname);
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    	$unitid = new Zend_Form_Element_Hidden('unitid');
    	$unitid->addFilter('Int');
    	$this->addElement($unitid);
    	$unitorder = new Zend_Form_Element_Hidden('unitorder');
    	$unitorder->addFilter('Int');
    	$this->addElement($unitorder);
    }


}

