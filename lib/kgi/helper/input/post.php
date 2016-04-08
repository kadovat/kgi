<?php
namespace Kgi\Helper\Input;
class Post extends Abs{
    
    public function __construct(){
        $this->_content = $_POST;
    }
    
    // public function _validate($regex){
    //     //default do nothing.
    // }
}
