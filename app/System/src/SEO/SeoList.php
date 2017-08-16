<?php

namespace Kinomania\System\SEO;

/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.08.2017
 * Time: 17:20
 */
class SeoList
{

    const LIST = [
        'seo/main' => 'Главная',
        'seo/news' => 'Новости',
        'seo/top_films' => 'Топ фильмов',
        'seo/trailers' => 'Трейлеры',
        'seo/tv' => 'ТВ',
        'seo/releases/russia' => 'График премьер РФ',
        'seo/releases/usa' => 'График премьер США',
        'seo/shorts' => 'SHORTS',
        'seo/reviews' => 'Рецензии',
        'seo/interview' => 'Интервью',
        'seo/press_review' => 'Пресс-обзор',
        'seo/anticipation' => 'Ожидания',
        'seo/inside' => 'Инсайд',
        'seo/awards' => 'Фестивали и премии',
        'seo/movie_memorial' => 'BOOOM!!',
        'seo/scripts' => 'Все сценарии',
        'seo/posters' => 'Постеры',
        'seo/soundtracks' => 'Саундтреки',
        'seo/photos' => 'Фотографии',
        'seo/films' => 'Обои к фильмам',
        'seo/actors' => 'Обои к актерам',
        'seo/actresses' => 'Обои к актрисам',
        'seo/top' => 'Подборки киномании',
        'seo/boxoffice' => 'Бокс-офис',
        'seo/boxoffice/russia' => 'Сборы в РФ',
        'seo/boxoffice/cis' => 'Сборы в СНГ',
        'seo/boxoffice/usa' => 'Сборы в США',
    ];

    const LIST_INFO = [
        [
            'url' => '/',
            'urlAdmin' => 'seo/main',
            'label' => 'Главная',
        ],
        [
            'url' => '/news',
            'urlAdmin' => 'seo/news',
            'label' => 'Новости',
        ],
    ];

}