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

}
