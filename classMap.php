<?php
require('php/pages/header.php');
?>
<div id="container">
	<div class="mapDesc">
		The South Carolina Concealed Weapons Permit Class is held at the Maryville Social Hall, 2009 South Fraser Street, Georgetown, SC 29440.
	</div>
</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3333.0623445544916!2d-79.298082!3d33.343321!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd5ca333b4c9b20e6!2sMaryville+Social+Hall!5e0!3m2!1sen!2sus!4v1460747638641" allowfullscreen></iframe>

<!--
<div id="map"></div>
<script>
	function initMap(){
		var myLatLng = {
			lat: 33.345551, lng: -79.296849
		};
		var map = new google.maps.Map(document.getElementById('map'), {
			zoom: 17,
			center: myLatLng
		});

		var marker = new google.maps.Marker({
			position: myLatLng,
			map: map,
			title: 'SC Concealed Weapons Permit Class'
		});
	}
</script>
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer></script>
-->
<?php
require('php/pages/footer.php');
?>
