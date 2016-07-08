<?php

require_once 'php/functions/class.MyDB.php';
define('DSN', 'mysql:dbname=sccwp;host=127.0.0.1;charset=utf8', false);
define('USER', 'kenny', false);
define('PASSWORD', 'kc226975', false);

$db = new MyDB(DSN, USER, PASSWORD);
if(isset($_REQUEST['q']) && !empty($_REQUEST['q'])){
	$q = strval($_GET['q']);
	$sql = strval($_REQUEST['q']);
	$stmt = $db->prepare($q);
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	echo "<pre>";
	foreach($row[0] as $key => $value){
		echo $key . ": " . $value . "<br />";
	}
	foreach($row[1] as $key => $value){
		echo $key . ": " . $value . "<br />";
	}
	echo "</pre>";
} else{
	echo "ERROR: There was no data in the POST, " . $_POST['textbox'];
}
