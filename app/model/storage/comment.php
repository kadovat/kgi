<?php
namespace App\Model\Storage;
use App\Model\Comment as ModelComment;
class Comment extends \Kgi\Storage\Mysql{
	public function __construct(){
		parent::__construct();
		$this->_tbName = 'comment';
	}


	public function set(ModelComment $model){
		$Stmt = $this->getObject()->prepare("REPLACE INTO {$this->_tbName} set 
										author = :author, 
										comment = :comment, 
										cTime = :cTime, 
										id = :id");
	    $Stmt->bindParam(':id', $model->getId());
	    $Stmt->bindParam(':author', $model->getAuthor());
	    $Stmt->bindParam(':comment', $model->getComment());
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
	    $model = new ModelComment($id);
	    isset($res['id']) && $model->setId($res['id']);
	    isset($res['comment']) && $model->setComment($res['comment']);
	    isset($res['author']) && $model->setAuthor($res['author']);
	    isset($res['cTime']) && $model->setCTime($res['cTime']);
	    return $model;
	}

	public function batchIds($offset, $num){
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
