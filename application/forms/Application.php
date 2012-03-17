<?php

class Application_Form_Application extends Zend_Form
{

	public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	
    	// Set the method for the display form to POST
    	$this->setMethod('post');

    	//applicationid 放到了submit的后面，不然影响布局  
    	
    	$validator_isEmpty = new Zend_Validate_NotEmpty();
    	$validator_isEmpty->setMessage('这里不能为空',Zend_Validate_NotEmpty::IS_EMPTY);
    	
    	$validator_stringlength_2_50=new Zend_Validate_StringLength(array('min' => 2,'max' => 50));
    	$validator_stringlength_2_50->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_2_50->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	
    	$validator_stringlength_200=new Zend_Validate_StringLength(array('max' => 200));
    	$validator_stringlength_200->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	
    	$applicationname = new Zend_Form_Element_Text('applicationname');
    	$applicationname->setLabel('系统名称')
    	->setRequired(true)
    	->setFilters(array('StringTrim'))
    	->addValidator($validator_isEmpty)
    	->addValidator($validator_stringlength_2_50);
    	
    	$this->addElement($applicationname);
    	
    	$description = new Zend_Form_Element_Textarea('description');
    	$description->setLabel('系统描述')
    	->setRequired(false)
    	->setFilters(array('StringTrim'))
    	->addValidator($validator_stringlength_200);

    	$this->addElement($description);
    	
    	$enable = new Zend_Form_Element_Radio('enable');
    	$enable->setLabel('系统状态')
    	->setRequired(true)
    	->addMultiOptions(array(
    					'1' => '可用',
        				'0' => '禁用',))
        		->setValue('1');
    	
    	$this->addElement($enable);
    	
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    	));
    	
    	$appid = new Zend_Form_Element_Hidden('applicationid');
    	$appid->addFilter('Int');
    	$this->addElement($appid);
    	$approder = new Zend_Form_Element_Hidden('apporder');
    	$approder->addFilter('Int');
    	$this->addElement($approder);
    }

}

