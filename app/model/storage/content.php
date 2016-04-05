<?php
namespace App\Model\Storage;
use App\Model\Content as ModelContent;
class Content extends \Kgi\Storage\Mysql{
	public function __construct(){
		parent::__construct();
		$this->_tbName = 'content';
	}


	public function set(ModelContent $model){
		$Stmt = $this->getObject()->prepare("REPLACE INTO {$this->_tbName} set 
										title = :title, 
										content = :content, 
										cTime = :cTime, 
										id = :id");
	    $Stmt->bindParam(':id', $model->getId());
	    $Stmt->bindParam(':title', $model->getTitle());
	    $Stmt->bindParam(':content', $model->getContent());
	    $Stmt->bindParam(':cTime', $model->getCTime());	   
	    $Stmt->execute();
	}

	public function get($id, $returnNull = false){
		$Stmt = $this->getObject()->prepare("SELECT * FROM {$this->_tbName} where id = :id");
	    $Stmt->bindParam(':id', $id);
	    $Stmt->execute();
	    $res = $Stmt->fetch();
	    if(!isset($res['id']) && $returnNull)
	    	return null;
	    $model = new ModelContent($id);
	    isset($res['id']) && $model->setId($res['id']);
	    isset($res['content']) && $model->setContent($res['content']);
	    isset($res['title']) && $model->setTitle($res['title']);
	    isset($res['cTime']) && $model->setCTime($res['cTime']);
	    return $model;
	}

	public function batchIds($offset, $num, $orderBy='cTime',: $order = 'DESC'){
		$Stmt = $this->getObject()->prepare("SELECT id FROM {$this->_tbName} ORDER BY cTime DESC LIMIT {$offset}, {$num}");
	    $Stmt->execute();
	    $ids = array();
	    while($res = $Stmt->fetch()){
	    	$ids[] = $res['id'];
	    }
	    return $ids;
	}

	public function del($id){

	}
}
