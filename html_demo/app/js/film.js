$(document).ready(function () {
	$(document).on('click', '#infilm', function () {
		if($(this).attr('data-show') == 0){
            var name = $(this).data('name');
            progressLoad('start');
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
	                var activeList = $('.cinemas').attr('data-date');
	                var activeButton = $('span[data-date="'+ activeList +'"]');
	                $('.film__dates .film-session').removeClass('activeBtn');
	                activeButton.addClass('activeBtn');
                    $('#infilm').attr('data-show', 1);
	                progressLoad('end');
                }
            });
		}
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
            url: "/film?handler=get_sessions",
            type: "get",
            data: {objId:objId, filmId:filmId, date:date},
            success: function(data) {
                $('#cinema-' + objId).html(data);
            }
        });
        return false;
    });

	$(document).on('click', '#film_sessions', function (e) {
		e.preventDefault();
		progressLoadSesion('start');
		var id = $(this).attr('data-id');
		var date = $(this).attr('data-date');
		var name = $(this).attr('data-name');
		$.ajax({
			url: "/film?handler=get_film",
			type: "get",
			data: {id:id, date:date, name:name},
			success: function(data) {
				$('#result').html(data);
				var activeList = $('.cinemas').attr('data-date');
				var activeButton = $('span[data-date="'+ activeList +'"]');
				$('.film__dates .film-session').removeClass('activeBtn');
				activeButton.addClass('activeBtn');
				progressLoadSesion('end');
			}
		});
		return false;
	});

	$(document).on('click', '#playVideo', function() {
		$('#playVideo').removeClass('active-win');
		$('#player').removeClass('active-player');
		document.getElementById('slotHorizontal').innerHTML = '';
	});


	function progressLoad(key) {
		if(key === 'start'){
			$('#inFilmBox').html('<img src="/app/img/design/load.gif" width="100px">');
		}
		if(key === 'end'){
			$('.overlay-ajax-load').fadeOut(300);
		}
	}

	function progressLoadSesion(key) {
		if(key === 'start'){
			$('.overlay-ajax-load').fadeIn(100);
		}
		if(key === 'end'){
			$('.overlay-ajax-load').fadeOut(100);
		}
	}
});

function upToView(idFilm) {
	event.preventDefault();
	$.ajax({
		url: "/trailers?handler=upToView",
		type: "post",
		data: {id:idFilm},
		success: function(response) {
			/*$('#result').html(response);*/
		}
	});
	return false;
};

function startVideo (film, prev) {
	var script = document.createElement('script');
	script.src = "https://cdn.viqeo.tv/js/vq_init_external_player.js?_=" + (+new Date());
	script.setAttribute('data-profile', 105);
	$('#player').addClass('active-player').show();
	$('#playVideo').addClass('active-win').show();
	$('.video').attr('id', 'slotHorizontal');
	script.onload = function () {
		VIQEO.start({
			players: [{
				selector: "#slotHorizontal",
				videoSrc: film,
				previewSrc: prev
			}]
		})
	};
	document.head.appendChild(script)
}