<?php

class UnitController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function unitaddAction()
    {
        // action body
    	$form    = new Application_Form_Unitadd();
    	$this->view->form = $form;
    	
    }

    public function unitdelAction()
    {
        // action body
    }

    public function unitupdAction()
    {
        // action body
    }

    public function unitsearchAction()
    {
        // action body
        
    	$form    = new Application_Form_Unitsearch();
    	$this->view->form = $form;
    }


}















