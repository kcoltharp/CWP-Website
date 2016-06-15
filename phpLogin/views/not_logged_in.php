<?php require_once '_header.php'; ?>
<form id="notLoggedIn" method="post" action="index.php" name="loginform">
	<label for="user_name"><?php echo WORDING_USERNAME; ?></label>
	<input id="user_name" type="text" name="user_name" required />

	<label for="user_password"><?php echo WORDING_PASSWORD; ?></label>
	<input id="user_password" type="password" name="user_password" autocomplete="off" required />
	<input type="checkbox" id="user_rememberme" name="user_rememberme" value="1" />
	<label for="user_rememberme"><?php echo WORDING_REMEMBER_ME; ?></label>
	<input type="submit" name="login" value="<?php echo WORDING_LOGIN; ?>" />
</form>
</section>

<a class="small" href="register.php"><?php echo "Register"; ?></a>
<a class="small" href="password_reset.php"><?php echo "Forgot Password"; ?></a>

