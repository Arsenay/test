function initMap() {
	var 
		myLatLng = {lat: 48.5, lng: 31},
		lats = [],
		lngs = [];

	if (markers.length > 0) {
		markers.forEach(function(marker) {
			lats.push(marker.lat); 
			lngs.push(marker.lng);
		});
		var average_lat = ( Math.max.apply(Math, lats) + Math.min.apply(Math, lats) ) / 2;
		var average_lng = ( Math.max.apply(Math, lngs) + Math.min.apply(Math, lngs) ) / 2;
		myLatLng = {lat: average_lat, lng: average_lng};
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