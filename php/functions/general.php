<?php

function iplog($logfile, $ip){
	$lck = @fopen($logfile . '.lck', 'a+'); //semaphore lock file
	if($lck === false){
		return false;
	}
	if(flock($lck, LOCK_EX)){

	}
	$fp = @fopen($logfile, 'a+');
	if($fp === false){
		fclose($lck);
		return false;
	}
	date_default_timezone_set('America/New_York');
	$date_time = date("M d Y - g:i:s");
	$logline = $date_time . " EST, $ip\r\n";
	if(false === fwrite($fp, $logline)){
		return false;
	}
	fclose($fp);
	flock($lck, LOCK_UN);
	fclose($lck);
	return true;
}

function connectToDBase(){
	$host = "192.186.233.1";
	$host2 = "localhost";
	try{
		$link = mysqli_connect($host, "kenny", "kc226975", "cwp");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			return False;
		} else{
			return $link;
		}
	} catch(Exception $e){
		die("Could not connect: " . $e->mysql_error());
	}
}

function array_sanitize(&$item){
	try{
		$link = mysqli_connect("localhost", "kenny", "kc226975", "cwp");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else{
			$item = htmlentities(strip_tags(mysqli_real_escape_string($link, $item)));
		}
	} catch(Exception $e){
		die("Could not connect: " . $e->mysql_error());
	}
}

function sanitize($data){
	try{
		$link = mysqli_connect("localhost", "kenny", "kc226975", "cwp");

		/* check connection */
		if(mysqli_connect_errno()){
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else{
			return htmlentities(strip_tags(mysqli_real_escape_string($link, $data)));
		}
	} catch(Exception $e){
		die("Could not connect: " . $e->mysql_error());
	}
}

//end function

function login($user, $password){
	$admin = "n";
	$link = connectToDBase();

	//check username and password against database
	$sql = "SELECT `userName` from `users` WHERE `userName` = '$user' AND `passWord` = MD5('$password')";
	$result = $link->query($sql);
	if($result->num_rows > 0){
		//get the admin cloumn only
		$sql2 = "SELECT `admin` from `users` WHERE `userName` = '$user'";
		$result2 = $link->query($sql2);
		if($result2->num_rows > 0){
			while($row = $result2->fetch_assoc()){
				if($row['admin'] == 'y'){
					$admin = 'y';
					return $admin;
				} else{
					return $admin;
				}//end inner if/else
			}//end while loop
		}//end middle if
	} else{
		echo '<b><h1>Could not log you in, check your username and password, then try again!</b><br></h1>';
	}//end outer if/else
}

//end function

function getStudents(){
	$link = connectToDBase();
	$sql = "SELECT * from `students`";
	$result = $link->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			print("<table><tr>");
			/*
			  while($finfo = mysqli_fetch_field($result)){
			  printf("-<th>  %s  </th></tr>", $finfo->name);
			  }
			 *
			 */
			$id = $row['id'];
			$studentNum = $row['student_num'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$sex = $row['sex'];
			$dob = $row['dob'];
			$haddress = $row['haddress'];
			$city = $row['city'];
			$state = $row['state'];
			$zip = $row['zip'];
			$resident = $row['resident'];
			$guntype = $row['gun_type'];
			$gunmake = $row['manufacturer'];
			$guncaliber = $row['caliber'];
			$experience = $row['experience'];
			$disabilities = $row['disabilities'];
			$hphone = $row['hphone'];
			$email = $row['email'];
			$email2 = $row['email2'];
			$driverlic = $row['driverlic'];
			$dlstate = $row['dlstate'];
			$nranum = $row['nranum'];
			$nraexpire = $row['nraexpire'];
			$emergencyname = $row['emergency_name'];
			$emergencyrelation = $row['emergency_relation'];
			$emergencyaddress = $row['emergency_address'];
			$emergencycity = $row['emergency_city'];
			$emergencystate = $row['emergency_state'];
			$emergencyzip = $row['emergency_zip'];
			$emergencyhome = $row['emergency_home_num'];
			$emergencycell = $row['emergency_cell_num'];
			$emergencywork = $row['emergency_work_num'];
			$disablevet = $row['disabled_veteran'];
			$ret_form_military = $row['retired/former_military'];
			$active_military = $row['active_military'];
			$ret_law = $row['retired_law_enforcement'];
			$active_law = $row['active_law_enforcement'];
			$class_start = $row['class_start_time'];
			$lesson1_start = $row['lesson1_start_time'];
			$lesson2_start = $row['lesson2_start_time'];
			$legal_test_start = $row['legal_aspect_test_start'];
			$lesson3_start = $row['lesson3_start_time'];
			$safety_test_start = $row['firearm_safety_test_start_time'];
			$qual_start = $row['firearm_qual_start_time'];
			$class_num = $row['class_number'];
			$passFail = $row['class_pass/fail'];
			$test_score = $row['written_test_score'];
			$target_hits = $row['target_hits'];
			$submissiondate = $row['submissionDate'];
			$submissiontime = $row['submissionTime'];
			print("<table><tr>");
			printf("<th>ID</th>"
				. "<th>Student Number</th>"
				. "<th>First Name</th>"
				. "<th>Last Name</th>"
				. "<th>Sex</th><th>DOB</th>"
				. "<th>Home Address</th>"
				. "<th>City</th>"
				. "<th>State</th>"
				. "<th>Zip</th>"
				. "<th>SC Resident</th>"
				. "<th>Type of Gun</th>"
				. "<th>Manufacturer</th><th>Caliber</th>"
				. "<th>Experience</th><th>Disabilities</th>"
				. "<th>Home Phone</th>"
				. "<th>E-Mail</th>"
				. "<th>Driver Lic #</th>"
				. "<th>Lic State</th>"
				. "<th>NRA #</th>"
				. "<th>NRA Expiration</th>"
				. "<th>Emergency Name</th>"
				. "<th>Emergency Relationship</th>"
				. "<th>Emergency Address</th>"
				. "<th>Emergency City</th>"
				. "<th>Emergency State</th>"
				. "<th>Emergency Zip</th>"
				. "<th>Emergency Home #</th>"
				. "<th>Emergency Cell</th>"
				. "<th>Emergency Work #</th>"
				. "<th>Disabled Veteran</th>"
				. "<th>Retired/Former Military</th>"
				. "<th>Active Military</th>"
				. "<th>Retired Law Enforcement</th>"
				. "<th>Active Law Enforcement</th>"
				. "<th>Class Start Time</th>"
				. "<th>Lesson 1 Start Time</th>"
				. "<th>Lesson 2 Start Time</th>"
				. "<th>Legal Test Start Time</th>"
				. "<th>Lesson 3 Start Time</th>"
				. "<th>Safety Test Start Time</th>"
				. "<th>Qualification Start Time</th>"
				. "<th>Class Number</th>"
				. "<th>Pass/Fail</th>"
				. "<th>Test Score</th>"
				. "<th>Target Hits</th>"
				. "<th>Application Submisstion Date/Time</th>"
				. "</tr>"
				. "<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s : %s</td>", $id, $studentNum, $fname, $lname, $sex, $dob, $haddress, $city, $state, $zip, $resident, $guntype, $gunmake, $guncaliber, $experience, $disabilities, $hphone, $email, $driverlic, $dlstate, $nranum, $nraexpire, $emergencyname, $emergencyrelation, $emergencyaddress, $emergencycity, $emergencystate, $emergencyzip, $emergencyhome, $emergencycell, $emergencywork, $disablevet, $ret_form_military, $active_military, $ret_law, $active_law, $class_start, $lesson1_start, $lesson2_start, $legal_test_start, $lesson3_start, $safety_test_start, $qual_start, $class_num, $passFail, $test_score, $target_hits, $submissiondate, $submissiontime);
			print("</table>");
		}//end while loop
	}//end if
}

//end function
?>
