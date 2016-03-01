<?php
class Kgi_Helper_Input_Post extends Kgi_Helper_Input_Abs{
	
	public function __construct(){
		$this->_content = $_POST;
	}
	
	// public function _validate($regex){
	// 	//default do nothing.
	// }
}