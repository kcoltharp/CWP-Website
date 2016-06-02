<?php

function logged_in(){
	return (isset($_SESSION['user_id'])) ? true : false;
}

function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: cwp@sc-cwp.kennys-spot.org');
}

function logged_in_redirect(){
	if(logged_in() === true){
		echo '<META http-equiv="refresh" content="4;URL=adminPages.php">';
		exit();
	}
}

function protect_page(){
	if(logged_in() === false){
		echo '<META http-equiv="refresh" content="4;URL=adminPages.php">';
		exit();
	}
}

function admin_protect(){
	global $user_data;
	if(has_access($user_data['user_id'], 1) === false){
		echo '<META http-equiv="refresh" content="4;URL=adminPages.php">';
		exit();
	}
}

function array_sanitize(&$item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors){
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
