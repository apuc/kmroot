$(document).ready(function () {
	$(document).on('click', '#series', function () {
		event.preventDefault();
		progressLoad('start');
		$.ajax({
			url: "?handler=getSeries",
			type: "get",
			success: function(response) {
				$('#result').html(response);
				$('#block_index_reviews').hide();
				$('#films_block').hide();
				$('#result').show();
				progressLoad('end');
			}
		});
		return false;
	});

	$(document).on('click', '.selectListType li a', function (e) {
		// console.log('test');
		var list = $(this).parent();
		$('.selectListType li').each(function () {
			$(this).removeClass('slta');
		});
		list.addClass('slta');
	});

	$(document).on('click', '#films', function () {
		event.preventDefault();
		progressLoad('start');
		$.ajax({
			url: "?handler=getFilms",
			type: "get",
			success: function(response) {
				$('#result').html(response);
				$('#block_index_reviews').hide();
				$('#series_block').hide();
				$('#films_block').show();

				progressLoad('end');
			}
		});
		return false;
	});

	function progressLoad(key) {
		if(key === 'start'){
			$('.overlay-ajax-load').fadeIn(100);
		}
		if(key === 'end'){
			$('.overlay-ajax-load').fadeOut(100);
		}
	}
});