<?php
require_once 'init.php';
print_r($_REQUEST);

if((isset($_REQUEST['classNum'])) && ($_REQUEST['classNum'] != "")){
	$classNum = $_REQUEST['classNum'];
	$db = new Database(dsn, user, pwd);
	$rows = $db->getClassScores($db, $classNum);
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
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="classNum">Class Number to Look Up:</label><br>
		<input type="text" name="classNum" /><br>
		<button id="button submit" type="submit" name="submit">Submit</button>
	</form>
<?php } else{
	?>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="classNum">Class Number to Look Up:</label><br>
		<input type="text" name="classNum" /><br>
		<button id="button submit" type="submit" name="submit">Submit</button>
	</form>
	<?php
}
require_once 'includes/overall/footer.php';
?>