<?php
class CtrlContent{
	static $instance;
	public static function getInstance(){
		$key = 'contentController';
		if(isset($instance[$key])){
			return $instance[$key];
		}
		$instance[$key] = new self();
		return $instance[$key];
	}


	public function getContent($id){
		$content = ModelContent::get($id, true);	
	    return $content;
	}
}
