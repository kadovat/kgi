<?php
spl_autoload_register("Loader_Lib");
spl_autoload_register("Loader_App");

function Loader_Lib($class){	
    $file = LIB_ROOT.'/'.strtolower(preg_replace('/_/','/',$class)).".php";    
	var_dump($file);
    if(is_file($file)){
        require_once($file);
    }
}

function Loader_App($class){
    $file = APP_ROOT.strtolower(preg_replace('/[A-Z]/','/\\0',$class)).".php"; 
    if(is_file($file)){
        require_once($file);
    }
}
