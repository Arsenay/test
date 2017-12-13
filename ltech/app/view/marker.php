<!DOCTYPE html>
<html>
	<head>
		<title>Place Autocomplete</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<link rel="stylesheet" href="app/view/css/common.css">
	</head>
	<body>
		<a class="home_href" href="<?php echo $home_link; ?>">Back to home page</a>
		<div id="map"></div>
		<script>markers = JSON.parse('<?php echo json_encode($markers); ?>')</script>
		<script src="app/view/js/marker.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5OTVAg_7zce_vXAH_5yuyacEUwMDxqGE&libraries=places&callback=initMap" async defer></script>
	</body>
</html>