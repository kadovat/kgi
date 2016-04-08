<?php
namespace Kgi;
abstract class Model{
    protected $_data;
    public function __construct($id){ 
        $this->_init($id);
    }

    abstract protected function _init($id);

    public function getAll(){
        return $this->_data;
    }

    abstract public function save();
}
