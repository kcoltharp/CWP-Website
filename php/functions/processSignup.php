<?php

function sanitize($data){
	try{
		$link = mysqli_connect("127.0.0.1", "kenny", "kc226975", "cwp");

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
		//get user form input from $POST, sanitize, then assign to normal variable
		$fname = sanitize($_POST['fname']);
		$lname = sanitize($_POST['lname']);
		$sex = sanitize($_POST['sex']);
		$dob = sanitize($_POST['dob']);
		$haddress = sanitize($_POST['haddress']);
		$city = sanitize($_POST['city']);
		$state = sanitize($_POST['state']);
		$zip = sanitize($_POST['zip']);
		$resident = sanitize($_POST['resident']);
		$guntype = sanitize($_POST['guntype']);
		$gunmake = sanitize($_POST['gunmake']);
		$guncaliber = sanitize($_POST['guncaliber']);
		$experience = sanitize($_POST['experience']);
		$disabilities = sanitize($_POST['disabilities']);
		$hphone = sanitize($_POST['hphone']);
		$email = sanitize($_POST['email']);
		$email2 = sanitize($_POST['email2']);
		$driverlic = sanitize($_POST['driverlic']);
		$dlstate = sanitize($_POST['dlstate']);
		$nranum = sanitize($_POST['nranum']);
		$nraexpire = sanitize($_POST['nraexpire']);
		$emergencyname = sanitize($_POST['emergencyname']);
		$emergencyrelation = sanitize($_POST['emergencyrelation']);
		$emergencyaddress = sanitize($_POST['emergencyaddress']);
		$emergencycity = sanitize($_POST['emergencycity']);
		$emergencystate = sanitize($_POST['emergencystate']);
		$emergencyzip = sanitize($_POST['emergencyzip']);
		$emergencyhome = sanitize($_POST['emergencyhome']);
		$emergencycell = sanitize($_POST['emergencycell']);
		$emergencywork = sanitize($_POST['emergencywork']);
		$disablevet = sanitize($_POST['disablevet']);
		$submissiondate = sanitize($_POST['submissiondate']);
		$submissiontime = sanitize($_POST['submissiontime']);

		$link = mysqli_connect("localhost", "kenny", "kc226975", "cwp");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		$sql = "INSERT INTO `students` (`id`, `fname`, `lname`, `sex`, `dob`, `haddress`, `city`, `state`, `zip`, `resident`, `experience`, `disabilities`, `hphone`, `email`, `email2`, `driverlic`, `dlstate`, `nranum`, `nraexpire`, `emergency_name`, `emergency_relation`, `emergency_address`, `emergency_city`, `emergency_state`, `emergency_zip`, `emergency_home_num`, `emergency_cell_num`, `emergency_work_num`, `disabled_veteran`, `submissionDate`, `submissionTime`) VALUES ('', '$fname', '$lname', '$sex', '$dob', '$haddress', '$city', '$state', '$zip', '$resident', '$experience', '$disabilities', '$hphone', '$email', '$email2', '$driverlic', '$dlstate', '$nranum', '$nraexpire', '$emergencyname', '$emergencyrelation', '$emergencyaddress', '$emergencycity', '$emergencystate', '$emergencyzip', '$emergencyhome', '$emergencycell', '$emergencywork', '$disabledvet', CURRENT_DATE(), CURRENT_TIME())";

		if($result = mysqli_query($link, $sql)){
			printf("Inserted %d of rows" . mysqli_num_rows($result));
			mysqli_close($link);
		} else{
			printf("There was an error " . mysqli_error($link));
		}
	} catch(Exception $e){
		printf("Connection Failed: %s\n" . mysqli_connect_errno());
		exit();
	}
	//
	//$emergency_sql = "INSERT INTO `emergency_contact`(`emergencyname`, `emergencyrelation`, `emergencyaddress`, `emergencycity`, `emergencystate`, `emergencyzip`, `emergencyhome`, `emergencycell`, `emergencywork`) VALUES('$emergencyname', '$emergencyrelation', '$emergencyaddress', '$emergencycity', '$emergencystate', '$emergencyzip', '$emergencyhome', '$emergencycell', '$emergencywork')";
	//$gun_sql = "INSERT INTO `gun_information` (`guntype`, `gunmake`, `guncaliber`) VALUES('$guntype', '$gunmake', '$guncaliber')";
	//var_dump($_POST);
	echo '<META http-equiv="refresh" content="4;URL=../../index.php">';
}
?>
