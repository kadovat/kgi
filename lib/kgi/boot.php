<?php
class Kgi_Boot{
    public static $defaultIndex;
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
			$className = 'CtrlIndex';
            $action = '';
		}else{
			$className = 'Ctrl' . str_replace(' ', '', ucwords(str_replace('/', ' ', $uri)));
			$action = end($pathArray) ;
		}
        if(!file_exists(APP_ROOT . "/ctrl/{$uri}.php"))
            throw new Kgi_Exception("interface file missing,[{$uri}{$suffix}]");
 
        
        $ctrl = new $className();
        $ctrl->setName(str_replace("/", ".", $uri));
        $ctrl->run($action);
    }
}
