<?php
class Kgi_Storage_Base extends Kgi_Base{

	const DRIVER_MYSQL = 'mysql';

	const CONFIG_SERVERS = 'servers';

	protected $_connectPool = array();

	protected $_driver;

	protected $_servers;

	public function __construct(){
		parent::__construct();
		
	}

	public function _checkConfig($config){
		if(!isset($config[self::CONFIG_SERVERS])){
			return false;
		}
		foreach( $config[self::CONFIG_SERVERS] 
				as $serverId => $server){
			if( !isset($server['host']) 
					|| !isset($server['port']) ){
				return false;
			}
		}
		return true;
	}

	public function setServers($servers){
		$this->_servers = $servers;
	}
}
