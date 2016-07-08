<?php
require_once 'init.php';

if((!isset($_COOKIE['LOGGED_IN'])) || (empty($_COOKIE))){
	if((isset($_POST['user'])) && (isset($_POST['pass']))){
		$db->logIn($_POST['user'], $_POST['pass']);
	} else{
		header("Location: login.php");
	}
} elseif(($_COOKIE["LOGGED_IN"] === TRUE) || (stristr($_COOKIE["LOGGED_IN"], "TRUE") != FALSE)){
	$stmt = $db->prepare("SELECT * FROM students");
	$stmt->execute();
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	?>

	<form>
		<br />
		<select name='students' onChange='showStudent(this.value)'>
			<option value="" selected>Select a student</option>
			<?php
			$x = 0;
			foreach($rows as $value){
				echo '<option value="' . $rows[$x]['student_num'] . '">' . $rows[$x]['fname'] . ' ' . $rows[$x]['lname'] . '</option><br />';
				$x += 1;
			}
			?>
		</select>
	</form>
	<br />
	<div id="txtHint">Student info will be listed here...</div>
	<script>
		function showStudent(str){
			var xhttp;
			if(str === ""){
				document.getElementById("txtHint").innerHTML = "";
				return;
			}
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState === 4 && xhttp.status === 200){
					document.getElementById("txtHint").innerHTML = xhttp.responseText;
				}
			};
			xhttp.open("GET", "php/getstudent.php?q=" + str, true);
			xhttp.send();
		}
	</script>
	<br />
	<form action="" method="POST">
		<select class="select" name="selectPage" onchange="showPage(this.value)">
			<option value="" selected="">Make a Selection</option>
			<option value="1">Calendar</option>
			<option value="2">Signup</option>
			<option value="3">makeTable</option>
			<option value="4">insertStudentScoresByClass</option>
			<option value="5">getScores</option>
			<option value="6">ChangePassword</option>
			<option value="7">Home</option>
		</select>
	</form>
	<br />
	<div id="page">Student info will be listed here...</div>
	<script>
		/*
		 $(document).ready(function(){
		 $(".select").ajax({
		 method: "POST",
		 url: "choosePage.php",
		 data: $('.select').change().val()
		 });
		 .done(function(html){
		 $('#page').append(html);
		 });
		 });
		 */
		function showPage(num){
			var xhttp;
			if(num === ""){
				document.getElementById("page").innerHTML = "";
				return;
			}
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState === 4 && xhttp.status === 200){
					document.getElementById("page").innerHTML = xhttp.responseText;
				}
			};
			xhttp.open("GET", "choosePage.php?q=" + num, true);
			xhttp.send();
		}

	</script>
	<br /><br />
	<form action="" method="POST">
		<label for="textbox">Enter SQL to submit to MySQL</label><br />
		<textarea onchange="runSQL(this.value)" name="textbox" form="sql" rows="3" cols="45" ></textarea>
	</form>
	<br />
	<div><pre id="results"></pre>Result of query will be displayed here.</div>
	<script>
		function runSQL(str){
			var xhttp;
			if(str === ""){
				document.getElementById("results").innerHTML = "";
				return;
			}
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function(){
				if(xhttp.readyState === 4 && xhttp.status === 200){
					document.getElementById("results").innerHTML = xhttp.responseText;
				}
			};
			xhttp.open("GET", "sql.php?q=" + str, true);
			xhttp.send();
		}

	</script>
	<?php
} else{
	header("Location: login.php");
}
require_once 'includes/overall/footer.php';
?>