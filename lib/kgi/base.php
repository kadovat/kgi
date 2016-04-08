<?php
namespace Kgi;
class Base{
    public function __construct(){
        $configFile = CONFIG_ROOT . '/' . str_replace('\\', '/', strtolower(get_class($this)) ) . ".config.php";
        $this->setConfig($configFile);

    }

    public function setConfig($config){
        if(is_string($config) && file_exists($config)){
            $config = (array) require $config;
        }
        if(empty($config)){
            //TODO: throw exception
        }
        try{
            foreach($config as $key => $value){
                $func = 'set' . $key;
                $this->$func($value);
            }
        }catch(\Exception $e){
            var_dump($e->getMessage());
            die;
        }
    }
}
