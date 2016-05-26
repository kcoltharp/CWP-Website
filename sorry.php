<?php
require('php/pages/header.php');
?>

We are sorry that you have decided not to use us as your instructors for the concealed weapons permit. Please tell us what we could do to get you in our class. Below is an area to send us your comments, which are completely anonymous.<br /><br />

<form id="comments" action="php/functions/postComments.php" method="post">

		<label for="subject">Subject:</label>
		<input type="text" id="subject" name="subject" placeholder="Comments Subject"><br /><br />
		<label for="comment">Comments:</label>
		<textarea rows="4" cols="50" id="comment" name="comment" placeholder="None"></textarea>
		<input type="submit" value="Submit Comments">
</form>
<?php
require('php/pages/footer.php');
?>