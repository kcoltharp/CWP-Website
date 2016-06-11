
<title>{$title}</title>
<div style="margin-left: 50px;">
	<h1 style="font-family: sans-serif; font-size: 1.5em;">New Blog Entry</h1>
	<form method="post" action="blog_edit.php">
		<table style="font-family: sans-serif; font-size: 1em;" class="inputfields">
			<tr style="vertical-align: top;"><td>Title:</td><td><input name="title" type="text" /></td></tr>
			<tr style="vertical-align: top;"><td>Body:</td><td><textarea name="content" rows="15" cols="40"></textarea></td></tr>
			<tr style="vertical-align: top;"><td>Category:</td><td><input name="category" type="text" /></td></tr>
			<tr style="vertical-align: top;"><td /><td><input style="padding: 5px 10px;" name="submit" type="submit" value="Post"</td></tr>
		</table>
	</form>
</div>