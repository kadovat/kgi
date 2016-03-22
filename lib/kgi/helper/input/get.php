<?php
namespace Kgi\Helper\Input;
class Get extends Abs{
	
	public function __construct(){
		$this->_content = $_GET;
		
	}
	
	// protected function _validate($regex){
	// 	//default do nothing.
	// }
}
