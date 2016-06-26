<?php

require_once 'php/functions/geoPlugin.php';
require_once 'php/functions/XIP.php';
require_once 'php/functions/class.MyDB.php';

$errors = array();

define('DSN', 'mysql:dbname=sccwp;host=127.0.0.1;charset=utf8', false);
define('USER', 'kenny', false);
define('PASSWORD', 'kc226975', false);

$geoplugin = new geoPlugin();
$geoplugin->locate();

$Geo_IP = "Geolocation results for {$geoplugin->ip}: ";
$City = " {$geoplugin->city}";
$State = ", {$geoplugin->region}";

$XIP = new XIP();
$blacklist = implode('', file("log/blacklist.txt"));
$ip = $XIP->IP['client'];
$logfile = "log/iplog.txt";

if($XIP->CheckNet($blacklist, $ip)){
	$ip = $XIP->IP['proxy'] . " (" . $XIP->IP['client'] . ")";
	$ip .= " / " . $Geo_IP . " - " . $City . $State;
	if(!iplog($logfile, $ip)){
		$errors = "IP Log error, make sure you have created the log "
			. "directory '" . dirname($logfile) . "' or copy the files "
			. "'$logfile' and '$logfile.lck', make sure you have set "
			. "the right permissions";
	}
}
if(!empty($errors)){
	die(output_errors($errors));
}

require_once 'includes/overall/header.php';
?>