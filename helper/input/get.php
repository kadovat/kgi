<?php
class Kgi_Helper_Input_Get extends Kgi_Helper_Input_Abs{
	
	public function __construct(){
		$this->_content = $_GET;
		
	}
	
	// protected function _validate($regex){
	// 	//default do nothing.
	// }
}