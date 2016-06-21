<aside>
	<div class="clock">
		<div id="Date"></div>
		<ul>
			<li id="hours"></li>
			<li id="point">:</li>
			<li id="min"></li>
			<li id="point">:</li>
			<li id="sec"></li>
		</ul>
	</div>
	<br /><br />
	<span style='display:block !important; width: 250px; text-align: center; font-family: sans-serif; font-size: 12px;'>
		<a href='http://www.wunderground.com/cgi-bin/findweather/getForecast?query=Georgetown, SC' title='Georgetown, SC Weather Forecast'>
			<img src='http://weathersticker.wunderground.com/weathersticker/sunandmoon/language/english/US/SC/Georgetown.gif' alt='Find more about Weather in Georgetown, SC' />
		</a>
	</span>
	<br /><br />
	<?php
	if($isLoggedIn === TRUE){
		require_once 'includes/widgets/loggedin.php';
	} else{
		require_once 'includes/widgets/login.php';
	}
	?>
</aside>