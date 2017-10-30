$(document).ready(function () {
	$(document).on('click', '.trailer__play-icon', function () {
		alert('hello');
		console.log('hello');
		return false;
		event.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			url: "?handler=upToView",
			type: "get",
			data: {id:id},
			success: function(response) {
				$('#result').html(response);
				console.log(response);
			}
		});
		return false;
	});

});