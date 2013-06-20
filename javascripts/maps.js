$(document).ready(function() {

	var myOptions = {
		center: new google.maps.LatLng(54, -2),
		zoom: 6,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

	var addressArray = new Array($('#address1').val(), $('#address2').val());
	var geocoder = new google.maps.Geocoder();

	var markerBounds = new google.maps.LatLngBounds();

	for (var i = 0; i < addressArray.length; i++) {
		geocoder.geocode({
			'address': addressArray[i]
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location
				});
				markerBounds.extend(results[0].geometry.location);
				map.fitBounds(markerBounds);
			} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
		});
	}

	//timepicker ios
	//if (navigator.userAgent.match(/(iPhone|iPod|iPad)/i)) {
		var iso= $("#timedate").val();
		var newDate = new Date(iso);
		var date = [("0" + newDate.getDate()).slice(-2), ("0" + (newDate.getMonth() + 1)).slice(-2), newDate.getFullYear()].join('/');
		var time= [newDate.getHours(), newDate.getMinutes()].join(':');
		// alert(date);
		// alert(time);
		$("#timedate").val(date+' '+time);
	//}

});