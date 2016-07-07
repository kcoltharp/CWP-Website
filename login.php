<?php
require_once 'init.php';

if((isset($_POST['user'])) && (isset($_POST['pass']))){
	$user = $_POST['user'];
	$pwd = $_POST['pass'];
	echo "<br />" . $user . "<br />" . $pwd;
	if($db->logIn($user, $pwd)){
		setcookie("LOGGED_IN", TRUE);
	} else{
		setcookie("LOGGED_IN", FALSE);
	}
} else{
	?>

	<form id="loginForm" action="" method="post">
		<label for="user">Username: </label>
		<input id="name" type="text" name="user"><br />
		<label for="pass">Password:&nbsp;</label>
		<input id="password" type="password" name="pass"><br />
		<input id="logginButton" type="submit" value="Log in">
		<!--- Forgotten your <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password</a>? -->
	</form>
	<br />
	<?php
}
require_once 'includes/overall/footer.php';
