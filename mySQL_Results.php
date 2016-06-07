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

	function getAllScores($db){
		$stmt = $db->prepare("
			SELECT a.student_num, a.fname, a.lname, b.class_num, b.legal_test_score, b.safety_test_score, b.combined_score, b.target_hits, b.pass_fail
			FROM students a, scores b
			WHERE a.student_num = b.student_num");
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

	function getClassInfo($db){
		$stmt = $db->prepare("
			SELECT
				a.fname, a.lname, b.class_num, b.class_start, b.lesson1_start,
				b.lesson2_start, b.legal_test_start, b.lesson3_start,
				b.safety_test_start, b.qual_start
			FROM students a, classes b, student_numbers c
			WHERE c.student_num=a.student_num AND c.class_num=b.class_num");
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $rows;
	}

}
