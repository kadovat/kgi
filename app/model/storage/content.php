<?php
class ModelStorageContent extends Kgi_Storage_Mysql{

	public function __construct(){
		try{
			$this->_object = new PDO("{$this->_driver}:host={$this->_host};dbname={$this->_dbName}", $this->_user, $this->_pw); 
		}catch(\Exception $e){
			$this->_object = null;
		}

	}

	public function set(ModelContent $model){
		$Stmt = $this->_object->prepare("REPLACE INTO {$this->_tbName} set 
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
		$Stmt = $this->_object->prepare("SELECT * FROM {$this->_tbName} where id = :id");
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

	public function batchIds($offset, $num){
		$Stmt = $this->_object->prepare("SELECT id FROM {$this->_tbName} ORDER BY cTime DESC LIMIT {$offset}, {$num}");
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
