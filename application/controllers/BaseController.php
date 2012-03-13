
<?php
class BaseController extends Zend_Controller_Action
{
    /**
     * 根据当前Uri来确定sitmap,如果没有在配置文件中找到，则进行截取，知道找到
     */
    private function inituri4breadcrumb(){
    	$uri = $this->_request->getPathInfo();
    	$activeNav = $this->view->navigation()->findByUri($uri);
    	
    	if($activeNav==null){
    		do{
    			$endindex=strrpos($uri,"/",0);
    			if($endindex!=false)
    			{
    				$uri=substr($uri,0,$endindex);
    			}
    			else
    			{
    				$uri="/";
    			}
    			$activeNav = $this->view->navigation()->findByUri($uri);
    		}
    		while($activeNav==null);
    	}
    	$activeNav-> active = true;
    	$activeNav->setClass("active");
    }
	public function init()
    {
    	$this->inituri4breadcrumb();
    }
    

    public function indexAction()
    {
        // action body
    }


}

