<?php
class RouterIndex extends Kgi_App{
    public function execute(){
		$proc = new ProcIndex($this);        
		$proc->run();  

	    if($this->code == 0){
	    	$proc = new ProcCommonOutputRender($this);
	        $proc->run();
	    }
    }
}
