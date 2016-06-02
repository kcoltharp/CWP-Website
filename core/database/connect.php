<?php
$connect_error = 'Sorry, we\'re experiencing connection problems.';
mysql_connect('localhost', 'kenny', 'kc226975') or die($connect_error);
mysql_select_db('grocery') or die($connect_error);
?>