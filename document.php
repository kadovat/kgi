<?php
class Kgi_Document implements ArrayAccess{
    // public $ret = 0; //deprecated
    public $data = array();
    public $swapData = array();

    public function offsetExists($offset){
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset){
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function offsetSet($offset, $value){
        if (is_null($offset)) {
            $this->data[] = $value;
        }
        else{
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset){
        unset($this->data[$offset]);
    }

    public function toArray(){
        return $this->data;
    }
}
