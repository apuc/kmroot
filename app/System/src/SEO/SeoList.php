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
		'seo/billboard' => 'Афиша',
        'seo/news' => 'Новости',
        'seo/top/films' => 'Топ фильмов',
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
		'seo/reason' => 'Был бы повод',
		'seo/art' => 'Арткиномания',
        'seo/awards' => 'Фестивали и премии',
        'seo/movie_memorial' => 'BOOOM!!',
        'seo/scripts' => 'Все сценарии',
        'seo/posters' => 'Постеры',
        'seo/soundtracks' => 'Саундтреки',
        'seo/photos' => 'Фотографии',
        'seo/wallpapers/films' => 'Обои к фильмам',
        'seo/wallpapers/actors' => 'Обои к актерам',
        'seo/wallpapers/actresses' => 'Обои к актрисам',
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
			'url' => '/billboard',
			'urlAdmin' => 'seo/billboard',
			'label' => 'Афиша',
		],
        [
            'url' => '/news',
            'urlAdmin' => 'seo/news',
            'label' => 'Новости',
        ],
		[
			'url' => '/top/films',
			'urlAdmin' => 'seo/top/films',
			'label' => 'Топ фильмов',
		],
		[
			'url' => '/trailers',
			'urlAdmin' => 'seo/trailers',
			'label' => 'Трейлеры',
		],
		[
			'url' => '/tv',
			'urlAdmin' => 'seo/tv',
			'label' => 'ТВ',
		],
		[
			'url' => '/releases/russia',
			'urlAdmin' => 'seo/releases/russia',
			'label' => 'График премьер РФ',
		],
		[
			'url' => '/releases/usa',
			'urlAdmin' => 'seo/releases/usa',
			'label' => 'График премьер США',
		],
		[
		'url' => '/article/shorts',
		'urlAdmin' => 'seo/shorts',
		'label' => 'SHORTS',
		],
		[
			'url' => '/reviews',
			'urlAdmin' => 'seo/reviews',
			'label' => 'Рецензии',
		],
		[
			'url' => '/article/interview',
			'urlAdmin' => 'seo/interview',
			'label' => 'Интервью',
		],
		[
			'url' => '/article/press_review',
			'urlAdmin' => 'seo/press_review',
			'label' => 'Пресс-обзор',
		],
		[
			'url' => '/article/anticipation',
			'urlAdmin' => 'seo/anticipation',
			'label' => 'Ожидания',
		],
		[
			'url' => '/article/inside',
			'urlAdmin' => 'seo/inside',
			'label' => 'Инсайд',
		],
		[
			'url' => '/article/reason',
			'urlAdmin' => 'seo/reason',
			'label' => 'Был бы повод',
		],
		[
			'url' => '/art',
			'urlAdmin' => 'seo/art',
			'label' => 'Арткиномания',
		],
		[
			'url' => '/awards',
			'urlAdmin' => 'seo/awards',
			'label' => 'Фестивали и премии',
		],
		[
			'url' => '/article/movie_memorial',
			'urlAdmin' => 'seo/movie_memorial',
			'label' => 'BOOOM!!',
		],
		[
			'url' => '/scripts',
			'urlAdmin' => 'seo/scripts',
			'label' => 'Все сценарии',
		],
		[
			'url' => '/posters',
			'urlAdmin' => 'seo/posters',
			'label' => 'Постеры',
		],
		[
			'url' => '/soundtracks',
			'urlAdmin' => 'seo/soundtracks',
			'label' => 'Саундтреки',
		],
		[
			'url' => '/photos',
			'urlAdmin' => 'seo/photos',
			'label' => 'Фотографии',
		],
		[
			'url' => '/wallpapers/films',
			'urlAdmin' => 'seo/wallpapers/films',
			'label' => 'Обои к фильмам',
		],
		[
			'url' => '/wallpapers/actors',
			'urlAdmin' => 'seo/wallpapers/actors',
			'label' => 'Обои к актерам',
		],
		[
			'url' => '/wallpapers/actresses',
			'urlAdmin' => 'seo/wallpapers/actresses',
			'label' => 'Обои к актрисам',
		],
		[
			'url' => '/top',
			'urlAdmin' => 'seo/top',
			'label' => 'Подборки киномании',
		],
		[
			'url' => '/article/boxoffice',
			'urlAdmin' => 'seo/boxoffice',
			'label' => 'Бокс-офис',
		],
		[
			'url' => '/boxoffice/russia',
			'urlAdmin' => 'seo/boxoffice/russia',
			'label' => 'Сборы в РФ',
		],
		[
			'url' => '/boxoffice/cis',
			'urlAdmin' => 'seo/boxoffice/cis',
			'label' => 'Сборы в СНГ',
		],
		[
			'url' => '/boxoffice/usa',
			'urlAdmin' => 'seo/boxoffice/usa',
			'label' => 'Сборы в США',
		],
    ];

}