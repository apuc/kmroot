function upToView(idFilm) {
	event.preventDefault();
	$.ajax({
		url: "?handler=upToView",
		type: "post",
		data: {id:idFilm},
		success: function(response) {
			/*$('#result').html(response);*/
		}
	});
	return false;
};