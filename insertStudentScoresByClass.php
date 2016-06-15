<?php
require_once 'init.php';
$db = new MyDB(DSN, USER, PASSWORD);

if((isset($_POST['legalScore'])) && (($_POST['legalScore']) != '')){
	$row = $db->updateScores($_POST);
	echo $row . ' rows were updated.';
} elseif((empty($_POST['classNum'])) || (($_POST['classNum']) == '') || (($_POST['classNum']) == NULL)){
	?>
	<form action="" method="post">
		<label for="classNum">Enter the class you want to edit</label>
		<input type="text" name="classNum" />
		<input type="submit" value="Submit" />
	</form>
	<?php
} else{
	$classNum = $_POST['classNum'];
	$res = $db->prepare("SELECT
		a.student_num, a.fname, a.lname, b.class_num,
		b.legal_test_score, b.safety_test_score, b.combined_score,
		b.target_hits, b.pass_fail
	FROM students a, scores b
	WHERE b.class_num = $classNum");

	$res->bindColumn('b.classnum', $classNum);
	$res->execute();
	$array = $res->fetchAll(PDO::FETCH_ASSOC);
	$_POST = array();
	?>

	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
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
				<?php foreach($array as $row): ?>
					<tr>
						<td>
							<?php echo $row['student_num']; ?>
							<input type="hidden" name="student_num" value="<?php $row['student_num']; ?>"
						</td>
						<td><?php echo $row['fname']; ?></td>
						<td><?php echo $row['lname']; ?></td>
						<td><?php echo $row['class_num']; ?></td>
						<td><?php
							if($row['legal_test_score'] != '' && $row['legal_test_score'] != NULL){
								echo $row['legal_test_score'];
							} else{
								?>
								<input type="numaber" name="legalScore" min="0" max="50"/>
							<?php } ?>
						</td>
						<td><?php
							if($row['safety_test_score'] != '' && $row['safety_test_score'] != NULL){
								echo $row['safety_test_score'];
							} else{
								?>
								<input type="numaber" name="safetyScore" min="0" max="50"/>
							<?php } ?>
						</td>
						<td><?php
							if($row['combined_score'] != '' && $row['combined_score'] != NULL){
								echo $row['combined_score'];
							} else{
								?>
								<input type="numaber" name="combinedScore" min="0" max="100"/>
							<?php } ?>
						</td>
						<td><?php
							if($row['target_hits'] != '' && $row['target_hits'] != NULL){
								echo $row['target_hits'];
							} else{
								?>
								<input type="numaber" name="targetHits" min="0" max="50"/>
							<?php } ?>
						</td>
						<td><?php
							if($row['pass_fail'] != '' && $row['pass_fail'] != NULL){
								echo $row['pass_fail'];
							} else{
								?>
								<input list="pass_fail">
								<datalist id="pass_fail">
									<option value="Pass">Pass</option>
									<option value="Fail">Fail</option>
								</datalist>
							<?php } ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<input type="submit" value="Submit Changes"/>
	</form>
	<?php
}
require_once 'includes/overall/footer.php';
?>