<?php

require_once 'init.php';
require_once 'smarty/configs/blog_config.php';
require_once 'smarty/templates/blog_edit.tpl';

if(isset($_REQUEST['submit'])){
	$content = $_REQUEST['content'];
	$teaser = substr($content, 0, 80);
	$title = $_REQUEST['title'];
	$category = $_REQUEST['category'];

	$db = new Database(dsn, user, pwd);
	$id = $db->newBlogEntry($db, $title, $content, $category, $teaser);
	echo '<META http-equiv="refresh" content="4;URL=blog_display.php$ID=$id">';
} else{
	$smarty = new Smarty();
	$smarty->assign("title", "blog: post an entry");
	//$smarty->display("smarty/templates/blog_edit.tpl");
}
require_once 'includes/overall/footer.php';
