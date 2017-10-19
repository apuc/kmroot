$(document).ready(function () {
	$(document).on('click', '#films', function () {
		event.preventDefault();
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
	$(document).on('click', '#theatre', function () {
		event.preventDefault();
			$('#block_index_afisha').show();
			$('#result').hide();
		});

	$(document).on('click', '#film', function () {
		event.preventDefault();
		var id = $(this).data('id');
		var name = $(this).data('name');
		$.ajax({
			url: "?handler=get_film",
			type: "get",
			data: {id:id, name:name},
			success: function(data) {
				console.log(data);
				$('#result').html(data);
				$('#block_index_afisha').hide();
				$('#result').show();
			}
		});
		return false;
	});
});