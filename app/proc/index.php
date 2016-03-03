<?php
class ProcIndex extends Kgi_Processor{
    public function run(){
    	$id = $this->getInput('id','/[1-9][0-9]*/', 1);

		$contentInstance = CtrlContent::getInstance();
		$content = $contentInstance->getContent($id);
		$this->assign('content',$content);
		$this->assign('curPage','index');
		$this->code(0);		
    }

}
