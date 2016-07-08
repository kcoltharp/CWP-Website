<?php
require_once 'init.php';

if((isset($_POST['posted'])) && ($_POST['posted'] == 'true')){
	$sinup = array(
		'fname' => $_POST['fname'],
		'lname' => $_POST['lname'],
		'sex' => $_POST['sex'],
		'dob' => $_POST['dob'],
		'address' => $_POST['address'],
		'address2' => $_POST['address2'],
		'city' => $_POST['city'],
		'state' => $_POST['state'],
		'zip' => $_POST['zip'],
		'SCresident' => $_POST['SCresident'],
		'disablevet' => $_POST['disablevet'],
		'guntype' => $_POST['guntype'],
		'gunmake' => $_POST['gunmake'],
		'gunmodel' => $_POST['gunmodel'],
		'guncaliber' => $_POST['guncaliber'],
		'experience' => $_POST['experience'],
		'disabilities' => $_POST['disabilities'],
		'hphone' => $_POST['hphone'],
		'email' => $_POST['email'],
		'email2' => $_POST['email2'],
		'driverlic' => $_POST['driverlic'],
		'dlstate' => $_POST['dlstate'],
		'nranum' => $_POST['nranum'],
		'nraexpire' => $_POST['nraexpire'],
		'emergencyname' => $_POST['emergencyname'],
		'emergencyrelation' => $_POST['emergencyrelation'],
		'emergencyaddress' => $_POST['emergencyaddress'],
		'emergencyaddress2' => $_POST['emergencyaddress2'],
		'emergencycity' => $_POST['emergencycity'],
		'emergencystate' => $_POST['emergencystate'],
		'emergencyzip' => $_POST['emergencyzip'],
		'emergencyhphone' => $_POST['emergencyhphone'],
		'emergencycell' => $_POST['emergencycell'],
		'emergencywork' => $_POST['emergencywork'],
		'submissionDate' => 'CURRENT_DATE()',
		'submissionTime' => 'CURRENT_TIME()'
	);
} else{
	?>
	<h1>SC Concealed Weapons Permit Class Application</h1>
	<div>
		<form id="signup" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
			<div id="directions">
				Required items are in <b class="required">red</b> text. If you do
				not have an
				item that is required, type "None" in the text box. When you
				submit the form, you
				will need to validate any item that has "None" in the text box.
				This will help to
				ensure mistakes do not happen. Submission of the application <b>does
					not</b> by itself
				reserve your place in the class. The <b>application and class
					fee</b> are required
				to reserve a seat in the class.<br/>
			</div>
			<br/>
			<div class="left">
				<p>
					<label class="required" for="fname">First Name: </label>
					<input type="text" id="fname" name="fname" placeholder="FirstName">
				</p>
				<p>
					<label class="required" for="lname">Last Name: </label>
					<input type="text" id="lname" name="lname" placeholder="LastName">
				</p>
				<p>
					<label class="required" for="sex">Sex: </label>
					<select name="sex" id="sex">
						<option value="Make Selection">Make Selection</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
					</select>
				</p>
				<p>
					<label class="required" for="dob">Date of Birth: </label>
					<input type="date" id="dob" name="dob" placeholder="01/01/1970">
				</p>
				<p>
					<label class="required" for="haddress">Home Address: </label>
					<input type="text" id="haddress" name="haddress" placeholder="123 Front Street">
				</p>
				<p>
					<label class="required" for="haddress2">Home	Address2: </label>
					<input type="text" id="haddress2" name="haddress2" placeholder="Apt or PO Box">
				</p>
				<p>
					<label class="required" for="city">City: </label>
					<input type="text" id="city" name="city" placeholder="Georgetown">
				</p>
				<p>
					<label class="required" for="state">State: </label>
					<input type="text" id="state" name="state" placeholder="South Carolina">
				</p>
				<p>
					<label class="required" for="zip">Zip Code: </label>
					<input type="text" id="zip" name="zip" placeholder="29440">
				</p>
				<p>
					<label class="required" for="SCresident">SC Resident: </label>
					<select name="SCresident" id="SCresident">
						<option value="Make Selection">Make Selection</option>
						<option value="True">Yes</option>
						<option value="False">No</option>
					</select>
				</p>
				<p>
					<label for="disablevet">Disabled Veteran: </label>
					<select name="disablevet" id="disablevet">
						<option value="Make Selection">Make Selection</option>
						<option value="True">Yes</option>
						<option value="False">No</option>
					</select>
				</p>
				<p>
					<label class="required" for="experience">Describe prior firearm,<br/>military, and/or law<br/>enforcement experience<br/>Enter "None" if none:</label>
					<textarea rows="4" cols="50" id="experience"	name="experience" placeholder="None"></textarea>
				</p>
				<p>
					<label class="required" for="disabilities">Describe any disabilities<br/>and/or special needs.<br/>Enter "None" if none:</label>
					<textarea rows="4" cols="50" id="disabilities" name="disabilities" placeholder="None"></textarea>
				</p>
			</div>
			<div class="right">
				<p>
					<label class="required" for="guntype">Type of Gun: </label>
					<select name="guntype" id="guntype">
						<option value="Make Selection">Make Selection</option>
						<option value="Revolver">Revolver</option>
						<option value="Semi-Automatic">Semi-Automatic</option>
						<option value="Rent">Rent From Instructor</option>
					</select>
				</p>
				<p>
					<label for="gunmake">Gun Make: </label>
					<input type="text" id="gunmake" name="gunmake" placeholder="Glock">
				</p>
				<p>
					<label for="gunmodel">Gun Model: </label>
					<input type="text" id="gunmodel" name="gunmodel" placeholder="G43">
				</p>
				<p>
					<label for="guncaliber">Gun Caliber: </label>
					<input type="text" id="guncaliber" name="guncaliber" placeholder="9mm">
				</p>
				<p>
					<label class="required" for="hphone">Home Phone Number: </label>
					<input type="tel" id="hphone" name="hphone" placeholder="(843) 123-4567">
				</p>
				<p>
					<label class="required" for="email">Email Address: </label>
					<input type="email" id="email" name="email" placeholder="youremail@domain.com">
				</p>
				<p>
					<label class="required" for="email2">Email Address Again: </label>
					<input type="email" id="email2" name="email2" placeholder="your email again">
				</p>
				<p>
					<label class="required" for="driverlic">Driver's License #: </label>
					<input type="text" id="driverlic" name="driverlic" placeholder="DL Number">
				</p>
				<p>
					<label class="required" for="dlstate">DL State: </label>
					<select name="dlstate" id="dlstate">
						<option value="Make Selection">Make Selection</option>
						<option value="SC">South Carolina</option>
						<option value="NC">North Carolina</option>
						<option value="GA">Georgia</option>
					</select>
				</p>
				<p>
					<label for="nranum">NRA Member #: </label>
					<input type="text" id="nranum" name="nranum" placeholder="NRA Number">
				</p>
				<p>
					<label for="nraexpire">NRA Membership Expires: </label>
					<input type="date" id="nraexpire" name="nraexpire" placeholder="01/01/1970">
				</p>
				<fieldset>
					<legend>Emergency Contact Information</legend>
					<p>
						<label class="required" for="emergencyname">Contact Name: </label>
						<input type="text" id="emergencyname" name="emergencyname" placeholder="Emergency Contact Name">
					</p>
					<p>
						<label class="required" for="emergencyrelation">Relationship: </label>
						<input type="text" id="emergencyrelation" name="emergencyrelation" placeholder="Relationship">
					</p>
					<p>
						<label class="required" for="emergencyaddress">Contact's Address: </label>
						<input type="text" id="emergencyaddress" name="emergencyaddress" placeholder="Contact's Address">
					</p>
					<p>
						<label class="required" for="emergencyaddress2">Contact's Address2: </label>
						<input type="text" id="emergencyaddress2" name="emergencyaddress2" placeholder="Contact's Apt or PO Box">
					</p>
					<p>
						<label class="required" for="emergencycity">Contact's City: </label>
						<input type="text" id="emergencycity" name="emergencycity" placeholder="Georgetown">
					</p>
					<p>
						<label class="required" for="emergencystate">Contact's State: </label>
						<input type="text" id="emergencystate" name="emergencystate" placeholder="South Carolina">
					</p>
					<p>
						<label class="required" for="emergencyzip">Contact's Zip Code: </label>
						<input type="text" id="emergencyzip" name="emergencyzip" placeholder="29440">
					</p>
					<p>
						<label class="required" for="emergencyhphone">Contact's Home Phone: </label>
						<input type="tel" id="emergencyhphone" name="emergencyhphone" placeholder="(843) 123-4567">
					</p>
					<p>
						<label class="required" for="emergencycell">Contact's Cell Phone: </label>
						<input type="tel" id="emergencycell" name="emergencycell" placeholder="(843) 123-4567">
					</p>
					<p>
						<label class="required" for="emergencywork">Contact's Work Phone: </label>
						<input type="tel" id="emergencywork" name="emergencywork" placeholder="(843) 123-4567">
					</p>
				</fieldset>
				<p>
					<label for="submit"></label>
					<input type="hidden" name="posted" value="true" />
					<input id="submit" type="submit" name="submit" value="Submit Application" />
				</p>
			</div>
		</form>
	</div>
<?php } require_once 'includes/overall/footer.php'; ?>