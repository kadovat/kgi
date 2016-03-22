<?php
use Kgi\Boot as KgiBoot;
use Kgi\Exception as KgiException;
class Bootstrap{
    static public function boot(){
        try{
            KgiBoot::$defaultIndex = true;
            $boot = new KgiBoot();
            $boot->run();
        }catch(KgiException $e){
            echo $e->getMessage();
        }
    }
}
