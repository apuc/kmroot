$(document).ready(function () {
	$(document).on('click', '#films', function () {
		event.preventDefault();
		progressLoad('start');
		$.ajax({
			url: "?handler=get",
			type: "get",
			success: function(response) {
				$('#result').html(response);
				$('#block_index_afisha').hide();
				$('#result').show();
				progressLoad('end');

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
		progressLoad('start');
		$.ajax({
			url: "?handler=get_film",
			type: "get",
			data: {id:id, name:name},
			success: function(data) {
				$('#result').html(data);
				$('#block_index_afisha').hide();
				$('#result').show();
				progressLoad('end');
			}
		});
		return false;
	});
	function progressLoad(key) {
		if(key === 'start'){
			$('.overlay-ajax-load').fadeIn(300);
		}
		if(key === 'end'){
			$('.overlay-ajax-load').fadeOut(300);
		}

	}
});