<?php
/**
 *  notice:deprecated
 *
 */
class Kgi_Context implements ArrayAccess{
    const CODE_NORMAL = 0x00000000;
    const CODE_EMERGENCY_BREAK = 0xFFFFFFFF;

    public $code = 0;
    public $data = array();

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
        else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset){
        unset($this->data[$offset]);
    }
} 
