<?php
class Kgi_Storage_Base{
	protected $_object;
	protected $_host;
	protected $_port;

	public function __construct($config){
		if(is_string($config) && file_exists($config)){
			$config = (array) require $config;
		}
		foreach($config as $key => $value){
			$this->setConfig($key, $value);
		}
		return $this;
	}

	public function setConfig($key, $value){
		$this->$key = $value;
	}
}
