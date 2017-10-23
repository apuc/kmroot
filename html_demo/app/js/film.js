$(document).ready(function () {
	$(document).on('click', '#infilm', function () {
		var name = $(this).data('name');
		progressLoad('start');
		$.ajax({
			url: "/film?handler=get_film",
			type: "get",
			data: {name:name},
			success: function(data) {
				if($('#result').html(data)){
					$('#result').html(data);
					$('#none').hide();
					progressLoad('end');
				} else {
					$('#none').show();
				}
			}
		});
		return false;
	});

	$(document).on('click', '.showSession', function (e) {
		e.preventDefault();
		var objId = $(this).attr('data-obj-id');
		var filmId = $(this).attr('data-film-id');
        $.ajax({
            url: "/film?handler=get_sessions",
            type: "get",
            data: {objId:objId, filmId:filmId},
            success: function(data) {
                $('#cinema-' + objId).html(data);
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