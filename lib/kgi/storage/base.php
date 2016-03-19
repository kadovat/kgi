<?php
class Kgi_Storage_Base extends Kgi_Base{

	const DRIVER_MYSQL = 'mysql';

	protected $_connectPool = array();

	protected $_driver;

	protected $_servers;

	public function __construct(){
		parent::__construct();
		
	}

	public function setServers($servers){
		foreach($servers as $serverId => $server){
			if( !isset($server['host']) 
					|| !isset($server['port']) ){
				throw new \Exception("bad server config");
			}
		}
		$this->_servers = $servers;
		return true;
	}
}
