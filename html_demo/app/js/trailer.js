$(document).ready(function () {
	$(document).on('click', '#play_video', function () {
		alert('hello');
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