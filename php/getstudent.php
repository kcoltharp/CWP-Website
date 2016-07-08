<?php
$q = intval($_GET['q']);
require_once 'functions/geoPlugin.php';
require_once 'functions/XIP.php';
require_once 'functions/class.MyDB.php';
define('DSN', 'mysql:dbname=sccwp;host=127.0.0.1;charset=utf8', false);
define('USER', 'kenny', false);
define('PASSWORD', 'kc226975', false);

$db = new MyDB(DSN, USER, PASSWORD);
?>
<?php
$stmt = $db->prepare("SELECT * FROM scores WHERE student_num = :studentNumber");
$stmt->bindParam(":studentNumber", $q, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare("SELECT fname, lname FROM students WHERE student_num = :studentNumber");
$stmt2->bindParam(":studentNumber", $q, PDO::PARAM_INT);
$stmt2->execute();
$row2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
if(empty($row)){
	if(empty($row2)){
		?>
		<li style="font-family: arial; font-weight: bolder; color: red;">
			There is no data for this student.
		</li>
		<?php
	}
} else{
	?>
	<table class="studentsDataList" style="list-style: none; font-family: arial; ">
		<colgroup>
			<col span="2" style="background-color: #DC0BE3; color: #12e20b; ">
			<col span="2" style="background-color: #0b7ee3; color: #0B7EE3;">
		</colgroup>
		<tr>
			<td></td>
			<td colspan="2">Name:</td>
			<td colspan="2"><?php echo $row2[0]['fname'] . " " . $row2[0]['lname'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Class Number:</td>
			<td><?php echo $row[0]['class_num'] ?></td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Student Number:</td>
			<td colspan="2"><?php echo $row[0]['student_num'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Legal Test Score:</td>
			<td colspan="2"><?php echo $row[0]['legal_test_score'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Safety Test Score:</td>
			<td colspan="2"><?php echo $row[0]['safety_test_score'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Final Test Score:</td>
			<td colspan="2"><?php echo $row[0]['combined_score'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Target Score:</td>
			<td colspan="2"><?php echo $row[0]['target_hits'] ?></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="2">Class Pass/Fail:</td>
			<td colspan="2"><?php echo $row[0]['pass_fail'] ?></td>
			<td></td>
		</tr>
	</table>
	<?php
}
?>