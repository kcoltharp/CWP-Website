<?php
require_once 'init.php';

if((isset($_REQUEST['studentNum'])) && ($_REQUEST['studentNum'] != "")){
	$studentNum = $_REQUEST['studentNum'];
	$db = new Database(dsn, user, pwd);
	$rows = $db->getStudentScores($db, $studentNum);
	?>
	<table border = "1" cellspacing = "3" cellpadding = "2">
		<thead>
			<tr>
				<th>Student Number</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Legal Test Score</th>
				<th>Firearm Safety Test Score</th>
				<th>Combined Score</th>
				<th>Target Hits</th>
				<th>Class Pass/Fail</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rows as $value){ ?>
				<tr>
					<td><?php echo $value['student_num'] ?></td>
					<td><?php echo $value['fname'] ?></td>
					<td><?php echo $value['lname'] ?></td>
					<td><?php echo $value['legal_test_score'] ?></td>
					<td><?php echo $value['safety_test_score'] ?></td>
					<td><?php echo $value['combined_score'] ?></td>
					<td><?php echo $value['target_hits'] ?></td>
					<td><?php echo $value['pass_fail'] ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<br><br>

<?php } else{
	?>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="studentNum">Student Number to Look Up:</label><br>
		<input type="text" name="studentNum" /><br>
		<button id="button submit" type="submit" name="submit">Submit</button>
	</form>
<?php }
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="studentNum">Look Up Another Student Number:</label><br>
	<input type="text" name="studentNum" /><br>
	<button id="button submit" type="submit" name="submit">Submit</button>
</form>
<?php require_once 'includes/overall/footer.php';
?>