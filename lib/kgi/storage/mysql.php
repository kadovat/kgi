<?php
class Kgi_Storage_Mysql extends Kgi_Storage_Base{
	protected $_driver = 'mysql';

	protected $_user;
	protected $_pw;
	protected $_dbName;	
	protected $_tbName;

	public function __construct($config){
		return parent::__construct($config);
	}
	
	public function __set($key, $value){
		$this->$key = $value;
	}
	
	public function __get($key){
		return $this->$key;
	}
}
