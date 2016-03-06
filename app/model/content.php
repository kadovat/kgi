<?php 
class ModelContent extends Kgi_Model{

	static protected $_instance;

	static public function getInstance($id){
		!isset(self::$_instance[$id]) && self::$_instance[$id] =self::get($id);
		return self::$_instance[$id];
	}

	protected function _init($id){
			$this->_data['id'] = $id;
			$this->_data['content'] = '';
			$this->_data['title'] = '';
			$this->_data['cTime'] = '';
	} 

	public function setId($value){
		$this->_data['id'] = $value;
	}

	public function getId(){
		return $this->_data['id'];
	}

	public function setContent($value){
		$this->_data['content'] = $value;
	}

	public function getContent(){
		return $this->_data['content'];
	}

	public function setTitle($value){
		$this->_data['title'] = $value;
	}

	public function getTitle(){
		return $this->_data['title'];
	}

	public function setCTime($value){
		$this->_data['cTime'] = $value;
	}

	public function getCTime(){
		return $this->_data['cTime'];
	}

	public function save(){
		self::set($this);
	}

	static public function get($id, $returnNull = false){
		$storage =  new ModelStorageContent();
		$model = $storage->get($id, $returnNull);
		return $model;
	}

	static public function set($model){
		$storage = new ModelStorageContent();
		return $storage->set($model);
	}

	static public function del($id){
		$storage =  new ModelStorageContent();
		return $storage->del($id);
	}

	static public function batchIds($offset, $num){
		$storage =  new ModelStorageContent();
		return $storage->batchIds($offset, $num);
	}
}
