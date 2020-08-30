<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
	function initialize() {
		var mapOptions = {
			zoom: 14,
			scrollwheel: false,
			center: new google.maps.LatLng(40.7127840, -74.0059410)
		};
		var map = new google.maps.Map(document.getElementById('googleMap'),
			mapOptions);
		var marker = new google.maps.Marker({
			position: map.getCenter(),
			icon: 'img/map-marker.png',
			map: map
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);				
</script>