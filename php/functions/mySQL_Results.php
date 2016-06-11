<?php

class Database extends PDO{

	public function _construct(){
		try{
			parent::__construct(dsn, username, password);
//parent::__construct("mysql:dbname=cwp;host=192.186.233.1", "kenny", "kc226975");
			$this->setAttribute(PDO::ATTR_STATEMENT_CLASS, array('_pdo_statement'));
			$this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			die('<p><strong>Error:</strong> ' . $e->getMessage() . '</p>
		  <p><strong>File:</strong> ' . $e->getFile() . '</br>
		  <p><strong>Line:</strong> ' . $e->getLine() . '</p>');
		}
	}

	function newClass($classNum){
		try{
			$db = new PDO('mysql:host=localhost;dbname=testdb;charset=utf8', 'username', 'password');
			$stmt = $db->prepare("INSERT INTO `classes`(`class_num`) VALUES (?)");
			$stmt->bindValue('?', $classNum);
			$stmt->execute();
			$affected_rows = $stmt->rowCount();
			print("There were " . $affected_rows . " rows inserted");
		} catch(PDOException $ex){
			echo "ERROR: " . $ex->getMessage();
		}
	}

	function getStudentScores($db, $studentNumber){
		$stmt = $db->prepare("SELECT
				a.student_num, a.fname, a.lname, b.class_num, b.legal_test_score,
				b.legal_test_score, b.safety_test_score, b.combined_score,
				b.target_hits, b.pass_fail
			FROM scores b
			INNER JOIN students a ON a.student_num = b.student_num
			WHERE a.student_num = $studentNumber AND b.student_num = $studentNumber");
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	function getClassScores($db, $classNumber){
		$stmt = $db->prepare("SELECT
				c.class_num, a.student_num, a.fname, a.lname,
				b.legal_test_score, b.safety_test_score, b.combined_score,
				b.target_hits, b.pass_fail
			FROM scores b
			INNER JOIN students a ON a.student_num=b.student_num
			INNER JOIN classes c ON c.class_num = b.class_num
			WHERE c.class_num = $classNumber AND b.class_num = $classNumber");
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	function getAllScores($db){
		$stmt = $db->prepare("SELECT
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

	function getClassTimes($db, $classNumber){
		$stmt = $db->prepare("SELECT
				`class_num`, `class_start`, `lesson1_start`, `lesson2_start`,
				`legal_test_start`, `lesson3_start`, `safety_test_start`,
				`qual_start`
			FROM `classes`
			WHERE `class_num` = '$classNumber'");
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	function newBlogEntry($db, $title, $content, $category, $teaser){
		$sql = "INSERT INTO blog_entries(title, content, category, teaser, entry_time)"
			. "VALUES(:title, :content, :category, :teaser, NOW())";
		$stmt = $db->prepare($sql);
		$stmt->bindParam(":title", $title, PDO::PARAM_STR);
		$stmt->bindParam(":content", $content, PDO::PARAM_STR);
		$stmt->bindParam(":category", $category, PDO::PARAM_STR);
		$stmt->bindParam(":teaser", $teaser, PDO::PARAM_STR);
		$stmt->execute();
		$id = $db->lastInsertID();
		return $id;
	}

}
