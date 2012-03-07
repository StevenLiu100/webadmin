<?php

class Application_Form_UserInfo extends Zend_Form
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
    	$username = new Zend_Form_Element_Text('username');
    	$username->setLabel('用户名')
  				->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_2_10);
    	$password = new Zend_Form_Element_Password('password');
    	$password->setLabel('密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$repassword = new Zend_Form_Element_Password('repassword');
    	$repassword->setLabel('确认密码')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_6_20);
    	$email = new Zend_Form_Element_Text('email');
    	$email->setLabel('邮箱')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_isEmpty_email)
    			->addValidator($validator_stringlength_0_100);
    	$mobile = new Zend_Form_Element_Text('mobile');
    	$mobile->setLabel('手机号')
    			//->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_0_50);
    	$tel = new Zend_Form_Element_Text('tel');
    	$tel->setLabel('固定电话')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_0_50);
    	$unit = new Zend_Form_Element_Textarea('unit');
    	$unit->setLabel('单位')
    			->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_0_100);
    	$userstyle = new Zend_Form_Element_Select('userstyle');
    	$userstyle->setLabel('用户类型')
    			->setRequired(true)
    			->addMultiOptions(array(
    					'系统管理员' => '系统管理员',
    					'系统管理用户' => '系统管理用户',
    			        '网站注册用户'=>'网站注册用户'))
        		->setValue('网站注册用户');
    	$comment = new Zend_Form_Element_Textarea('comment');
    	$comment->setLabel('备注')
    			//->setRequired(true)
    			->setFilters(array('StringTrim'))
    			->addValidator($validator_isEmpty)
    			->addValidator($validator_stringlength_0_200);
    	$state = new Zend_Form_Element_Radio('state');
    	$state->setLabel('状态')
    			->setRequired(true)
    			->addMultiOptions(array(
    					'可用' => '可用',
        				'禁用' => '禁用',))
        		->setValue('可用');
    	$submit =  new Zend_Form_Element_Submit('submit');
    	$submit->setLabel('');
    	
    	$this->addElements(array($username,$email,$password,$repassword,$mobile,$tel,$unit,$userstyle,$comment,$state,$submit));
    	
    	
    	
    	
    	
    	
//     	// Add a username element
//     	$this->addElement('text', 'username', array(
//     			'label'      => '姓名',
//     	    //    'label'      => 'Your username:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(2, 10))
//     			)
//     	));
    	
    	
//     	// Add an email element
//     	$this->addElement('text', 'email', array(
//     			'label'      => '邮箱',
//     	     //   'label'      => 'Your email:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					'EmailAddress',array('validator' => 'StringLength', 'options' => array(0, 100))
//     			)
//     	));
    
//     	// Add a password element
//     	$this->addElement('password', 'password', array(
//     			'label'      => '密码',
//     	    //    'label'      => 'Your password:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//     	// Add a repassword element
//     	$this->addElement('password', 'repassword', array(
//     			'label'      => '密码确认',
//     	     //   'label'      => 'Retype your password:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//     	// Add a mobile element
//     	$this->addElement('text', 'mobile', array(
//     			'label'      => '手机号',
//     	     //   'label'      => 'Your mobile:',
//     		//	'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(0, 50))
//     			)
//     	));
//     	// Add a telephone element
//     	$this->addElement('text', 'tel', array(
//     			'label'      => '固定电话',
//     	     //   'label'      => 'Your telephone:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(0, 50))
//     			)
//     	));
//     	// Add a unit element
//     	$this->addElement('textarea', 'unit', array(
//     			'label'      => '单位',
//     	     //   'label'      => 'Your unit:',
//     			'required'   => true,
//     			'filters'    => array('StringTrim'),
//     			'validators' => array(
//     					array('validator' => 'StringLength', 'options' => array(6, 20))
//     			)
//     	));
//     	//Add a userstyle element
//     	$this->addElement('select', 'userstyle', array(
//     			'label'      => '用户类型',
//     	    //    'label'      => 'Your userstyle:',
//     			'required'   => true,
//     			'attribs' =>   array(
//     					'id'=>'userstyle',
//     			),
//     			'multioptions'   => array(
//     					'系统管理员' => '系统管理员',
//     					'系统管理用户' => '系统管理用户',
//     			        '网站注册用户'=>'网站注册用户',
//     			),
//     	        'value'=>'网站注册用户',
//     	));

//         //Add a comment element
//         $this->addElement('textarea', 'comment', array(
//         		'label'      => '备注',
//             //    'label'      => 'Your coment:',
//         		'filters'    => array('StringTrim'),
//         		'validators' => array(
//         				array('validator' => 'StringLength', 'options' => array(0, 500))
//         		)
//         ));
//         // Add a state element
//         $this->addElement('radio', 'state', array(
//         		'label'      => '状态',
//           //      'label'      => 'Your state:',
//         		'required'   => true,
//         		'attribs' =>   array(
//         				'id'=>'state',
//         		),
//         		'multioptions'   => array(
//         				'可用' => '可用',
//         				'禁用' => '禁用',
//         		),
//                 'value'=>'可用',
//         ));

//     	// Add a submit button
//     	$this->addElement('submit', 'submit', array(
//     			'ignore'   => true,
//     			'label'    => '添加',
//     	    //    'label'      => 'add',
//     	));

    }
    
}
