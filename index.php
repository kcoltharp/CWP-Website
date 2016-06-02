<?php
require_once 'init.php';
?>
<h1>Home</h1>
<br /><br />
<p style="float:right; margin-right: 10px;">
	February 20, 2015
</p>
<br />

<?php
$db = new Database(dsn, user, pwd);
/*
  SELECT a.student_num, a.fname, a.lname, b.class_num, b.legal_test_score, b.safety_test_score, b.combined_score, b.target_hits, b.pass_fail
  FROM students a, scores b
  WHERE a.student_num = b.student_num
 *
 */
$stmt = $db->prepare("SELECT `student_num`, `fname`, `lname` FROM `students`");
$stmt->execute();
$studentRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare("SELECT `class_num`, `legal_test_score`, `saftey_test_score`, `combine_score`, `target_hits`, `pass_fail` FROM `scores` WHERE `student_num`=:studentNum");
$stmt2->bindParam(':studentNum', $studentRows['student_num']);
$stmt2->execute();
$scoresRow = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>
<table border="1" cellspacing="3" cellpadding="2">
	<thead>
		<tr>
			<th>Student Number</th>
			<th>Class Number</th>
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
		<?php while((list(, $value) = each($studentRows)) && (list(, $value2) = each($scoresRow))){ ?>
			<tr>
				<td><?php echo $studentRows['student_num'] ?></td>
				<td><?php echo $scoresRows['class_num'] ?></td>
				<td><?php echo $studentRows['fname'] ?></td>
				<td><?php echo $studentRows['lname'] ?></td>
				<td><?php echo $scoresRows['legal_test_score'] ?></td>
				<td><?php echo $scoresRows['safety_test_score'] ?></td>
				<td><?php echo $scoresRows['combined_score'] ?></td>
				<td><?php echo $scoresRows['target_hits'] ?></td>
				<td><?php echo $scoresRows['pass_fail'] ?></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>

	<pre>
		<?php print_r($rows); ?>
	</pre>
	<p>
		Hey, great news! The new To Do lists are now available, so start using them.
	</p>
	<p>
		Coming soon, a nice attractive calendar that will be able to track<br>
		all of our current and future appointments!<br><br><br><br>

		Admin
	</p>




	<?php
	require_once 'includes/overall/footer.php';
