<aside>
	<?php
	if(logged_in() === true){
		require_once 'includes/widgets/loggedin.php';
	} else{
		require_once 'includes/widgets/login.php';
	}
	?>
</aside>