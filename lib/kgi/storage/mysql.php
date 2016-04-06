<?php
namespace Kgi\Storage;
class Mysql extends Base{

	protected $_shardingKey;

	protected $_shardingType;

	protected $_shardingPolicy;

	protected $_tbName;

	public function __construct(){
		parent::__construct();
		$this->_driver = parent::DRIVER_MYSQL; 
	}

	protected function getDsn($serverId){
		return "{$this->_driver}:host={$this->_servers[$serverId]['host']};port={$this->_servers[$serverId]['port']};dbname={$this->_servers[$serverId]['dbName']}";
	}

	public function connect($serverId){
		if(!isset($this->_connectPool[$serverId])){
			try{
				$dsn = $this->getDsn($serverId);
				$this->_connectPool[$serverId] = new \PDO($dsn, $this->_servers[$serverId]['user'], $this->_servers[$serverId]['pw']); 
			}catch(\Exception $e){
				//TODO: throw exception
			}
		}
		return  $this->_connectPool[$serverId];
	}

	protected function getObject(){
		$serverId = 0;
		if($this->_shardingKey){
			//sharding
			switch($this->_shardingType){
				case 'hash_last_x':
					$serverId = substr($this->_shardingKey, $this->_shardingPolicy);
			}
		}

		return $this->connect($serverId);
	}

	public function select($columns = '*'){
		//TODO
	}

	public function fetch(){
		return $this->query($sql)->fetch();
	}

	public function query($sql, $params = array()){
		//TODO
	}

	public function update($table, array $data, array $conditions){
		//TODO
	}

	public function insert($table, array $data){
	}

	public function count($table, $conditions = false){
	}

	public function lastInsertId(){
	}

	protected function checkKeys($table, $keys){
		//TODO
	}
}
