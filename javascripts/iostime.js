$(document).ready(function() {

	//timepicker ios
	if (navigator.userAgent.match(/(iPhone|iPod|iPad)/i)) {
		var iso = $("#timedate").val();
		var newDate = new Date(iso);
		var date = [("0" + newDate.getDate()).slice(-2), ("0" + (newDate.getMonth() + 1)).slice(-2), newDate.getFullYear()].join('/');
		var time = [newDate.getHours(), newDate.getMinutes()].join(':');
		// alert(date);
		// alert(time);
		$("#timedate").val(date + ' ' + time);
	}

});