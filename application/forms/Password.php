<?php
class Application_Form_Password extends Zend_Form
{
    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    	// Add a old password element
    	$this->addElement('password', 'oldpassword', array(
    				'label'      => '原密码:',
    			//'label'      => 'Input your password:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
    	// Add a repassword element
    	$this->addElement('password', 'newpassword', array(
    				'label'      => '新密码:',
    			//'label'      => 'Input your new password:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
    	// Add a renewpassword element
    	$this->addElement('password', 'renewpassword', array(
    				'label'      => '确认新密码:',
    			//'label'      => 'Retype your new password:',
    			'required'   => true,
    			'filters'    => array('StringTrim'),
    			'validators' => array(
    					array('validator' => 'StringLength', 'options' => array(6, 20))
    			)
    	));
        // Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    				'label'    => '修改密码',
    		//	'label'      => 'update password',
    	));
    
    }
    
    
}