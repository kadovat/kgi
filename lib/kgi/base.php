<?php
class Kgi_Base{
	public function __construct(){
		$configFile = APP_ROOT . '/config/' . get_class($this) . ".config.php";
		$this->setConfig($configFile);

	}

	public function setConfig($config){
	
		if(is_string($config) && file_exists($config)){
			$config = (array) require $config;
		}

		if( ! $this->_checkConfig($config)){
			return ;
			//TODO: throw exception
		}
		foreach($config as $key => $value){
			$func = 'set' . $key;
			$this->$func($value);
		}
	}

	protected function _checkConfig($config){
		return true;
	}
}
