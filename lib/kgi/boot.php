<?php
namespace Kgi;
use Kgi\Exception as KgiException;
class Boot{
    public static $defaultIndex = 'index';
    public function run(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri);
        $uri = $uri[0];
		$suffix = empty(CUSTOM_SUFFIX) ? '.php' : '.' . CUSTOM_SUFFIX;
        if(substr($uri, - strlen($suffix)) != $suffix && substr($uri, -1) != '/'){
            throw new Kgi_Exception('bad url.');
        }

       	$uri = str_replace($suffix, '', $uri); 
       	$uri = substr($uri, 1); 

		$pathArray = explode('/', $uri);
        if(self::$defaultIndex && empty($pathArray[0])){
			$uri = 'index';
            $action = '';
			$className = 'App\\Ctrl\\Index';
		}else{
			$action = array_pop($pathArray) ;
			$className = 'App\\Ctrl\\' . str_replace(' ', '\\', ucwords(implode(' ', $pathArray)));
		}
        if(!file_exists(WEB_ROOT . '/' . str_replace('\\', '/', $className) . ".php" )){
            throw new KgiException("interface file missing,[{$uri}{$suffix}]");
		}
 
        
        $ctrl = new $className();
        $ctrl->setName(str_replace("/", ".", $uri));
        $ctrl->run($action);
    }
}
