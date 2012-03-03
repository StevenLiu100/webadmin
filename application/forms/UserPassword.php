<?php
class Application_Form_UserPassword extends Zend_Form
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
    	$password = new Zend_Form_Element_Password('password');
    	$password->setLabel('原密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$newpassword = new Zend_Form_Element_Password('newpassword');
    	$newpassword->setLabel('新密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$renewpassword = new Zend_Form_Element_Password('renewpassword');
    	$renewpassword->setLabel('确认新密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$submit =  new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('修改密码');
    	
    	$this->addElements(array($password,$newpassword,$renewpassword,$submit));
//     	// Add a old password element
//     	$this->addElement('password', 'oldpassword', array(
//     				'label'      => '原密码:',
//     			//'label'      => 'Input your password:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//     	// Add a repassword element
//     	$this->addElement('password', 'newpassword', array(
//     				'label'      => '新密码:',
//     			//'label'      => 'Input your new password:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//     	// Add a renewpassword element
//     	$this->addElement('password', 'renewpassword', array(
//     				'label'      => '确认新密码:',
//     			//'label'      => 'Retype your new password:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//         // Add a submit button
//     	$this->addElement('submit', 'submit', array(
//     			'ignore'   => true,
//     				'label'    => '修改密码',
//     		//	'label'      => 'update password',
//     	));
    
    }
    
    
}