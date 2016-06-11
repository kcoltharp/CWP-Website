<?php

require_once 'init.php';
require_once 'smarty/configs/blog_config.php';

$ID = intval($_REQUEST['ID']);

$query = "SELECT title, category, content, UNIX_TIMESTAMP(entry_time) AS entry_time FROM blog_entries WHERE ID = :id";
$db = new mySQL_Results(dsn, user, pwd);
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $ID);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$smarty->assign("title", $rows['title']);
$smarty->assign("content", $rows['content']);
$smarty->assign("category", $rows['category']);
$smarty->assign("date", date("F dS Y, h:ia"), $rows['entry_time']);
$smarty->assign("id", $ID);

/* Look up comments */
$query2 = "SELECT comment, name, UNIX_TIMESTAMP(comment_time) AS comment_time FROM blog_comments WHERE ID = :id";
$stmt2 = $db->prepare($query2);
$stmt2->bindParam(':id', $ID);
$stmt2->execute();

$comments = array();
while($rows2 = $stmt2->fetchAll(PDO::FETCH_ASSOC)){
	$comments[] = array(
		"name" => $rows2['name'],
		"comment" => $rows2['comment'],
		"time" => date("F dS Y, h:ia", $rows2['comment_time'])
	);
}
$smarty->assign("comments", $comments);

/* display page with comments */
$smarty->display("smarty/templates/blog_display.tpl");

require_once 'includes/overall/footer.php';
?>