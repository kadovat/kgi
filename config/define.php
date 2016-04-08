<?php
namespace Config;
define('CONFIG_ROOT',dirname(__FILE__));
define('WEB_ROOT',dirname(__FILE__).'/..');
define('LIB_ROOT', WEB_ROOT.'/lib');
define('APP_ROOT', WEB_ROOT.'/app');
define('PLUGIN_ROOT', WEB_ROOT.'/plugin');
define('KAD_TIME_NOW',$_SERVER['REQUEST_TIME']);
define('KAD_PLUGIN_ON',true);
define('CUSTOM_SUFFIX','nano');
class Define{
    const TEST = 'test';
}
