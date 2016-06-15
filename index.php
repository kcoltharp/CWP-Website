<?php
require_once 'init.php';
?>
<pre>
	<?php
	echo "Session data: <br />";
	print_r($_SESSION) . "<br />";
	echo "Server data: <br />";
	print_r($_SERVER) . "br />";
	echo "Post data: <br />";
	print_r($_POST) . "br />";
	echo "GET data: <br />";
	print_r($_GET) . "br />";
	echo "Env data: <br />";
	print_r($_ENV) . "br />";
	echo "Cookie data: <br />";
	print_r($_COOKIE) . "br />";
	?>
</pre>





<?php
require_once 'includes/overall/footer.php';
?>
