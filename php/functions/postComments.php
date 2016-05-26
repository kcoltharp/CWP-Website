<?php

function sanitize($data){
	try{
		$link = mysqli_connect("127.0.0.1", "kenny", "kc226975", "cwp_comments");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		return htmlentities(strip_tags(mysqli_real_escape_string($link, $data)));
	} catch(Exception $e){
		die("Could not connect: " . $e->mysql_error());
	}
}

if(!isset($_POST)){
	echo "There was no data to submit!";
} else{
	try{
		$link = mysqli_connect("127.0.0.1", "kenny", "kc226975", "cwp_comments");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
		$subject = sanitize($_POST['subject']);
		$comments = sanitize($_POST['comment']);

		$sql = "INSERT INTO `comments`(`id`, `subject`, `comments`)VALUES('', '$subject', '$comments')";
		if($result = mysqli_query($link, $sql)){
			echo $sql;
			printf("Inserted %d of rows" . mysqli_num_rows($result));
		} else{
			printf("There was an error " . mysqli_error($link));
		}
		mysqli_close($link);
		echo '<META http-equiv="refresh" content="4;URL=../../index.php">';
	} catch(Exception $e){
		printf("Could not connect: " . mysqli_error());
	}
}
?>