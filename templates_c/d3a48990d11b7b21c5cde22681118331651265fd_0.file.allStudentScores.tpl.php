<?php
/* Smarty version 3.1.29, created on 2016-06-10 17:33:21
  from "C:\xampp\htdocs\cwp-test\smarty\templates\allStudentScores.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_575b32215c0857_08258233',
  'file_dependency' => 
  array (
    'd3a48990d11b7b21c5cde22681118331651265fd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cwp-test\\smarty\\templates\\allStudentScores.tpl',
      1 => 1465594393,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_575b32215c0857_08258233 ($_smarty_tpl) {
?>
<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>

<div class="container">
	<table border = "1" cellspacing = "3" cellpadding = "2">
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
$_from = $_smarty_tpl->tpl_vars['res']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$__foreach_s_0_saved_item = isset($_smarty_tpl->tpl_vars['s']) ? $_smarty_tpl->tpl_vars['s'] : false;
$_smarty_tpl->tpl_vars['s'] = new Smarty_Variable();
$_smarty_tpl->tpl_vars['s']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['s']->value) {
$_smarty_tpl->tpl_vars['s']->_loop = true;
$__foreach_s_0_saved_local_item = $_smarty_tpl->tpl_vars['s'];
?>
				<tr>
					<td>$s.student_num</td>
					<td>$s.fname</td>
					<td>$s.lname</td>
					<td>$s.class_num</td>
					<td>$s.legal_test_score</td>
					<td>$s.safety_test_score</td>
					<td>$s.combined_score</td>
					<td>$s.target_hits</td>
					<td>$s.pass_fail</td>
				</tr>
			<?php
$_smarty_tpl->tpl_vars['s'] = $__foreach_s_0_saved_local_item;
}
if (!$_smarty_tpl->tpl_vars['s']->_loop) {
?>
				<tr>
					<td>No Results . . .</td>
				</tr>
			<?php
}
if ($__foreach_s_0_saved_item) {
$_smarty_tpl->tpl_vars['s'] = $__foreach_s_0_saved_item;
}
?>
		</tbody>
	</table>
</div><?php }
}
