<?php 
namespace App\Model;
use App\Model\Storage\Comment as StorageComment;
class Comment extends \Kgi\Model{

    static protected $_instance;

    static public function getInstance($id){
        !isset(self::$_instance[$id]) && self::$_instance[$id] =self::get($id);
        return self::$_instance[$id];
    }

    protected function _init($id){
            $this->_data['id'] = $id;
            $this->_data['content'] = '';
            $this->_data['author'] = '';
            $this->_data['cTime'] = '';
    } 

    public function setId($value){
        $this->_data['id'] = $value;
    }

    public function getId(){
        return $this->_data['id'];
    }

    public function setComment($value){
        $this->_data['content'] = $value;
    }

    public function getComment(){
        return $this->_data['content'];
    }

    public function setAuthor($value){
        $this->_data['author'] = $value;
    }

    public function getAuthor(){
        return $this->_data['author'];
    }

    public function setCTime($value){
        $this->_data['cTime'] = $value;
    }

    public function getCTime(){
        return $this->_data['cTime'];
    }

    public function save(){
        self::set($this);
    }

    static public function get($id, $returnNull = false){
        $storage =  new StorageComment();
        $model = $storage->get($id, $returnNull);
        return $model;
    }

    static public function set($model){
        $storage = new StorageComment();
        return $storage->set($model);
    }

    static public function del($id){
        $storage =  new StorageComment();
        return $storage->del($id);
    }

    static public function batchIds($offset, $num){
        $storage =  new StorageComment();
        return $storage->batchIds($offset, $num);
    }
}
