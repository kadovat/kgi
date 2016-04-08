<?php
spl_autoload_register("Loader_Lib");
spl_autoload_register("Loader_App");

function Loader_Lib($class){    
    $file = LIB_ROOT . '/' . strtolower(str_replace('\\','/',$class)).".php";    
    if(is_file($file)){
        require_once($file);
    }
}

function Loader_App($class){
    $file = WEB_ROOT . '/' . strtolower(str_replace('\\','/',$class)).".php"; 
    if(is_file($file)){
        require_once($file);
    }
}
