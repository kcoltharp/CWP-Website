<?php
require_once 'init.php';
if(isset($_COOKIE['LOGGED_IN'])){
	if(($_COOKIE["LOGGED_IN"] === TRUE) || (stristr($_COOKIE["LOGGED_IN"], "TRUE") != FALSE)){
		header("Location: index.php");
	}
} else{
	if((isset($_POST['user'])) && (isset($_POST['pass']))){
		$user = $_POST['user'];
		$pwd = $_POST['pass'];
		if($db->logIn($user, $pwd)){
			setcookie("LOGGED_IN", "true", time() + (60 * 60 * 8), "/", "localhost", FALSE, FALSE);
			header("Location: index.php");
		} else{
			unset($_COOKIE);
			header("Location: login.php");
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
}
require_once 'includes/overall/footer.php';
