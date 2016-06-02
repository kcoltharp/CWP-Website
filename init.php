<?php

require_once 'php/functions/MyDB.php';
require_once 'php/functions/geoPlugin.php';
require_once 'php/functions/XIP.php';
require_once 'php/functions/general.php';
require_once 'mySQL_Results.php';

//192.186.233.1 cwp
define("dsn", "mysql:host=localhost;dbname=sccwp;charset=utf8");
define("user", "kenny");
define("pwd", "kc226975");

$geoplugin = new geoPlugin();
$geoplugin->locate();

$Geo_IP = "Geolocation results for {$geoplugin->ip}: ";
$City = " {$geoplugin->city}";
$State = ", {$geoplugin->region}";

$XIP = new XIP();
$blacklist = implode('', file("log/blacklist.txt"));
$ip = $XIP->IP['client'];
//echo $XIP->IP['all'];
$logfile = "log/iplog.txt";
if($XIP->CheckNet($blacklist, $ip)){
	$ip = $XIP->IP['proxy'] . " (" . $XIP->IP['client'] . ")";
	$ip .= " / " . $Geo_IP . " - " . $City . $State;
	if(!iplog($logfile, $ip)){
		die("IP Log error, make sure you have created the log directory '" .
			dirname($logfile) .
			"' or copy the files '$logfile' and '$logfile.lck', make sure you have set the right permissions");
	}
}

if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email', 'password_recover', 'type', 'allow_email', 'profile');
	if(user_active($user_data['username']) === false){
		session_destroy();
		echo '<META http-equiv="refresh" content="4;URL=index.php">';
		exit();
	}
}

$errors = array();
require_once 'includes/overall/header.php';
