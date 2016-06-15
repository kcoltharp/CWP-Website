<?php

require_once 'init.php';

$db = new MyDB(DSN, USER, PASSWORD);

if(($db->logged_in() === FALSE) && (user_active($user_data['userName']) === TRUE)){
	$db->logIn($_POST['username'], $_POST['password']);
}

