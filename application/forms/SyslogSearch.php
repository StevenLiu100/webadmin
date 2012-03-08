<?php

class Application_Form_SyslogSearch extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('post');
    	
    	ZendX_JQuery::enableForm($this);
    	// Add a username element
    	$this->addElement('text', 'username', array(
    			'label'      => '用户名:'
    	));
    	
    	
    	$elem = new ZendX_JQuery_Form_Element_DatePicker('start_date', array(
    			'label' 		=> '时间',
    			'required'		=> false,
    			'validators'	=> array('Date'),
    			'jQueryParams'	=> array(
    					'dateFormat' => 'dd-mm-yy',
    					'minDate'	 => '+1'
    			)));
    	
    	$this->addElement($elem);
    	
    	$elem = new ZendX_JQuery_Form_Element_DatePicker('end_date', array(
    			'label' 		=> '至',
    			'required'		=> false,
    			'validators'	=> array('Date'),
    			'jQueryParams'	=> array(
    					'dateFormat' 	=> 'dd-mm-yy',
    					'minDate'	 	=> '+1')
    	));
    	
   	$this->addElement($elem);
    	
//     	$element = new ZendX_JQuery_Form_Element_DatePicker(
//     			'dp1',
//     			array('jQueryParams' => array('defaultDate' => '2007/10/10'))
//     	);
    	
// //	   	$this->view->datePicker("dp1", "", array('defaultDate' => '2007/10/10'), array());
    	
//     	$this->addElement($element);
    	
//     	$this->addElement('datePicker','fromdate', array(
//     			'label' => '开始日期:',
//     			'required'=> true
//     	)
//     	);
    	
//     	$this->addElement('date', 'from_date', array(
//     			'label'    =>  '开始日期:',
//     			));
    	
    	
//     	$this->addElement(
//     			'DateTextBox',
// 				'datebox',
// 				array(
// 						'value' => '2008-07-05',
// 						'label' => 'DateTextBox',
// 						'required'  => true,
//     			)
//     	);
    	
//     	$this->addElement ( 'DateTextBox', 'foo', 
//     			array ('label' => 'Date:', 'required' => true, 
//     					'invalidMessage' => 'Invalid date specified.', 
//     					'formatLength' => 'long' ) );
    	 
    	
    	// Add a submit button
    	$this->addElement('submit', 'submit', array(
    			'ignore'   => true,
    			'label'    => '查询',
    			//    'label'      => 'search',
    	));
    	
    	
    	
//     	foreach ($this->getSubForms() as $subForm) {
//     		Zend_Dojo::enableForm($subForm);
    }

// 	protected $_selectOptions = array(
// 			'red'    => 'Rouge',
// 			'blue'   => 'Bleu',
// 			'white'  => 'Blanc',
// 			'orange' => 'Orange',
// 			'black'  => 'Noir',
// 			'green'  => 'Vert',
// 	);
	
// 	/**
// 	 * Form initialization
// 	 *
// 	 * @return void
// 	 */
// 	public function init()
// 	{
// 		$this->setMethod('post');
// 		$this->setAttribs(array(
// 				'name'  => 'masterForm',
// 		));
// 		$this->setDecorators(array(
// 				'FormElements',
// 				array('TabContainer', array(
// 						'id' => 'tabContainer',
// 						'style' => 'width: 600px; height: 500px;',
// 						'dijitParams' => array(
// 								'tabPosition' => 'top'
// 						),
// 				)),
// 				'DijitForm',
// 		));
// 		$textForm = new Zend_Dojo_Form_SubForm();
// 		$textForm->setAttribs(array(
// 				'name'   => 'textboxtab',
// 				'legend' => 'Text Elements',
// 				'dijitParams' => array(
// 						'title' => 'Text Elements',
// 				),
// 		));
// 		$textForm->addElement(
// 				'TextBox',
// 				'textbox',
// 				array(
// 						'value'      => 'some text',
// 						'label'      => 'TextBox',
// 						'trim'       => true,
// 						'propercase' => true,
// 				)
// 		)
// 		->addElement(
// 				'DateTextBox',
// 				'datebox',
// 				array(
// 						'value' => '2008-07-05',
// 						'label' => 'DateTextBox',
// 						'required'  => true,
// 				)
// 		)
// 		->addElement(
// 				'TimeTextBox',
// 				'timebox',
// 				array(
// 						'label' => 'TimeTextBox',
// 						'required'  => true,
// 				)
// 		)
// 		->addElement(
// 				'CurrencyTextBox',
// 				'currencybox',
// 				array(
// 						'label' => 'CurrencyTextBox',
// 						'required'  => true,
// 						// 'currency' => 'USD',
// 						'invalidMessage' => 'Invalid amount. ' .
// 						'Include dollar sign, commas, ' .
// 						'and cents.',
// 						// 'fractional' => true,
// 						// 'symbol' => 'USD',
// 						// 'type' => 'currency',
// 				)
// 		)
// 		->addElement(
// 				'NumberTextBox',
// 				'numberbox',
// 				array(
// 						'label' => 'NumberTextBox',
// 						'required'  => true,
// 						'invalidMessage' => 'Invalid elevation.',
// 						'constraints' => array(
// 								'min' => -20000,
// 								'max' => 20000,
// 								'places' => 0,
// 						)
// 				)
// 		)
// 		->addElement(
// 				'ValidationTextBox',
// 				'validationbox',
// 				array(
// 						'label' => 'ValidationTextBox',
// 						'required'  => true,
// 						'regExp' => '[\w]+',
// 						'invalidMessage' => 'Invalid non-space text.',
// 				)
// 		)
// 		->addElement(
// 				'Textarea',
// 				'textarea',
// 				array(
// 						'label'    => 'Textarea',
// 						'required' => true,
// 						'style'    => 'width: 200px;',
// 				)
// 		);
		
// 	}


}

