/**
 * Created by perff on 29.08.2017.
 */
$(document).ready(function () {
    $(document).on('change', '.form-filter', function () {
        var genre = ($('.genre-filter :selected').val()) ? $('.genre-filter :selected').val() : '';
        genreText = ($('.genre-filter :selected').text()) ? $('.genre-filter :selected').text() : '';
        country = ($('.country-filter :selected').val()) ? $('.country-filter :selected').val() : '';
        years = ($('.years-filter :selected').val()) ? $('.years-filter :selected').val() : '';
        page = 1;
        progressLoad('start');
        $.ajax({
            type: 'POST',
            url: '?handler=get',
            data: {'page': page, 'genre': genre, 'country': country, 'years': years},
            success: function (data) {
                $('.session-table').html('');
                $('.session-table').append(data);
                $('.pagetitle').text(genreText);
                progressLoad('end');
            },
            error: function (xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });
    })

    $(document).on('click', '.pagList a', function () {
        var genre = ($('.genre-filter :selected').val()) ? $('.genre-filter :selected').val() : '';
        country = ($('.country-filter :selected').val()) ? $('.country-filter :selected').val() : '';
        years = ($('.years-filter :selected').val()) ? $('.years-filter :selected').val() : '';
        page = $(this).attr('href').split('=')[1];
        page = (page) ? page : 1;
        progressLoad('start');
        $.ajax({
            type: 'POST',
            url: '?handler=get',
            data: {'page': page, 'genre': genre, 'country': country, 'years': years},
            success: function (data) {
                console.log(data);
                $('.session-table').html('');
                $('.session-table').append(data);
                progressLoad('end');
            },
            error: function (xhr, str) {
                alert('Возникла ошибка: ' + xhr.responseCode);
            }
        });

        return false;
    })

    function progressLoad(key) {
        if(key === 'start'){
            $('.overlay-ajax-load').fadeIn(300);
        }
        if(key === 'end'){
            $('.overlay-ajax-load').fadeOut(300);
        }

    }
});