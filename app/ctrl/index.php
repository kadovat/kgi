<?php
namespace  App\Ctrl;
use Kgi\Controller as KgiController;
use App\Model\Content as ModelContent; 

class Index extends KgiController{
    public function index(){
    	$id = $this->getInput('id','/[0-9a-f][0-9a-f]*/', 1);

		$contentInstance = ModelContent::getInstance($id);
		$this->assign('content',$contentInstance->getContent());
		$this->assign('curPage','index');
		$this->code(0);		
    }

}
