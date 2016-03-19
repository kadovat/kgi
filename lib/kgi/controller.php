<?php
abstract class Kgi_Controller{
	protected $_app = null;
	
	public function __construct(Kgi_App $app){
		$this->_app = $app;
	}

	public function getInput($key,$regex = null, $default = null, $filtType = Kgi_Helper_Input_Abs::TYPE_FILT_VALIDATE){
		return $this->_app->input->get($key, $regex, $default, $filtType);
	}

	public function getCookie($key, $regex = null, $default = null){
		if( !isset($_COOKIE[$key]) )
			return isset($default) ? $default : null;
		if( isset($regex)){
			preg_match($regex, $_COOKIE[$key], $matches);
			if(! isset($matches[0]))
				return $default;
			return $matches[0];			
		}
			
		return $_COOKIE[$key];
	}

	protected function isPost() {
		return strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0;
	}
	
	public function assign($varName,$value){		
		$this->_app->doc->data[$varName] = $value;
	}

	public function setSwap($key, $data){
		$this->_app->doc->swapData[$key] = $data;
	}

	public function getSwap($key){
		return isset($this->_app->doc->swapData[$key]) ? $this->_app->doc->swapData[$key] : null;
	}
	
	public function getTpl(){
		return APP_ROOT.'/tpl'.$this->_app->tpl;
	}

	public function setTpl($tpl){
		return $this->_app->tpl = $tpl;
	}

	public function getOutputFormat(){
		return $this->_app->getOutputFormat();
	}

	public function setOutputFormat($format){
		return $this->_app->setOutputFormat($format);
	}

	public function code($code){
		return $this->_app->code = $code;
	}

	public abstract function run();
}
