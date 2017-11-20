function upToView(idFilm) {
	event.preventDefault();
	$.ajax({
		url: "?handler=upToView",
		type: "post",
		data: {id:idFilm},
		success: function(response) {
			/*$('#result').html(response);*/
		}
	});
	return false;
}

function startVideo (film, prev) {
	var script = document.createElement('script');
	script.src = "https://cdn.viqeo.tv/js/vq_init_external_player.js?_=" + (+new Date());
	script.setAttribute('data-profile', 105);
	// $("#player").append("<div class='video'></div>");
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
function closeVideo() {
	event.preventDefault();
	$('#playVideo').removeClass('active-win');
	$('#player').removeClass('active-player');
	document.getElementById('slotHorizontal').innerHTML = '';
	// $('.video').remove();
}
jQuery(document).ready(function($) {
	event.preventDefault();
	$(document).on('click', '#playVideo', function() {
		$('#playVideo').removeClass('active-win');
		$('#player').removeClass('active-player');
		document.getElementById('slotHorizontal').innerHTML = '';
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

