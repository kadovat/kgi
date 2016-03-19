<?php
class RouterIndex extends Kgi_App{
    public function execute(){
		$proc = new CtrlIndex($this);        
		$proc->run();  

	    if($this->code == 0){
	    	$proc = new CtrlCommonOutputRender($this);
	        $proc->run();
	    }
    }
}
