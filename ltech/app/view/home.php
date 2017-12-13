<!DOCTYPE html>
<html>
	<head>
		<title>Place Autocomplete</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<link rel="stylesheet" href="app/view/css/common.css">
	</head>
	<body>
		<input id="pac-input" class="controls" type="text" placeholder="Enter a location" onkeyup="setValues();">
		<form action="?controller=marker&method=add" method="POST">
			<input id="name" type="hidden" name="name" value="">
			<input id="lat" type="hidden" name="lat" value="">
			<input id="lng" type="hidden" name="lng" value="">
			<button type="submit">Send</button>
		</form>
		<div id="map"></div>
		<script src="app/view/js/home.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5OTVAg_7zce_vXAH_5yuyacEUwMDxqGE&libraries=places&callback=initMap" async defer></script>
	</body>
</html>