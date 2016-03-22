<?php
namespace Kgi\Helper\Input;
abstract class Abs{
	protected $_content = array();
	const TYPE_FILT_VALIDATE = 0x01;
	const TYPE_FILT_FILT_SPECIALCHARS = 0x02;
	abstract public function __construct();
	
	protected function _validate($string, $regex){
		preg_match($regex, $string, $matches);
		return isset($matches[0])?$matches[0]:false;
	}

	protected function _filtSpecialChars($string, $regex){
		$string = htmlspecialchars($string);
		return $string; 
	}
	
	public function get($key, $regex = null, $default = null, $filtType = self::TYPE_FILT_VALIDATE){
		if( !isset($this->_content[$key]) )
			return isset($default) ? $default : null;
		if( isset($regex)){
			if($filtType == self::TYPE_FILT_VALIDATE){
				if(! ($result = $this->_validate($this->_content[$key], $regex) ) )
					return $default;
				return $result;
			}else{
				$result = $this->_filtSpecialChars($this->_content[$key], $regex);
				return $result;
			}
		}
			
		return $this->_content[$key];
	}
	
	
	
	
}
