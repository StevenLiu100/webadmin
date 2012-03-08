<?php

class Application_Form_Userlogin extends Zend_Form
{

    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	$validator_isEmpty = new Zend_Validate_NotEmpty();
    	$validator_isEmpty->setMessage('这里不能为空',Zend_Validate_NotEmpty::IS_EMPTY);
    	
    	$validator_isEmpty_email = new Zend_Validate_EmailAddress();
    	$validator_isEmpty_email ->setMessages(array(
    			'emailAddressInvalid'=>'邮箱格式不对',
    			'emailAddressInvalidHostname'=>'邮箱格式不对',
    			'emailAddressInvalidMxRecord'=>'邮箱格式不对',
    			'emailAddressDotAtom'=>'邮箱格式不对',
    			'emailAddressQuotedString'=>'邮箱格式不对',
    			'emailAddressInvalidFormat'=>'邮箱格式不对',
    			'emailAddressInvalidSegment'=>'邮箱格式不对',
    			'emailAddressInvalidLocalPart'=>'邮箱格式不对'));
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID_FORMAT);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID_HOSTNAME);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID_LOCAL_PART);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID_MX_RECORD);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::INVALID_SEGMENT);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::DOT_ATOM);
//     	$validator_isEmpty_email->setMessage('邮箱格式不对',Zend_Validate_EmailAddress::LENGTH_EXCEEDED);
    	$validator_stringlength_2_10=new Zend_Validate_StringLength(array('min' => 2,'max' => 10));
    	$validator_stringlength_2_10->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_2_10->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	$validator_stringlength_6_20=new Zend_Validate_StringLength(array('min' => 6,'max' => 20));
    	$validator_stringlength_6_20->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_6_20->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	$validator_stringlength_0_100=new Zend_Validate_StringLength(array('min' => 0,'max' => 100));
    	$validator_stringlength_0_100->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_0_100->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	$validator_stringlength_0_50=new Zend_Validate_StringLength(array('min' => 0,'max' => 50));
    	$validator_stringlength_0_50->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_0_50->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	$validator_stringlength_0_200=new Zend_Validate_StringLength(array('min' => 0,'max' => 200));
    	$validator_stringlength_0_200->setMessage('少于 %min% 个字符',Zend_Validate_StringLength::TOO_SHORT);
    	$validator_stringlength_0_200->setMessage('多于 %max% 个字符',Zend_Validate_StringLength::TOO_LONG);
    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('登录邮箱')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_isEmpty_email)
    			->addValidator($validator_stringlength_0_100);
    	$password = new Zend_Form_Element_Password('password');
    	$password->setLabel('密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$submit =  new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('登录');

    	$this->addElements(array($email,$password,$submit));

    }


}

