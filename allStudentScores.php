<?php
require_once 'init.php';
$rowsmarty = new Smarty();
?>
<div class="container">
	<table id="studentScores" border = "1" cellspacing = "3" cellpadding = "2">
		<thead>
			<tr>
				<th>Student Number</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Class Number</th>
				<th>Legal Test Score</th>
				<th>Firearm Safety Test Score</th>
				<th>Combined Test Score</th>
				<th>Target Hits</th>
				<th>Class Pass/Fail</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$db = new Database(dsn, user, pwd);
			$res = $db->prepare("SELECT
		a.student_num, a.fname, a.lname, b.class_num,
		b.legal_test_score, b.safety_test_score, b.combined_score,
		b.target_hits, b.pass_fail
	FROM students a, scores b
	WHERE a.student_num = b.student_num");

			$res->execute();
			$array = $res->fetchAll(PDO::FETCH_ASSOC);
			$x = 0;
			foreach($array as $row){
				?><tr>
					<td><?php echo $row['student_num']; ?></td>
					<td><?php echo $row['fname']; ?></td>
					<td><?php echo $row['lname']; ?></td>
					<td><?php echo $row['class_num']; ?></td>
					<td><?php echo $row['legal_test_score']; ?></td>
					<td><?php echo $row['safety_test_score']; ?></td>
					<td><?php echo $row['combined_score']; ?></td>
					<td><?php echo $row['target_hits']; ?></td>
					<td><?php echo $row['pass_fail']; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<?php require_once 'includes/overall/footer.php'; ?>