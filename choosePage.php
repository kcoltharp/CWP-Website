<?php

$page = intval($_GET['q']);
/*
 * Choose the page to display
 */
switch($page){
	case 1:
		echo "<div style='margin: auto; display:block !important; width: 250px; text-align: center; font-family: sans-serif; font-size: 12px;'>
			<a href='http://www.wunderground.com/cgi-bin/findweather/getForecast?query=Georgetown, SC' title='Georgetown, SC Weather Forecast'>
			<img src='http://weathersticker.wunderground.com/weathersticker/sunandmoon/language/english/US/SC/Georgetown.gif' alt='Find more about Weather in Georgetown, SC' />
			</a></div>";
		//echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/calendar.php">';
		break;
	case 2:
		echo '<META http-equiv="refresh" content="0;URL=http://localhost/cwp-test/signup.php">';
		break;
	case 3:
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/makeTable.php">';
		break;
	case 4:
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/insertStudentScoresByClass.php">';
		break;
	case 5:
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/getScores.php">';
		break;
	case 6:
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/changepassword.php">';
		break;
	case 7:
		echo '<META http-equiv="refresh" content="1;URL=http://localhost/cwp-test/index.php">';
		break;
}