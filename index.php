<?php
require_once 'init.php';

if((!isset($_COOKIE['LOGGED_IN'])) || (empty($_COOKIE))){
	if((isset($_POST['user'])) && (isset($_POST['pass']))){
		$db->logIn($_POST['user'], $_POST['pass']);
	} else{
		header("Location: login.php");
	}
} elseif(($_COOKIE["LOGGED_IN"] == TRUE) || ($_COOKIE["LOGGED_IN"] == stristr("TRUE", "True"))){
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
	<?php
}
require_once 'includes/overall/footer.php';
?>