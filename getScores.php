<?php
require_once 'init.php';

if((isset($_POST['studentNum'])) && ($_POST['studentNum'] != "")){
	$studentNum = $_POST['studentNum'];
	$studentNumber = $_POST['studentNum'];
	$db = new MyDB(DSN, USER, PASSWORD);
	$rows = $db->getStudentScores($studentNum, $studentNumber);
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

	<?php
} elseif((isset($_POST['classNum'])) && ($_POST['classNum'] != "")){
	$classNum = $_POST['classNum'];
	$db = new MyDB(DSN, USER, PASSWORD);
	$rows = $db->getClassScores($classNum);
	?>
	<table border = "1" cellspacing = "3" cellpadding = "2">
		<thead>
			<tr>
				<th>Class Number</th>
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
					<td><?php echo $value['class_num'] ?></td>
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
<?php } ?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
	<label for="studentNum">Student Number:</label><br>
	<input type="number" name="studentNum" /><br>
	<label for="classNum">Class Number:</label><br>
	<input type="number" name="classNum" /><br>
	<button id="button submit" type="submit" name="submit">Submit</button>
</form>
<?php require_once 'includes/overall/footer.php'; ?>