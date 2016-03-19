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
		try{
			foreach($config as $key => $value){
				$func = 'set' . $key;
				$this->$func($value);
			}
		}catch(\Exception $e){
			var_dump($e->getMessage());
			die;
		}
	}

	protected function _checkConfig($config){
		return true;
	}
}
