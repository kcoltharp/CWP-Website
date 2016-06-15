<?php

if(!isset($_COOKIE)){
	echo 'Cookie not set';
	$num = 3600;
	$time = time();
	$lifetime = $time + $num;
	session_name("SESSION kenny\'s-spot");
	session_set_cookie_params($lifetime, "/", "/kennys-spot.org/", FALSE, FALSE);
	$_COOKIE['name'] = "SESSION kenny's-spot";
	$_COOKIE['value'] = "kenny's-spot";
	$_COOKIE['expire'] = $lifetime;
	$_COOKIE['path'] = "/";
	$_COOKIE['domain'] = "/kennys-spot.org/";
	$_COOKIE['secure'] = FALSE;
	$_COOKIE['httponly'] = FALSE;
	session_start();
} else{
	$num = 3600;
	$time = time();
	$lifetime = $time + $num;
	$_COOKIE['name'] = "SESSION kenny's-spot";
	$_COOKIE['value'] = "kenny's-spot";
	$_COOKIE['expire'] = $lifetime;
	$_COOKIE['path'] = "/";
	$_COOKIE['domain'] = "/kennys-spot.org/";
	$_COOKIE['secure'] = FALSE;
	$_COOKIE['httponly'] = FALSE;
	echo "<pre>";
	var_dump($_COOKIE);
	echo "</pre>";
}

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
$db = new MyDB(DSN, USER, PASSWORD);
if($db->logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'userName', 'passWord', 'fname', 'lname', 'email', 'admin');
	if(user_active($user_data['userName']) === false){
		session_destroy();
		$errors = "This username " . $user_data['userName'] . " is not an active account.<br />"
			. " Please email the administrator to reactivate your account.<br />"
			. "<a href='mailto=cwp@sc-cwp.kennys-spot.org?Subject=Account Reactivation'>Reactivate Your Account</a>";
	}
}

if(!empty($errors)){
	die(output_errors($errors));
}


require_once 'includes/overall/header.php';
?>