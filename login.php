<?php
require_once 'init.php';
if((((isset($_POST['username'])) && (isset($_POST['password']))))){
	echo $_POST['username'] . "<br />";
	echo $_POST['password'] . "<br />";
	$db = new MyDB(DSN, USER, PASSWORD);
	$isLoggedIn = $db->logIn($_POST['username'], $_POST['password']);
	if($isLoggedIn === TRUE){
		header("index.php");
		//echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/index.php">';
	} else{
		$isLoggedIn = FALSE;
		header("login.php");
		//echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/index.php">';
	}
}
?>
<br /><br />
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<div class="form-group">
		<label for="username">Username: </label>
		<input type="text" class="form-control" id="username" placeholder="Username">
	</div>
	<br />
	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" id="password" placeholder="Password">
	</div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>
<?php require_once 'includes/overall/footer.php'; ?>
