$(document).ready(function () {
	$(document).on('click', '#play_video', function () {
		event.preventDefault();
		alert('hello');
		return false;
		$.ajax({
			url: "?handler=get",
			type: "get",
			success: function(response) {
				$('#result').html(response);
				$('#block_index_afisha').hide();
				$('#result').show();
			}
		});
		return false;
	});

});