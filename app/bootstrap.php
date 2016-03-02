<?php
class bootStrap{
    static public function boot(){
        try{
            Kgi_Boot::$defaultIndex = true;
            $boot = new Kgi_Boot();
            $boot->run();
        }catch(Kgi_Exception $e){
            echo $e->getMessage();
        }
    }
}
