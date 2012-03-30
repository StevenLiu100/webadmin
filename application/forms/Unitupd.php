<?php

class Application_Form_Unitupd extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $validator_isEmpty = new Zend_Validate_NotEmpty();
        $validator_isEmpty->setMessage('这里不能为空',Zend_Validate_NotEmpty::IS_EMPTY);
        
        $validator_stringlength_2_100 = new Zend_Validate_StringLength(array('min' => 2,'max' => 100));
        $validator_stringlength_2_100->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
        $validator_stringlength_2_100->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);

    	$this->addElement('text', 'parentid', array(
    			'label'      => '归属大单位',
    			'required'   => true,
    			'readonly' => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(0, 100))
    			),
    	));

    	$unitname = new Zend_Form_Element_Text('unitname');
    	$unitname->setLabel('新单位名称')
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

