<?php
$db = [];
if( file_exists('db.php') ){
	$db = include('db.php');
}
if( isset($_POST['name']) && $_POST['name'] != '' && 
	isset($_POST['lat']) &&  $_POST['lat'] != '' && 
	isset($_POST['lng']) && $_POST['lng'] != ''
	){
	$db[] = $_POST;
	file_put_contents('db.php', '<?php return '.var_export($db, true).';');
	header('Location: ' . 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	die();
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Place Autocomplete</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<meta charset="utf-8">
		<style>
			/* Always set the map height explicitly to define the size of the div
			 * element that contains the map. */
			#map {
				height: 100%;
			}
			/* Optional: Makes the sample page fill the window. */
			html, body {
				height: 100%;
				margin: 0;
				padding: 0;
			}
			.controls {
				margin-top: 10px;
				border: 1px solid transparent;
				border-radius: 2px 0 0 2px;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				height: 32px;
				outline: none;
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
			}
		</style>
	</head>
	<body>
		<div id="map"></div>

		<script>
			function initMap() {
				var 
					markers = JSON.parse('<?php echo json_encode($db); ?>'),
					myLatLng = {lat: 48.5, lng: 31},
					lats = [],
					lngs = [];

				if (markers.length > 0) {
					markers.forEach(function(marker) {
						console.log(marker);
						lats.push(marker.lat); 
						lngs.push(marker.lng);
					});
					var average_lat = ( Math.max.apply(Math, lats) + Math.min.apply(Math, lats) ) / 2;
					var average_lng = ( Math.max.apply(Math, lngs) + Math.min.apply(Math, lngs) ) / 2;
					myLatLng = {lat: average_lat, lng: average_lng};
					console.log(lats, lngs, average_lat, average_lng);
				}

				var map = new google.maps.Map(document.getElementById('map'), {
					center: myLatLng,
					zoom: 6
				});

				if (markers.length > 0) {
					markers.forEach(function(marker) {
						var marker = new google.maps.Marker({
							position: {
								lat: +marker.lat,
								lng: +marker.lng
							},
							map: map,
							title: marker.name
						});
					});
				}
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB5OTVAg_7zce_vXAH_5yuyacEUwMDxqGE&libraries=places&callback=initMap" async defer></script>
	</body>
</html>