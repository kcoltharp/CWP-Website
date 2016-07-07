<?php

class MyDB extends PDO{

	public function _construct($dsn, $username, $password){
		try{
			parent::__construct($dsn, $username, $password);
			$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('_pdo_statement'));
			$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	function newClass($classNum){
		try{
			$stmt = $this->prepare("INSERT INTO `classes`(`class_num`) VALUES (?)");
			$stmt->bindValue('?', $classNum, PDO::PARAM_INT);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			print("There were " . $affected_rows . " rows inserted");
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	function getStudentScores($studentNum, $studentNumber){
		try{
			//echo $studentNum . "<br />" . $studentNumber . "<br />";
			$sql = "SELECT a.student_num, a.fname, a.lname, b.class_num, b.legal_test_score,
				b.legal_test_score, b.safety_test_score, b.combined_score,
				b.target_hits, b.pass_fail
			FROM scores b
			INNER JOIN students a ON a.student_num = b.student_num
			WHERE a.student_num = :studentNum AND b.student_num = :Number";
			$stmt = $this->prepare($sql);
			$stmt->bindParam(':studentNum', $studentNumber, PDO::PARAM_INT);
			$stmt->bindParam(':Number', $studentNum, PDO::PARAM_INT);

			$stmt->execute();
			//var_dump($stmt);
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	function getClassScores($classNumber){
		try{
			$stmt = $this->prepare("SELECT
				c.class_num, a.student_num, a.fname, a.lname,
				b.legal_test_score, b.safety_test_score, b.combined_score,
				b.target_hits, b.pass_fail
			FROM scores b
			INNER JOIN students a ON a.student_num=b.student_num
			INNER JOIN classes c ON c.class_num = b.class_num
			WHERE c.class_num = :classNumber AND b.class_num = :classNumber");
			$stmt->bindParam(':classNumber', $classNumber, PDO::PARAM_INT);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	function getAllScores(){
		try{
			$stmt = $this->prepare("SELECT
				a.student_num, a.fname, a.lname, b.class_num,
				b.legal_test_score, b.safety_test_score, b.combined_score,
				b.target_hits, b.pass_fail
			FROM students a, scores b
			WHERE a.student_num = b.student_num");
			$stmt->execute();
			$rows = $stmt->setFetchMode(PDO::FETCH_LAZY);
			//$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	public function getClassTimes($classNumber){
		try{
			$stmt = $this->prepare("SELECT
				`class_num`, `class_start`, `lesson1_start`, `lesson2_start`,
				`legal_test_start`, `lesson3_start`, `safety_test_start`,
				`qual_start`
			FROM `classes`
			WHERE `class_num` = :classNumber");
			$stmt->bindParam(':classNumber', $classNumber, PDO::PARAM_INT);
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $rows;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	public function updateScores($studentNumber, $scores = array()){
		try{
			$stmt = $this->prepare(""
				. "UPDATE scores "
				. "SET legal_test_score = :legalScore,"
				. "safety_test_score = :safetyScore,"
				. "combined_score = :combinedScore,"
				. "target_hits = :targetHits,"
				. "pass_fail = :PassFail"
				. "WHERE student_num = :studentNum");
			$stmt->bindParam(':studentNum', $studentNumber, PDO::PARAM_INT);
			$stmt->bindParam(':legal_test_score', $scores['legalScore'], PDO::PARAM_INT);
			$stmt->bindParam(':safety_test_score', $scores['safetyScore'], PDO::PARAM_INT);
			$stmt->bindParam(':combined_score', $scores['combinedScore'], PDO::PARAM_INT);
			$stmt->bindParam(':target_hits', $scores['targetHits'], PDO::PARAM_INT);
			$stmt->bindParam(':pass_fail', $scores['pass_fail'], PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->rowCount();
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	public function logIn($user, $pwd){
		try{
			$stmt = $this->prepare("SELECT * FROM users WHERE userName = :user");
			$stmt->bindParam(':user', $user, PDO::PARAM_STR);
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if((isset($row)) && (!empty($row))){
				if(password_verify($pwd, $row[0]['passWord'])){
					echo "<br />Success!";
					//extract($row[0], EXTR_PREFIX_ALL, "var_");
					$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : FALSE;
					setcookie("LOGGED_IN", "TRUE");
					foreach($row[0] as $key => $value){
						$_COOKIE[$key] = $value;
						$_COOKIE['expire'] = time() + (60 * 60 * 24 * 30);
						setcookie($key, $value, time() + (60 * 60 * 24 * 30), "/", $domain, FALSE, FALSE);
					}// end foreach to set cookies
					setcookie("LOGGED_IN", "TRUE");
					return TRUE;  //if passwords match and cookies are set
				} elseif(!password_verify($pwd, $row[0]['passWord'])){
					setcookie("LOGGED_IN", "FALSE");
					echo "<br />Failed verify!";
					return FALSE;  //if password verify is false
				} else{
					setcookie("LOGGED_IN", "FALSE");
					return FALSE;   //if password verify does not work
				}//end inner if/elseif/else
			} else{
				echo "<br /> var row not set??";
				var_dump($row);
				setcookie("LOGGED_IN", "FALSE");
				return FALSE;  //if $row is empty or not set
			}// end if/else
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	public function logged_in(){
		return (isset($_SESSION['user_id'])) ? TRUE : FALSE;
	}

	public function changePassword($username, $newPassword){
		if($this->logged_in() === TRUE){
			$password = password_hash($newPassword, PASSWORD_DEFAULT);
			try{
				$stmt = $this->prepare("UPDATE `users` SET `passWord` = :password WHERE `userName` = :user");
				$stmt->bindParam(':password', $password);
				$stmt->bindParam(':user', $username);
				$stmt->execute();
				$rowCount = $stmt->rowCount();
				if($rowCount > 0){
					echo $rowCount . " row(s) was updated.";
				}
			} catch(PDOException $ex){
				$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
					'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
					'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
					'</p>';
				$this->output_errors($errors);
			}
		} else{
			$errors = '<p><strong>Error:</strong> You can\'t change your password unless you are logged in.<br />'
				. 'Log in, then try again to change your password.';
			$this->output_errors($errors);
		}
	}

	public function user_data($user_id){
		$userID = (int) $user_id;
		$func_num_args = func_num_args();
		$func_get_args = func_get_args();
		if($func_num_args > 1){
			unset($func_get_args[0]);
			$fields = '`' . implode('`, `', $func_get_args) . '`';
			try{
				$stmt = $this->prepareStmt("SELECT $fields FROM users WHERE user_id = :userID");
				$stmt->bindParam(':userID', $user_id, PDO::PARAM_INT);
				$stmt->execute();
				return $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch(PDOException $ex){
				$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
					'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
					'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
					'</p>';
				$this->output_errors($errors);
			}
		}
	}

	public function user_active($username){
		try{
			$stmt = $this->prepareStmt("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = :username AND `admin` = 'y'");
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->execute();
			return (($count = $stmt->fetchColumn()) === 1) ? TRUE : FALSE;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			$this->output_errors($errors);
		}
	}

	public function email($to, $subject, $body){
		mail($to, $subject, $body, 'From: cwp@sc-cwp.kennys-spot.org');
	}

	public function logged_in_redirect(){
		if(logged_in() === true){
			echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/index.php">';
			exit();
		}
	}

	public function protect_page(){
		if(logged_in() === false){
			echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/index.php">';
			exit();
		}
	}

	public function admin_protect(){
		global $user_data;
		if(($user_data['admin'] === 'y') && (logged_in() === true)){
			echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/admin/">';
			exit();
		}
	}

	public function output_errors($errors){
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}

	public function signUP($array){
		if(isset($_POST)){
			//get user form input from $POST, sanitize, then assign to normal variable
			$fname = $this->sanitize($_POST['fname']);
			$lname = $this->sanitize($_POST['lname']);
			$sex = $this->sanitize($_POST['sex']);
			$dob = $this->sanitize($_POST['dob']);
			$haddress = $this->sanitize($_POST['haddress']);
			$city = $this->sanitize($_POST['city']);
			$state = $this->sanitize($_POST['state']);
			$zip = $this->sanitize($_POST['zip']);
			$resident = $this->sanitize($_POST['resident']);
			$guntype = $this->sanitize($_POST['guntype']);
			$gunmake = $this->sanitize($_POST['gunmake']);
			$guncaliber = $this->sanitize($_POST['guncaliber']);
			$experience = $this->sanitize($_POST['experience']);
			$disabilities = $this->sanitize($_POST['disabilities']);
			$hphone = $this->sanitize($_POST['hphone']);
			$email = $this->sanitize($_POST['email']);
			$email2 = $this->sanitize($_POST['email2']);
			$driverlic = $this->sanitize($_POST['driverlic']);
			$dlstate = $this->sanitize($_POST['dlstate']);
			$nranum = $this->sanitize($_POST['nranum']);
			$nraexpire = $this->sanitize($_POST['nraexpire']);
			$emergencyname = $this->sanitize($_POST['emergencyname']);
			$emergencyrelation = $this->sanitize($_POST['emergencyrelation']);
			$emergencyaddress = $this->sanitize($_POST['emergencyaddress']);
			$emergencycity = $this->sanitize($_POST['emergencycity']);
			$emergencystate = $this->sanitize($_POST['emergencystate']);
			$emergencyzip = $this->sanitize($_POST['emergencyzip']);
			$emergencyhome = $this->sanitize($_POST['emergencyhome']);
			$emergencycell = $this->sanitize($_POST['emergencycell']);
			$emergencywork = $this->sanitize($_POST['emergencywork']);
			$disablevet = $this->sanitize($_POST['disablevet']);

			$sql = "INSERT INTO `students` (`id`, `fname`, `lname`, `sex`, `dob`, `haddress`, `city`, `state`, `zip`, `resident`, `experience`, `disabilities`, `hphone`, `email`, `email2`, `driverlic`, `dlstate`, `nranum`, `nraexpire`, `emergency_name`, `emergency_relation`, `emergency_address`, `emergency_city`, `emergency_state`, `emergency_zip`, `emergency_home_num`, `emergency_cell_num`, `emergency_work_num`, `disabled_veteran`, `submissionDate`, `submissionTime`) VALUES ('', '$fname', '$lname', '$sex', '$dob', '$haddress', '$city', '$state', '$zip', '$resident', '$experience', '$disabilities', '$hphone', '$email', '$email2', '$driverlic', '$dlstate', '$nranum', '$nraexpire', '$emergencyname', '$emergencyrelation', '$emergencyaddress', '$emergencycity', '$emergencystate', '$emergencyzip', '$emergencyhome', '$emergencycell', '$emergencywork', '$disablevet', CURRENT_DATE(), CURRENT_TIME())";

			if($result = mysqli_query($link, $sql)){
				printf("Inserted %d of rows" . mysqli_num_rows($result));
				$link->close();
			} else{
				printf("There was an error " . mysqli_error($link));
				$link->close();
				exit();
			}//end inner if/else
		} else{
			echo "<b><h2 align='center'>There was no data! Please press the back button, refresh the page and try again!</h2></b>";
			$link->close();
			exit();
		}//end outer if/else
	}

//end function
}

?>