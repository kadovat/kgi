<?php
class Kgi_Helper_Factory{	
	const INPUT_GET = 0x0001;
	const INPUT_POST = 0x0002;
	const INPUT_POST_IN_AMF = 0x0003; 
	const INPUT_CONSOLE = 0x0004;
	const OUTPUT_JSON = 0x0010;
	const OUTPUT_HTML = 0x0011;
	
	static function create($type){	
		switch ($type){
			case self::INPUT_GET:
				return new Kgi_Helper_Input_Get();
			case self::INPUT_POST:
				return new Kgi_Helper_Input_Post();
			case self::INPUT_CONSOLE:
				return new Kgi_Helper_Input_Console();
		}
	}
}