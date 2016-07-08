<aside>

	<br />
	<div style='margin: auto; display:block !important; width: 250px; text-align: center; font-family: sans-serif; font-size: 12px;'>
		<a href='http://www.wunderground.com/cgi-bin/findweather/getForecast?query=Georgetown, SC' title='Georgetown, SC Weather Forecast'>
			<img src='http://weathersticker.wunderground.com/weathersticker/sunandmoon/language/english/US/SC/Georgetown.gif' alt='Find more about Weather in Georgetown, SC' />
		</a>
	</div>
	<?php
	if((!isset($_COOKIE['LOGGED_IN'])) || (empty($_COOKIE))){
		if((isset($_POST['user'])) && (isset($_POST['pass']))){
			$db->logIn($_POST['user'], $_POST['pass']);
		} else{
			require_once 'includes/widgets/login.php';
		}
	} elseif(($_COOKIE["LOGGED_IN"] === TRUE) || (stristr($_COOKIE["LOGGED_IN"], "TRUE") != FALSE)){
		require_once 'includes/widgets/loggedin.php';
	} else{
		require_once 'includes/widgets/login.php';
	}
	?>
</aside>