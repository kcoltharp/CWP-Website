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
			die(output_errors($errors));
		}
	}

	function newClass($classNum){
		try{
			$stmt = $this->prepare("INSERT INTO `classes`(`class_num`) VALUES (?)");
			$stmt->bindValue('?', $classNum);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			print("There were " . $affected_rows . " rows inserted");
		} catch(PDOException $ex){
			echo "ERROR: " . $ex->getMessage();
		}
	}

	function getStudentScores($studentNum, $studentNumber){
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
	}

	function getClassScores($classNumber){
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
	}

	function getAllScores(){
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
	}

	public function getClassTimes($classNumber){
		$stmt = $this->prepare("SELECT
				`class_num`, `class_start`, `lesson1_start`, `lesson2_start`,
				`legal_test_start`, `lesson3_start`, `safety_test_start`,
				`qual_start`
			FROM `classes`
			WHERE `class_num` = :classNumber");
		$stmt->bindParam(':classNumber', $classNumber);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	public function updateScores($studentNumber, $scores = array()){
		$stmt = $this->prepare(""
			. "UPDATE scores "
			. "SET legal_test_score = :legalScore,"
			. "safety_test_score = :safetyScore,"
			. "combined_score = :combinedScore,"
			. "target_hits = :targetHits,"
			. "pass_fail = :PassFail"
			. "WHERE student_num = :studentNum");
		$stmt->bindParam(':studentNum', $studentNumber);
		$stmt->bindParam(':legal_test_score', $scores['legalScore']);
		$stmt->bindParam(':safety_test_score', $scores['safetyScore']);
		$stmt->bindParam(':combined_score', $scores['combinedScore']);
		$stmt->bindParam(':target_hits', $scores['targetHits']);
		$stmt->bindParam(':pass_fail', $scores['pass_fail']);
		$stmt->execute();
		return $stmt->rowCount();
	}

	public function logIn($user, $pwd){
		$passd = password_hash($pwd, PASSWORD_DEFAULT);
		echo $passd;
		try{
			$stmt = $this->prepare("SELECT * FROM `users` WHERE `userName` = ':user'");
			$stmt->bindParam(':user', $user);
			$stmt->execute();
			$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo "<br />";
			var_dump(password_get_info($row[0]['passWord']));
			echo "<br />";
			var_dump($row[0]);
			if(password_verify($row[0]['passWord'], $passd)){
				$_SESSION['userID'] = $row[0]['user_id'];
				$_SESSION['userName'] = ucfirst($row[0]['userName']);
				return TRUE;
			} else{
				return FALSE;
			}
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			die(output_errors($errors));
		}
	}

	public function logged_in(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}

	public function changePassword($username, $newPassword){
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
			die(output_errors($errors));
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
				$stmt = $this->prepareStmt("SELECT $fields FROM users WHERE user_id = $userID");
				$stmt->execute();
				return $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
			} catch(PDOException $ex){
				$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
					'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
					'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
					'</p>';
				die(output_errors($errors));
			}
		}
	}

	public function user_active($username){
		try{
			$stmt = $this->prepareStmt("SELECT COUNT(`user_id`) FROM `users` WHERE `username` = :username AND `admin` = 'y'");
			$stmt->bindParam($username);
			$stmt->execute();
			return (($count = $stmt->fetchColumn()) === 1) ? TRUE : FALSE;
		} catch(PDOException $ex){
			$errors = '<p><strong>Error:</strong> ' . $ex->getMessage() .
				'</p><br /><p><strong>File:</strong> ' . $ex->getFile() .
				'</p></br><p><strong>Line:</strong> ' . $ex->getLine() .
				'</p>';
			return $errors;
		}
	}

	public function prepareStmt($sql){
		parent::prepare($sql);
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
		if($user_data['admin'] === 'y'){
			echo '<META http-equiv="refresh" content="1;URL=C:/Apache24/htdocs/cwp-test/admin/">';
			exit();
		}
	}

	public function output_errors($errors){
		return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
	}

}

?>