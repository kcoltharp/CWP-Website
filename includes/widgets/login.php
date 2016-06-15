<?php
if((isset($_POST['password'])) && (isset($_POST['username']))){
	?>
	<pre>
		<?php
		echo "Post data: <br />";
		print_r($_POST) . "br />";
		?>
	</pre>
	<?php
	$db = new MyDB(DSN, USER, PASSWORD);
	$db->logIn($_POST['username'], $_POST['password']);
} else{
	?>
	<pre>
		<?php
		echo "Post data: <br />";
		print_r($_POST) . "br />";
		?>
	</pre>
	<div class="widget">
		<h2>Administrative Log In</h2>
		<div class="inner">
			<form id="loginForm" action="" method="post">
				<ul id="login">
					<li>
						Username:<br>
						<input id="name" type="text" name="username">
					</li>
					<li>
						Password:<br>
						<input id="password" type="password" name="password">
					</li>
					<li>
						<input id="logginButton" type="submit" value="Log in">
					</li>
					<!---
					<li>
						Forgotten your <a href="recover.php?mode=username">username</a> or <a href="recover.php?mode=password">password</a>?
					</li>
					-->
				</ul>
			</form>
		</div>
	</div>
	<?php
}