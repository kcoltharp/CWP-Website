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
<ul class="studentsDataList">
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

		<li>
			Class Number: <?php echo $row[0]['class_num'] ?>
		</li>
		<li>
			Student Number: <?php echo $row[0]['student_num'] ?>
		</li>
		<li>
			Name: <?php echo $row2[0]['fname'] . " " . $row2[0]['lname'] ?>
		</li>
		<li>
			Legal Test Score: <?php echo $row[0]['legal_test_score'] ?>
		</li>
		<li>
			Safety Test Score: <?php echo $row[0]['safety_test_score'] ?>
		</li>
		<li>
			Final Test Score: <?php echo $row[0]['combined_score'] ?>
		</li>
		<li>
			Target Score: <?php echo $row[0]['target_hits'] ?>
		</li>
		<li>
			Class Pass/Fail: <?php echo $row[0]['pass_fail'] ?>
		</li>
	</ul>
	<?php
}
require_once '../includes/overall/footer.php';
?>