<?php

class Application_Form_SyslogSearch extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	
    	ZendX_JQuery::enableForm($this);
    	
    	$elem = new ZendX_JQuery_Form_Element_DatePicker('start_date', array(
    			'label' 		=> '时间',
    			'required'		=> false,
    			'jQueryParams'	=> array(
    					'minDate'	 => '+1'
    			)));
    	
    	$this->addElement($elem);
    	
    	$elem = new ZendX_JQuery_Form_Element_DatePicker('end_date', array(
    			'label' 		=> '至',
    			'required'		=> false,
    			'jQueryParams'	=> array(
    					'minDate'	 	=> '+1')
    	));
    	
   	$this->addElement($elem);
   	// Add a username element
   	$this->addElement('text', 'usernamelog', array(
   			'label'      => '用户名:'
   	));
    	  	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '',
    			//    'label'      => 'search',
    	));
    	
    }

}

