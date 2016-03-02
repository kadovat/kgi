<?php
define('WEB_ROOT',dirname(__FILE__).'/..');
define('LIB_ROOT', WEB_ROOT.'/lib');
define('APP_ROOT', WEB_ROOT.'/app');
define('PLUGIN_ROOT', WEB_ROOT.'/plugin');
define('KAD_TIME_NOW',$_SERVER['REQUEST_TIME']);
define('KAD_PLUGIN_ON',true);

class Define{
	const KEY_SIDEBAR = 'sidebar';
	const KEY_PLUGIN = 'plugin';
	const PLUGIN_ACTION_PAGEVIEW_AFTER = 0x001;
	const KEY_IMAGE_PNG = 0x002;
	const SALT = "x^=1[@";
	const MCRYPT_CIPHER = MCRYPT_DES;
	const MCRYPT_MODE = MCRYPT_MODE_ECB;
}
