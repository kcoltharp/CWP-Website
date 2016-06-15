<!--
{**** Example One ****}
{html_table loop=$data}

<table border="1">
<tbody>
<tr><td>1</td><td>2</td><td>3</td></tr>
<tr><td>4</td><td>5</td><td>6</td></tr>
<tr><td>7</td><td>8</td><td>9</td></tr>
</tbody>
</table>


{**** Example Two ****}
{html_table loop=$data cols=4 table_attr='border="0"'}

<table border="0">
<tbody>
<tr><td>1</td><td>2</td><td>3</td><td>4</td></tr>
<tr><td>5</td><td>6</td><td>7</td><td>8</td></tr>
<tr><td>9</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
</tbody>
</table>
-->

{**** Example Three ****}
{html_table table_attr='border="4" color="blue" cellpadding="10px" cellspacing="5px" align="center"' loop=$data cols=$cols tr_attr=$tr}
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
-->