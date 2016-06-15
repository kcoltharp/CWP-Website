<?php
require_once 'init.php';

$db = new Database(dsn, user, pwd);
if((isset($_POST['studentNum'])) && (!empty($_POST['studentNum']))){
	$query = "SELECT *"
		. "FROM scores"
		. "WHERE scores.student_num = :student_num";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":student_num", $_POST['studentNum']);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if(($rows['legal_test_score'] == NULL) || ($rows['legal_test_score'])){
		$rows['legal_test_score'] = "<label for='legalScore'>Legal Test Score: </label><input type='text' name='legalScore' />";
	}
	if(($rows['combined_score'] == NULL) || ($rows['combined_score'])){
		$rows['combined_score'] = "<label for='combinedScore'>Combined Test Score: </label><input type='text' name='combinedScore' />";
	}
	if(($rows['safety_test_score'] == NULL) || ($rows['safety_test_score'])){
		$rows['safety_test_score'] = "<label for='safetyScore'>Safety Test Score: </label><input type='text' name='safetyScore' />";
	}
	if(($rows['target_hits'] == NULL) || ($rows['target_hits'])){
		$rows['target_hits'] = "<label for='target_hits'>Target Hits: </label><input type='text' name='target_hits' />";
	}
	if(($rows['pass_fail'] == NULL) || ($rows['pass_fail'])){
		$rows['pass_fail'] = "<label for='pass_fail'>Pass/Fail: </label><input type='text' name='pass_fail' />";
	}
	$smarty->assign('data', $rows);
	$smarty->assign('cols', "Student Number, Class Number, Legal Test Score, Safety Test Score, Combined Score, Target Hits, Pass/Fail");
	$smarty->assign('tr', array('bgcolor="#eeeeee"', 'bgcolor="#dddddd"'));
	$smarty->display('smarty/templates/table.tpl');
} elseif((isset($_POST['classNum'])) && (!empty($_POST['classNum']))){
	$query = "SELECT *"
		. "FROM scores"
		. "WHERE scores.class_num = :class_num";
	$stmt = $db->prepare($query);
	$stmt->bindParam(":class_num", $_POST['classNum']);
	$stmt->execute();
	$rows = $stmt->fetchAll();
	if(($rows['legal_test_score'] == NULL) || ($rows['legal_test_score'])){
		$rows['legal_test_score'] = "<label for='legalScore'>Legal Test Score: </label><input type='text' name='legalScore' />";
	}
	if(($rows['combined_score'] == NULL) || ($rows['combined_score'])){
		$rows['combined_score'] = "<label for='combinedScore'>Combined Test Score: </label><input type='text' name='combinedScore' />";
	}
	if(($rows['safety_test_score'] == NULL) || ($rows['safety_test_score'])){
		$rows['safety_test_score'] = "<label for='safetyScore'>Safety Test Score: </label><input type='text' name='safetyScore' />";
	}
	if(($rows['target_hits'] == NULL) || ($rows['target_hits'])){
		$rows['target_hits'] = "<label for='target_hits'>Target Hits: </label><input type='text' name='target_hits' />";
	}
	if(($rows['pass_fail'] == NULL) || ($rows['pass_fail'])){
		$rows['pass_fail'] = "<label for='pass_fail'>Pass/Fail: </label><input type='text' name='pass_fail' />";
	}
	$smarty->assign('data', $rows);
	$smarty->assign('cols', "Student Number, Class Number, Legal Test Score, Safety Test Score, Combined Score, Target Hits, Pass/Fail");
	$smarty->assign('tr', array('bgcolor="#eeeeee"', 'bgcolor="#dddddd"'));
	$smarty->display('smarty/templates/table.tpl');
} else{
	?>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="studentNum">Student Number:&nbsp;&nbsp;</label>
		<input type="text" name="studentNum"/><br><br>
		<label for="classNum">&nbsp;&nbsp;&nbsp;&nbsp;Class Number:&nbsp;&nbsp;</label>
		<input type="text" name="classNum"/><br><br>
		<input id="button" type="button" name="submit" value="Submit" /><br><br>
	</form>
	<?php
}


require_once 'includes/overall/footer.php';
?>