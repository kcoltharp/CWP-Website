<?php
require('php/pages/header.php');
?>
<form id="app_info" method="post" action="">
	<h3 class = "required">
		The following general guidelines apply to all classes. We’ll e-mail you additional information such as the class date, time,
		and anything else you need to know for a specific class. You’re always welcome to e-mail me if you have questions at
		kcoltharp@gmail.com. Please put SC Concealed Weapons Permit Class in the subject line.<br><br>
	</h3>
	<ol id = "app_info">
		<li>
			<b class = "required">Class.</b> Bring bottled water so you can stay hydrated. Always bring your driver’s license to class: you’ll need it.<br><br>
		</li>
		<li>
			<b class = "required">Safety.</b>Safety is the foremost concern. Guns, ammunition, and shooting are potentially dangerous. Don’t bring firearms or
			ammunition into the classroom. Any gun you bring to the range must be safe, unloaded, and either cased or holstered
			when you arrive. I’ll tell you when to holster up. I review the basic rules of firearms safety at the beginning of every class.
			Follow them at all times.<br><br>
		</li>
		<li>
			<b class = "required">Firearms.</b>Your gun must be safe, unmodified, and perfectly functioning. I’m not a gunsmith and can’t check each gun
			but I won’t allow one that seems unsafe, nor can I repair malfunctioning guns. I recommend you bring the self-defense
			firearm you intend to use when you leave the course. If you do not have a pistol, I can loan one to you. If I loan a pistol to you, you must buy
			the ammunition for it from me. If you need to borrow a pistol, make sure to select "Rent from Instructor" in the Gun Type on the application.<br><br>
		</li>
		<li>
			<b class = "required">Ammunition.</b>Bring at least 50 rounds of fresh factory ammunition for your gun, no hand loads or reloads. More is better.
			Ammunition must be in the factory boxes just as you bought it. Don’t mix or repack ammunition. These are safety
			issues.<br><br>
		</li>
		<li>
			<b class = "required">Clothing.</b>Dress appropriately for the day’s weather and a sandy outdoors environment. Men and women both should
			wear pants with belt loops and pockets for spare ammunition, socks, sneakers or boots. These are safety issues.<br><br>
		</li>
		<li>
			<b class = "required">Holster, Belt, Sling.</b>Bring a quality belt and belt holster for your handgun. Make sure both fit before class. The belt must fit
			you, the holster, and the pant loops, and be sturdy enough to support the gun without flopping or sagging. If I lend you a gun
			I’ll lend you a holster but I can’t lend you a belt. You’ll want a sturdy belt that is 1-1/2” wide. These are safety issues.<br><br>
		</li>
		<li>
			<b class = "required">Equipment.</b>Bring paper and a writing utensil to take notes. If you bring a pencil, there is no pencil sharpener in
			the classroom, so bring your own and/or several sharpened pencils. Bring hearing protection for use on the range.
			Always wear them when anyone is shooting on the range. Everyone shooting a firearm must own ear protection. Use
			them or you could suffer permanent physical damage. You’re responsible for your own safety.<br><br>
		</li>
		<li>
			<b class = "required">Special Needs.</b>If you have any special needs wether they are physical, medical, or any other condition please let us know in writing on
			your application. We can’t help what we don’t know, and we want you safe.<br><br>
		</li>
		<li>
			<b class = "required">Standards.</b> You must pass two written tests from SLED and the required shooting test on the range. You also must
			demonstrate practical proficiency and firearm safety. I want you to pass and will try to help you but students who do not
			follow instructions or who handle firearms or ammunition in an unsafe manner may be dismissed. We do not make up the test or the requirement
			for your shooting proficiency test, SLED makes up all the tests and requirements for the CWP. We as instructors are tasked to follow these
			requirements.<br><br>
		</li>
		<li>
			<b class = "required">Release of Liability and Assumption of the Risk.</b> Admission to the class requires you sign “Liability Release and
			Assumption of the Risk Agreement” at the beginning of class.<br><br>
		</li>
	</ol>
	<input type = "button" value = "I Disagree" id = "disagree">
	<input type = "button" onclick = "goTo()" value = "I Agree" id = "agree">
</form>
<?php
require('php/pages/footer.php');
?>
