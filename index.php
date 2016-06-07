<?php
require_once 'init.php';
?>
<p style="float:left; margin-left: 10px;">
	<?php
	$date = new DateTime('now');
	echo $date->format('D M d Y') . "<br>";
	echo $date->format('g:i:s a') . "<br>";
	?>
</p>
<br />
<form action="" method="post">
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
			<?php
			$db = new Database(dsn, user, pwd);
			$rows = $db->getAllScores($db);
			foreach($rows as $value){
				?>
				<tr>
					<td><?php
						if($value['student_num'] === "" || $value['student_num'] === NULL){
							echo "<input type='text' name='studentNumber' placeholder='Student Number' />";
						} else{
							echo $value['student_num'];
						}
						?></td>
					<td><?php echo $value['class_num'] ?></td>
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
	<br>
	<button id="button" type="submit" name="submit">Submit Changes</button>
	<button id="button" type="button">Get Class Information</button>
	<button id="button" type="button">Get All Student Information</button>
	<button id="button" type="button">Button 3</button>
	<button id="button" type="button">Button 4</button>
	<button id="button" type="button">Button 5</button>
</form>






<?php
require_once 'includes/overall/footer.php';
?>
