<?php
require_once 'php/functions/class.MyDB.php';
define('DSN', 'mysql:dbname=sccwp;host=127.0.0.1;charset=utf8', false);
define('USER', 'kenny', false);
define('PASSWORD', 'kc226975', false);
$db = new MyDB(DSN, USER, PASSWORD);
?>
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
		$db = new MyDB(DSN, USER, PASSWORD);
		$row = $db->getAllScores();
		$x = 0;
		foreach($row as $value){
			?><tr>
				<td><?php echo $row[$x]['student_num']; ?></td>
				<td><?php echo $row[$x]['fname']; ?></td>
				<td><?php echo $row[$x]['lname']; ?></td>
				<td><?php echo $row[$x]['class_num']; ?></td>
				<td><?php echo $row[$x]['legal_test_score']; ?></td>
				<td><?php echo $row[$x]['safety_test_score']; ?></td>
				<td><?php echo $row[$x]['combined_score']; ?></td>
				<td><?php echo $row[$x]['target_hits']; ?></td>
				<td><?php echo $row[$x]['pass_fail']; ?></td>
			</tr>
			<?php
			$x += 1;
		}
		?>
	</tbody>
</table>