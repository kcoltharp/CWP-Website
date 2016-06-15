<?php
/* Smarty version 3.1.29, created on 2016-06-15 10:31:29
  from "C:\xampp\htdocs\cwp-test\smarty\templates\table.tpl" */

if ($_smarty_tpl->smarty->ext->_validateCompiled->decodeProperties($_smarty_tpl, array (
  'has_nocache_code' => false,
  'version' => '3.1.29',
  'unifunc' => 'content_576166c15fdeb0_13153755',
  'file_dependency' => 
  array (
    'b76df2bd6a1cffc95d7876309759f7bc49726c41' => 
    array (
      0 => 'C:\\xampp\\htdocs\\cwp-test\\smarty\\templates\\table.tpl',
      1 => 1466001084,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_576166c15fdeb0_13153755 ($_smarty_tpl) {
if (!is_callable('smarty_function_html_table')) require_once 'C:\\xampp\\htdocs\\cwp-test\\smarty\\plugins\\function.html_table.php';
?>
<!--

<?php echo smarty_function_html_table(array('loop'=>$_smarty_tpl->tpl_vars['data']->value),$_smarty_tpl);?>


<table border="1">
<tbody>
<tr><td>1</td><td>2</td><td>3</td></tr>
<tr><td>4</td><td>5</td><td>6</td></tr>
<tr><td>7</td><td>8</td><td>9</td></tr>
</tbody>
</table>



<?php echo smarty_function_html_table(array('loop'=>$_smarty_tpl->tpl_vars['data']->value,'cols'=>4,'table_attr'=>'border="0"'),$_smarty_tpl);?>


<table border="0">
<tbody>
<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>
<tr><td>5</td><td>6</td><td>7</td><td>8</td></tr>
<tr><td>9</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody>
</table>
-->


<?php echo smarty_function_html_table(array('table_attr'=>'border="4" color="blue" cellpadding="10px" cellspacing="5px" align="center"','loop'=>$_smarty_tpl->tpl_vars['data']->value,'cols'=>$_smarty_tpl->tpl_vars['cols']->value,'tr_attr'=>$_smarty_tpl->tpl_vars['tr']->value),$_smarty_tpl);?>

<!--
<table>
	<thead>
		<tr>
			<th>first</th><th>second</th><th>third</th><th>fourth</th>
		</tr>
	</thead>
	<tbody>
		<tr bgcolor="#eeeeee"><td>1</td><td>2</td><td>3</td><td>4</td></tr>
		<tr bgcolor="#dddddd"><td>5</td><td>6</td><td>7</td><td>8</td></tr>
		<tr bgcolor="#eeeeee"><td>9</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	</tbody>
</table>
--><?php }
}
