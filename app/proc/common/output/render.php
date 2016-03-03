<?php
class ProcCommonOutputRender extends Kgi_Processor{
    public function run(){
		if($this->getOutputFormat() == 'json'){
            $output = array_merge(array('code' => $this->_app->code), $this->_app->doc->toArray());
            echo json_encode($output);
		}else{
            $this->_renderTpl();
        }
    }
    
    protected function _renderTpl(){
    	foreach($this->_app->doc->data as $var => $value){
    		$$var = $value;
    	}
    	$tpl = array('path' => $this->getTpl());
    	require  APP_ROOT.'/tpl/include/body.php';    	
    }
}
