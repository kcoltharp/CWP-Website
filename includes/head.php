<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<title>SC CWP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="en-US" />
	<meta http-equiv="Cache-Control" content="no-cache" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="SC CWP, South Carolina Concealed, Concealed,South Carolina Weapon, Weapon,South Carolina Permit, Permit, Concealed Permit, Concealed Weapon, Concealed Weapon Permit, South Carolina CWP, South Carolina Concealed Weapon Permit" />

	<!-- CDN Requests for jQuery (required for bootstrap) and jQuery Validate Plugin -->
	<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
	<script src="js/main.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Google Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.css"rel="stylesheet" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Faster+One' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="http://localhost/cwp-test/images/favicon.ico" type="image/x-icon"/>

	<link rel="stylesheet" href="styles/main.css">
	<link rel="stylesheet" href="styles/screen.css">
	<script type="text/javascript">
		var clockID = 0;
		function UpdateClock(){
			if(clockID){
				clearTimeout(clockID);
				clockID = 0;
			}
			var tDate = new Date();
			document.theClock.theTime.value = ""
				+ tDate.getHours() + ":"
				+ tDate.getMinutes() + ":"
				+ tDate.getSeconds();
			clockID = setTimeout("UpdateClock()", 1000);
		}

		function StartClock(){
			clockID = setTimeout("UpdateClock()", 500);
		}

		function KillClock(){
			if(clockID){
				clearTimeout(clockID);
				clockID = 0;
			}
		}
		$(document).ready(function(){
			// Making 2 variable month and day
			var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
			var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

			// make single object
			var newDate = new Date();
			// make current time
			newDate.setDate(newDate.getDate());
			// setting date and time
			$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

			setInterval(function(){
				// Create a newDate() object and extract the seconds of the current time on the visitor's
				var seconds = new Date().getSeconds();
				// Add a leading zero to seconds value
				$("#sec").html((seconds < 10 ? "0" : "") + seconds);
			}, 1000);

			setInterval(function(){
				// Create a newDate() object and extract the minutes of the current time on the visitor's
				var minutes = new Date().getMinutes();
				// Add a leading zero to the minutes value
				$("#min").html((minutes < 10 ? "0" : "") + minutes);
			}, 1000);

			setInterval(function(){
				// Create a newDate() object and extract the hours of the current time on the visitor's
				var hours = new Date().getHours();
				// Add a leading zero to the hours value
				$("#hours").html((hours < 10 ? "0" : "") + hours);
			}, 1000);
		});
	</script>
</head>