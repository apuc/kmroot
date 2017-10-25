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

	$(document).on('click', '.selectListType li a', function (e) {
		console.log('test');
		var list = $(this).parent();
		$('.selectListType li').each(function () {
			$(this).removeClass('slta');
        });
		list.addClass('slta');
    });

	$(document).on('click', '#theatre', function () {
		event.preventDefault();
			$('#block_index_afisha').show();
			$('#result').hide();
		});

	$(document).on('click', '#film', function () {
		var id = $(this).data('id');
		progressLoad('start');
		$.ajax({
			url: "?handler=get_film",
			type: "get",
			data: {id:id},
			success: function(data) {
				$('#result').html(data);
				$('#block_index_afisha').hide();
				$('#result').show();
				progressLoad('end');
			}
		});
		return false;
	});

	$(document).on('click', '.showSession', function (e) {
		e.preventDefault();
		var objId = $(this).attr('data-obj-id');
		var filmId = $(this).attr('data-film-id');
		if($(this).attr('data-date')) {
			var date = $(this).attr('data-date');
		} else {
			var date = '';
		}
		$.ajax({
            url: "?handler=get_sessions",
            type: "get",
            data: {objId:objId, filmId:filmId, date:date},
            success: function(data) {
                $('#cinema-' + objId).html(data);
                console.log($('#cinema-' + objId).html(data));
            }
        });
        return false;
    });

	$(document).on('click', '#film_sessions', function (e) {
		e.preventDefault();
		var id = $(this).attr('data-id');
		var date = $(this).attr('data-date');
		progressLoad('start');
		$.ajax({
			url: "?handler=getFilmByDate",
			type: "get",
			data: {id:id, date:date},
			success: function(data) {
				$('#result').html(data);
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