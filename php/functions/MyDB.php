<?PHP

/*
  DEFINE("HOST", "localhost", TRUE);
  DEFINE("HOST2", "192.186.233.1", TRUE);
  DEFINE("USER", "kenny", TRUE);
  DEFINE("PWD", "kc226975", TRUE);
  DEFINE("DB", "sccwp", TRUE);
 */

class MyDB extends mysqli{

	/**
	 * Constructor that connects to MySQL while instantiating the class
	 */
	public function __construct(){
		parent::__construct(HOST, USER, PWD, DB);
		$this->set_charset('utf8');
		if(mysqli_connect_error()){
			die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
		}
	}

	/**
	 * Closes connection to MySQL and destroys the object
	 */
	function __destruct(){
		$this->close();
		echo 'Destroying: ', $this->name, PHP_EOL;
	}

	/**
	 * This function will escape the data input via the MySQLi real escape string
	 *
	 * @param type $item Original unescaped string	 *
	 * @return type Returns a string that has been properly escaped
	 */
	function sanitize($item){
		$newItem = $this->real_escape_string($item);
		return $newItem;
	}

	/**
	 * This function will take an SQL statement and parameters, prepare the
	 * statement, test the variable for typing, and bind parameters to the
	 * SQL statement, then return it.
	 *
	 * @param	 String		$sql		SQL string ready to be sent to MySQL
	 * @param	 Array/Object	$param	Array holding the parameters to bind to the statement
	 * @return String		$stmt	Returns a prepared SQL statement with parameters bound
	 */
	function prepareStatement($sql, $param){
		$stmt = $this->stmt_init();
		if(is_array($param)){
			if($stmt->prepare($sql)){
				foreach($param as $value){
					$stmt->bind_param($this->variableType($value), $value);
				}//end foreach loop
			}//end if stmt
		} else{
			$stmt->bind_param($this->variableType($value), $value);
		}//end if/else block
		return $stmt;
	}

	function login($user, $password){
		$admin = "n";
		//check username and password against database
		$sql = "SELECT `userName` from `users` WHERE `userName` = '$user' AND `passWord` = MD5('$password')";
		$result = $this->query($sql);
		if($result->num_rows > 0){
			//get the admin cloumn only
			$sql2 = "SELECT `admin` from `users` WHERE `userName` = '$user'";
			$result2 = $this->query($sql2);
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

	function emailStudents($subject, $body){
		$sql = "SELECT `email`, `fname`, `lname` "
			. "FROM `student_info` INNER JOIN `students` "
			. "WHERE `student_info`.`student_num` = `students`.`student_num`";
		if($results = $this->query($sql)){
			while(($row = $this->mysql_fetch_assoc($results)) !== false){
				email($row['email'], $subject, "Hello " . $row['fname'] . " "
					. $row['lname'] . ",\n\n" . $body);
			}
		}
	}

	/**
	 * This function will test a variable to determine its type. Then it will
	 * return the corresponding letter for that type in order to bind it to an
	 * SQL statement.
	 *
	 * @param		mixed	$var
	 * @return	string	String corresponding to the type of variable to
	 * 					bind to the SQL statement.
	 */
	function variableType($var){
		if(is_int($var)){
			$type = 'i';
		} elseif(is_double($var)){
			$type = 'd';
		} elseif(is_string($var)){
			$type = 's';
		} else{
			$type = 'b';
		}//end if/elseif/elseif/else block
		return $type;
	}

}
