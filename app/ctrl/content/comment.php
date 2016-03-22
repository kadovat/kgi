<?php
namespace  App\Ctrl\Content;
use Kgi\Controller as KgiController;
use App\Model\Comment as ModelComment; 

class Comment extends KgiController{
    public function detail(){
    	$id = $this->getInput('id','/[0-9a-f][0-9a-f]*/', 1);

		$commentInstance = ModelComment::getInstance($id);
		$this->assign('comment',$commentInstance->getComment());
		$this->code(0);		
    }

}
