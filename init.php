<?php

//$GLOBALS['isLoggedIn'];
if(!isset($GLOBALS['isLoggedIn'])){
	$GLOBALS['isLoggedIn'] = FALSE;
} elseif(!isset($isLoggedIn)){
	$isLoggedIn = FALSE;
}
require_once 'php/functions/geoPlugin.php';
require_once 'php/functions/XIP.php';
require_once 'php/functions/class.MyDB.php';

$errors = array();

define('DSN', 'mysql:dbname=sccwp;host=127.0.0.1;charset=utf8', false);
define('USER', 'kenny', false);
define('PASSWORD', 'kc226975', false);

$db = new MyDB(DSN, USER, PASSWORD);
if(($isLoggedIn === TRUE) || ($db->logged_in() === TRUE)){
	$session_user_id = $_SESSION['user_id'];
	$user_data = $db->user_data($session_user_id);
	var_dump($user_data);
} else{
	echo "HELLO!!!";
	//echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/login.php">';
}

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