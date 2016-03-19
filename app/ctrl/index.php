<?php
class CtrlIndex extends Kgi_Controller{
    public function index(){
    	$id = $this->getInput('id','/[0-9a-f][0-9a-f]*/', 1);

		$contentInstance = ModelContent::getInstance($id);
		$this->assign('content',$contentInstance->getContent());
		$this->assign('curPage','index');
		$this->code(0);		
    }

}
