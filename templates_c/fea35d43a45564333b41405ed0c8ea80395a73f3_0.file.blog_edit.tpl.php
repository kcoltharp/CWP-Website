<?php
/* Smarty version 3.1.29, created on 2016-06-08 04:27:19
  from "C:\xampp\htdocs\cwp-test\smarty\templates\blog_edit.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_5757d6e7aea437_24327750',
  'file_dependency' => 
  array (
    'fea35d43a45564333b41405ed0c8ea80395a73f3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cwp-test\\smarty\\templates\\blog_edit.tpl',
      1 => 1465373897,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5757d6e7aea437_24327750 ($_smarty_tpl) {
?>

<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>


<h1 style="font-family: sans-serif; font-size: 20px;">New Blog Entry</h1>
<form method="post" action="blog_edit.php">
	<table style="font-family: sans-serif; font-size: 12px;" class="inputfields">
		<tr style="vertical-align: top;"><td>Title:</td><td><input name="title" type="text" /></td></tr>
		<tr style="vertical-align: top;"><td>Body:</td><td><textarea name="content" rows="15" cols="40"></textarea></td></tr>
		<tr style="vertical-align: top;"><td>Category:</td><td><input name="category" type="text" /></td></tr>
		<tr style="vertical-align: top;"><td /><td><input name="submit" type="submit" value="Post"</td></tr>
	</table>
</form><?php }
}
