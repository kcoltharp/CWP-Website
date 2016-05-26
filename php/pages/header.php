<?php
require('php/pages/head.php');
?>
<body>
<?php
require('php/functions/XIP.php');
require('php/functions/general.php');
require('php/functions/geoPlugin.php');
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
	$ip .=  " / " . $Geo_IP . " - " . $City . $State;
	if(!iplog($logfile, $ip)){
		die("IP Log error, make sure you have created the log directory '" . dirname($logfile) . "' or copy the files '$logfile' and '$logfile.lck', make sure you have set the right permissions");
	}
}
?>
	<div class='wrapper'>
		<div class='sidebar'>
			<?php
			require('navigation.php');
			?>
			<header>
				Carolina Firearms and Training
			</header>
			<br /><br />
			<?php
//print $Geo_IP . " - " . $City . ", " . $State;
?>