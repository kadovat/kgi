<?php
class ProcIndex extends Kgi_Processor{
    public function run(){
    	$id = $this->getInput('id','/[0-9a-f][0-9a-f]*/', 1);

		$contentInstance = CtrlContent::getInstance();
		$content = $contentInstance->getContent($id);
		$this->assign('content',$content->getContent());
		$this->assign('curPage','index');
		$this->code(0);		
    }

}
