$(document).ready(function () {
	$(document).on('click', '#infilm', function () {
		if($(this).attr('data-show') == 0){
            var name = $(this).data('name');
            //progressLoad('start');
            $.ajax({
                url: "/film?handler=get_film",
                type: "get",
                data: {name:name},
                success: function(data) {
                    if($('#result').html(data)){
                        $('#result').html(data);
                        $('#inFilmBox').hide();
                    } else {
                        $('#inFilmBox').show();
                    }
                    $('#infilm').attr('data-show', 1);
                }
            });
		}
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
			$('#inFilmBox').html('<img src="/app/img/design/load.gif" width="100px">');
		}
		// if(key === 'end'){
		// 	$('.overlay-ajax-load').fadeOut(300);
		// }

	}
});