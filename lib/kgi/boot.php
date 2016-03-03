<?php
class Kgi_Boot{
    public static $defaultIndex;
    public function run(){
        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('?', $uri);
        $url = $uri[0];
		$suffix = empty(CUSTOM_SUFFIX) ? '.php' : '.' . CUSTOM_SUFFIX;
        if(substr($url, -5) != $suffix && substr($url, -1) != '/'){
            throw new Kgi_Exception("bad url.");
        }

       	$url = str_replace($suffix, "", $url); 

        if(self::$defaultIndex && (!$url|| $url == '/'))
            $url = "/index";
        if(!file_exists(APP_ROOT."/router{$url}.php"))
            throw new Kgi_Exception("interface file missing,[{$url}{$suffix}]");
 
        $className = str_replace(" ", "", ucwords(str_replace("/", " ", $url)));
        $className = "Router$className";

        $app = new $className();
        $app->name = str_replace("/", ".", $url);
        $app->run();
    }
}
