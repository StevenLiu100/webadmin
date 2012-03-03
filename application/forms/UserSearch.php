<?php

class Application_Form_UserSearch extends Zend_Form
{
    
    
    public function init()
    {
    	// Set the method for the display form to POST
    	$this->setMethod('post');
    
    	// Add a username element
    	$this->addElement('text', 'username', array(
    			'label'      => '用户名:',
    	    //    'label'      => 'username:',
//     			'filters'    => array('StringTrim'),
//     	        'validators' => array(
//     	        		array('validator' => 'StringLength', 'options' => array(0, 10))
//     	        )
    	));

    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '查找',
    	    //    'label'      => 'search',
    	));

    }
    
}
