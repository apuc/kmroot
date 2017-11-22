<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.10.2017
 * Time: 20:03
 */
?>

<!--Start Ticket widget-->
<rb:schedule key="55b5814d-8c7e-4c67-95ac-8d583eae8c9a" classType="place" objectID="7883" cityID="2" filter="" locale="" xmlns:rb="http://kassa.rambler.ru"></rb:schedule>
<!--End Ticket widget-->
<script type="text/javascript" src="https://kassa.rambler.ru/s/widget/js/TicketManager.js"></script>

<?php
/**
 * @var array $list
 * @var string $static
 * @var $player
 */
?>
<!doctype html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--	<title>--><?//= $options->get('seo_main_title') ?><!--</title>-->
<!--	<meta name="description" content="--><?//= $options->get('seo_main_description') ?><!--" />-->
	<link rel="image_src" href="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
<!--	<meta name="keywords" content="--><?//= $options->get('seo_main_keywords') ?><!--" />-->

	<link rel="canonical" href="http://www.kinomania.ru"/>

	<meta property="og:title" content="Новинки кино | KINOMANIA.RU" />
	<meta property="og:site_name" content="KINOMANIA.RU" />
	<meta property="og:image" content="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/design/logo3.png" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://www.kinomania.ru/" />
	<meta property="og:description" content="Самая интересная и актуальная информация о новинках мирового кинопроката и свежие новости из мира кино на сайте KINOMANIA.RU. Подробные сведения об актёрах и режиссёрах, саундтреки, постеры к фильмам и многое другое."/>

	<!-- include section/head.html.php -->
</head>
<body>
	<div class="my-overlay">
		<div class="my-overlay-item overlay-trailer-item">
			<div class="my-overlay-bg"></div>
			<div class="row-inner-my-overlay video-overlay">
				<div class="inner-my-overlay">
					<div class="war-content">
	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--#include virtual="/design/ssi/top" -->
	<div class="outer">
		<div class="wrap">
			<!-- include section/header.html.php -->
			<div class="banner">
				<!--#include virtual="/design/ssi/center" -->
			</div>
			<div class="main-content clear">
				<!-- В ЦЕНТРЕ ВНИМАНИЯ -->
				<section class="outer-section clear section-news">
					<!--#include virtual="/index/ssi/center" -->
				</section>

				<!-- Новости Кино -->
				<section class="outer-section outer-shadow outer-news">
					<div class="parent-news">
						<div class=" clear ">
							<div class="section-content col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
								<div class="parent-sticker clear">
									<!--#include virtual="/index/ssi/news" -->
									<div class="sticker">
										<div class="sticker-item">НОВОСТИ КИНО</div>
									</div>
								</div>
							</div>
							<div class=" section-gray-poster col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
								<div class="section-gray">
									<div class="section-gray__item">
										<!--#include virtual="/design/ssi/right_top" -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Трейлеры -->
				<section class="outer-section section-black outer-vert clear ">
		<div class="section-black-item section-black-item1 col-xl-8 col-lg-8 col-md-7 col-sm-12 col-xs-12">
			<div class="section-black-head clear">
				<div class="outer-section-black-item clear">
					<div class="section-black-head-item section-black__title">ТРЕЙЛЕРЫ</div>
					<div class="section-black-head-item section-black__check">
						<ul class="section-black__check-list">
							<li class="active" data-type-trailersSectionButton="cinema"><span>ФИЛЬМОВ</span></li>
							<li class="default" data-type-trailersSectionButton="series"><span>СЕРИАЛОВ</span></li>
						</ul>
						<div class="mobile-section-black__check-list">
							<div class="mobile__select my-select">
								<span class="result">ФИЛЬМОВ</span>
								<ul class="result-list">
									<li class="active" data-type-trailersSectionButton="cinema">ФИЛЬМОВ</li>
									<li class="default" data-type-trailersSectionButton="series"">СЕРИАЛОВ</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="section-black__rss">
					<a href="/rss/trailers/index.xml" class="rss"></a>
				</div>
			</div>
			<div class="section-video section-black-video">
				<!-- <div class="video-prewiew__play ytp-large-play-button ytp-button"></div> -->
				<div class="outer-list-item active" data-type-trailersSection="cinema">
					<div class="inner-list-item active" data-type-trailersType="0">
						<?php foreach ($list['new'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>" onclick="upToView(<?= $item['id'] ?>)" data-prev="<?= $item['image'] ?>">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="inner-list-item" data-type-trailersType="1">
						<?php foreach ($list['popular'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>" onclick="upToView(<?= $item['id'] ?>)" data-prev="<?= $item['image'] ?>">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="inner-list-item" data-type-trailersType="2">
						<?php foreach ($list['comment'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>" onclick="upToView(<?= $item['id'] ?>)" data-prev="<?= $item['image'] ?>">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="inner-list-item" data-type-trailersType="3">
						<?php foreach ($list['local'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>" onclick="upToView(<?= $item['id'] ?>)" data-prev="<?= $item['image'] ?>">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="outer-list-item/app/img/content/33.jpg" data-type-trailersSection="series">
					<div class="inner-list-item" data-type-trailersType="0">
						<?php foreach ($list['series'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>" data-prev="<?= $item['image'] ?>" onclick="upToView(<?= $item['filmId'] ?>)">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="inner-list-item" data-type-trailersType="1">
						<?php foreach ($list['series_ru'] as $k => $item):?>
							<div class="list-item <?php if (0 == $k): ?> active <?php endif ?>" data-type-trailersTrailer="<?= $k ?>">
								<div class="video-prewiew" data-id="<?= $item['id'] ?>"  onclick="upToView(<?= $item['filmId'] ?>)" data-prev="<?= $item['image'] ?>">
									<img alt="" src="<?= $item['image'] ?>" class="responsive-image video-prewiew__item" style="width: 100%;">
								</div>
								<div class="head-desc clear">
									<div class="item item1"><a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>/"><?= $item['name'] ?></a></div>
									<div class="item item2">
										<a href="/film/<?= $item['filmId'] ?>/trailers/<?= $item['id'] ?>#commentList">
											<span class="button button3"><i class="item__icon sprite"></i><span class="number"><?= $item['comment'] ?></span>Комментировать</span>
										</a>
									</div>
								</div>
								<div class="info">
									<p class="title"><a href="/film/<?= $item['filmId'] ?>/"><?= $item['name_ru'] ?></a></p>
									<p class="text mini-desc">
										<?php if (!empty($item['name_origin'])): ?>
											<?= $item['name_origin'] ?>
										<?php endif ?>
										<?php if (!empty($item['country'])): ?>
											<?= $item['country'] ?>,
										<?php endif ?>
										<?= $item['year'] ?>
									</p>
									<?php if (count($item['crew'])): ?>
										<p class="text producer">Режиссер:
											<?php foreach ($item['crew'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<?php if (count($item['crew'])): ?>
										<p class="text name">В ролях:
											<?php foreach ($item['cast'] as $id => $name): ?>
												<a href="/people/<?= $id ?>/"><?= $name ?></a>
											<?php endforeach; ?>
										</p>
									<?php endif ?>
									<div class="download">
										<div class="link__download"><span>Скачать</span><i class="link__download-icon sprite"></i>
											<div class="outer-dop-download">
												<div class="dop-download">
													<?php if ('' != $item['hd480']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd480'] ?>">Низкое</a>
															<a href="/load/n?file=<?= $item['hd480'] ?>">HD 480</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd720']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd720'] ?>">Среднее</a>
															<a href="/load/n?file=<?= $item['hd720'] ?>">HD 720</a>
														</div>
													<?php endif ?>
													<?php if ('' != $item['hd1080']): ?>
														<div class="dop-download-item">
															<a href="/load/n?file=<?= $item['hd1080'] ?>">Высокое</a>
															<a href="/load/n?file=<?= $item['hd1080'] ?>">HD 1080</a>
														</div>
													<?php endif ?>
												</div>
											</div>
										</div>
									</div>
									<div>
										<a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
		<div class="section-black-item section-black-item2 col-xl-4 col-lg-4 col-md-5 col-sm-12 col-xs-12">
			<div class="video-prewiew-nav-head clear">
				<ul class="video-prewiew-nav-list active" data-type-trailersSection="cinema">
					<li class="active item1" data-type-trailersTypeButton="0"><span>Новые</span></li>
					<li class="default item2" data-type-trailersTypeButton="1"><span>Рекомендованные</span></li>
					<li class="default item3" data-type-trailersTypeButton="2"><span>Обсуждаемые</span></li>
					<li class="default item4" data-type-trailersTypeButton="3"><span>На русском</span></li>
				</ul>
				<ul class="video-prewiew-nav-list" data-type-trailersSection="series">
					<li class="active item1" data-type-trailersTypeButton="0"><span>Зарубежные</span></li>
					<li class="default item2" data-type-trailersTypeButton="1"><span>Российские</span></li>
				</ul>
			</div>
			<div class="video-prewiew-nav-content">
				<div class="outer-list-result active" data-type-trailersSection="cinema">
					<ul class="video-prewiew-list active" data-type-trailersType="0">
						<?php foreach ($list['new'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
					<ul class="video-prewiew-list" data-type-trailersType="1">
						<?php foreach ($list['popular'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
					<ul class="video-prewiew-list" data-type-trailersType="2">
						<?php foreach ($list['comment'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
					<ul class="video-prewiew-list" data-type-trailersType="3">
						<?php foreach ($list['local'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="outer-list-result" data-type-trailersSection="series">
					<ul class="video-prewiew-list active" data-type-trailersType="0">
						<?php foreach ($list['series'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
					<ul class="video-prewiew-list" data-type-trailersType="1">
						<?php foreach ($list['series_ru'] as $k => $item):?>
							<li class="active item item<?= $k ?>" data-type-trailersTrailerButton="<?= $k ?>">
								<p class="chief">
									<span class="video-prewiew-item__title"><?= $item['name_ru'] ?></span>
									<span class="video-prewiew-item__title-en"><?= $item['name_origin'] ?></span>
								</p>
								<p class="name-trailer"><?= $item['name'] ?></p>
								<ul class="video-sticker-list clear">
									<?php if ('yes' == $item['local']): ?>
										<li class="video-sticker__icon rus__icon sprite"></li>
									<?php endif ?>
									<?php if ('yes' == $item['popular']): ?>
										<li class="video-sticker__icon like__icon sprite"></li>
									<?php endif ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		
		<link rel="stylesheet" href="http://fs.kinomania.ru/app/css/videojs.ads.css">
		<script src="http://fs.kinomania.ru/app/js/video.ie8.js"></script>
		<script src="http://fs.kinomania.ru/app/js/video.js"></script>
		<script src="http://fs.kinomania.ru/app/js/videojs.ads.js"></script>
		<script src="http://fs.kinomania.ru/app/js/videojs-preroll.js"></script>
		<script type="text/javascript" src="<?= $static ?>/app/js/film.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.video-prewiew').click(function(){
					var id = $(this).attr('data-id');
					var prev = $(this).attr('data-prev');
		//	        var href = $(this).parent().parent().parent().parent().find('.dop-download').find('a:last').attr('href');
		//	        console.log(prev);
					$.ajax({
						url: '/film/?handler=getTrailer&id=' + id,
						type: "POST",
						success: function (data) {
							data = JSON.parse(data);
							console.log(data.src);
							<?php if($player != 'js'):?>
							startVideo(data.src, prev);
							return false;
							<?php endif;?>
		
							if ('' != data.src) {
								$('.war-content').html('<video id="trailer_video" class="video-js vjs-default-skin" controls preload="auto" width="720" data-setup="{}">' +
									'<source src="' + data.src + '" type=\'video/mp4\'>' +
									'<p class="vjs-no-js">' +
									'Для просмотра этого видео, пожалуйста, включите JavaScript, или рассмотрите вобзможность о переходе на веб-браузер, который поддерживает HTML5-видео' +
									'</p>' +
									'</video>'
								);
								var width = 800;
								if (800 >= $(window).width()) {
									width = $(window).width();
								}
								var player = videojs('trailer_video', { "controls": true, "autoplay": true, "preload": "auto", "width": width }, function() {
									this.play();
								});
								if ('' !== window.__pre_roll__) {
									player.preroll({
										src: window.__pre_roll__,
										href: window.__pre_roll_link__,
										target: '_blank ',
										lang: {
											'skip':'Пропустить',
											'skip in': 'Пропустить через ',
											'advertisement': 'Реклама',
											'video start in': 'Видео начнется через: '
										}
									});
									player.one('adstart', function() {
										if('undefined' != typeof _gaq) {
											_gaq.push(['_trackEvent', 'Trailer', 'View'])
										}
									});
									player.one('adskip', function() {
										if('undefined' != typeof _gaq) {
											_gaq.push(['_trackEvent', 'Trailer', 'Skip'])
										}
									});
									$(document).on('click', 'a.preroll-blocker', function(){
										if('undefined' != typeof _gaq) {
											_gaq.push(['_trackEvent', 'Trailer', 'Click'])
										}
									});
								}
							}
							$('.my-overlay').addClass('active');
							$('.my-overlay .overlay-trailer-item').addClass('active');
						},
						complete: function () {
						},
						error: function () {
						},
						timeout: 5000
					});
				});
		
				$('.my-overlay-bg').click(function(event) {
					var oldPlayer = document.getElementById('trailer_video');
					if (null !== oldPlayer) {
						videojs(oldPlayer).dispose();
					}
					$('.my-overlay').removeClass('active');
					$('.my-overlay .my-overlay-item').removeClass('active');
				});
			});
		</script>
	</section>
				<!-- Контент -->
				<section class="outer-section clear outer-content">
					<!-- Контент -->
					<content class="section-content content-outer outer-vert col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<!-- Зарубежные сериалы -->
						<section class="inner-content outer-content-item parent-sticker">
							<!--#include virtual="/index/ssi/series/foreign" -->
						</section>

						<!-- Желтый блок -->
						<!--#include virtual="/index/ssi/yellow" -->

						<!-- Российские сериалы -->
						<section class="inner-content outer-content-item parent-sticker">
							<!--#include virtual="/index/ssi/series/ru" -->
						</section>
						<!--#include virtual="/index/ssi/calendar" -->
					</content>
					<!-- Сайдбар -->
					<aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="section-gray layout outer-aside">
							<div class="aside">
								<div class="inner-aside">
									<div class="aside-item no-mobile">
										<!--#include virtual="/index/ssi/new" -->
									</div>
									<div class="aside-item leaders">
										<!--#include virtual="/index/ssi/boxoffice" -->
									</div>
								</div>
							</div>
							<div class="dop-aside no-mobile">
								<div class="dop-aside__item">
									<div class="dop-aside__banner">
										<!--#include virtual="/design/ssi/right_bottom" -->
									</div>
								</div>
								<div class="dop-aside__item">
									<div class="dop-aside__poster">
										<div class="aside__title">ПОСТЕР ДНЯ</div>
										<!--#include virtual="/index/ssi/poster" -->
									</div>
								</div>
								<div class="dop-aside__item">
									<div class="section-social clear">
										<ul class="aside-social">
											<li class="aside-social__item active" data-type-sliderGroup="social" data-type-sliderButton="vk"><i class="social__icon social__icon-vk"></i><span>В контакте </span></li>
											<li class="aside-social__item default" data-type-sliderGroup="social" data-type-sliderButton="fb"><i class="social__icon social__icon-fb"></i><span>Facebook </span></li>
										</ul>
									</div>
									<div class="dop-aside__item-content">
										<div class="outer-content-social">
											<div class="content-social content-social-vk active" data-type-sliderElem="vk" data-type-sliderGroup="social">
												<div id="vk_groups"></div>
												<script type="text/javascript">
													$(document).ready(function(){
														setTimeout(function(){
															if (undefined !== VK && undefined !== VK.Widgets) {
																VK.Widgets.Group("vk_groups", {
																	mode: 0,
																	width: "250",
																	height: "300",
																	color1: 'FFFFFF',
																	color2: '2B587A',
																	color3: '5B7FA6'
																}, 41464224);
															}
														}, 1500);
													});
												</script>
											</div>
											<div class="content-social content-social-fb default" data-type-sliderElem="fb" data-type-sliderGroup="social">
												<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FKinomaniaru%2F106629932735181%3Fref%3Dstream%26hc_location%3Dstream&width=250&height=290&show_faces=true&colorscheme=light&stream=false&show_border=false&header=true&appId=306029476182010" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:250px; height:290px;" allowTransparency="true"></iframe>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</aside>
				</section>
			</div>
		</div>
	</div>
	<!-- include section/footer.html.php -->
	<div id="playVideo" onclick="closeVideo()">
		<div id="player">
			<div class="video"></div>
		</div>
	</div>
	<!-- include section/scripts.html.php -->

	<!-- Magnific Popup core JS file -->
	<script src="<?= $static ?>/app/js/plugins/mp/jquery.magnific-popup.js"></script>
	<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>
	<script type="text/javascript">
		function sliderNavigation(){
			var w = window.innerWidth;
			if (w < 768) {
				topp = Math.round($(".section-news img").height()*0.85)-24;
			} else {
				topp = Math.round($(".section-news img").height()*0.85)-14;
			}
			$(".bx-default-pager").css('top',topp+"px");
		}

		function sliderNavigationButton(){
			var w = window.innerWidth;
			if (w < 320) {
				topp = Math.round($(".section-news img").height()*0.85)-40;
			}else if (w < 544) {
				topp = Math.round($(".section-news img").height()*0.85)-40;
			}else if (w < 768) {
				topp = Math.round($(".section-news img").height()*0.85)-100;
			}else if (w < 992) {
				topp = Math.round($(".section-news img").height()*0.85)-100;
			} else {
				topp = Math.round($(".section-news img").height()*0.85)-114;
			}
			$(".section-news .bx-controls-direction a").css('top',topp+"px");
		}

		function sliderTrailers(section, type, trailer) {
			toggleClass('default',"[data-type-trailersSection]");
			toggleClass('default',"[data-type-trailersSectionButton]");
			toggleClass('default',"[data-type-trailersType]");
			toggleClass('default',"[data-type-trailersTypeButton]");
			toggleClass('default',"[data-type-trailersTrailer]");
			toggleClass('default',"[data-type-trailersTrailerButton]");

			if(!section){
				section = $("[data-type-trailersSection]:first").attr('data-type-trailersSection');
			}
			if(!type){
				type = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType]:first").attr('data-type-trailersType');
			}
			if(!trailer){
				trailer = $("[data-type-trailersSection = "+section+"]").children("[data-type-trailersType = "+type+"]").children("[data-type-trailersTrailer]:first").attr('data-type-trailersTrailer');
			}

			toggleClass('active',"[data-type-trailersSectionButton = "+section+"]");
			toggleClass('active',"[data-type-trailersSection = "+section+"]");
			toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersTypeButton = "+type+"]");
			toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]");
			toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailerButton = "+trailer+"]");
			toggleClass('active',"[data-type-trailersSection = "+section+"]","[data-type-trailersType = "+type+"]","[data-type-trailersTrailer = "+trailer+"]");
		}


		$(window).load(function() {
			sliderNavigation();
			sliderNavigationButton();
		});

		$(document).ready(function() {
			$('#calendar_birthday').datetimepicker({
				format: "YYYY-MM-DD",
				locale: "ru"
			});
			window.hide_calendar = false;
			$('#calendar_birthday').on("dp.change",function (e) {
				if (window.hide_calendar) {
					window.hide_calendar = false;
					$('.outer-calendar').hide();

					var me = $(this);
					if (me.data('requestRunning')) {
						return;
					}
					me.data('requestRunning', true);
					$('.content-item-dop-date').html('Обработка');

					$('.content-item-dop-section .happy-carousel').html('');
					$.ajax({
						"type": "post",
						"async": "true",
						"url": "/index/calendar",
						"data": "date=" + $('#calendar_birthday').val(),
						"success": function(data){
							data = JSON.parse(data);
							console.log(data.length);
							if (0 < data.length) {
								for (var key in data) {
									if (data.hasOwnProperty(key)) {
										$('.content-item-dop-section .happy-carousel').append('<div class="item">  '  +
											'                       <div class="row-item-image image-shadow">  '  +
											'                           <a href="/people/' + data[key]['id'] +  '/"><img alt="" src="' + data[key]['image'] +  '" class="item-image image-prewiew"></a>  '  +
											'                       </div>  '  +
											'                       <div class="item-text">  '  +
											'                           <div class="item-text-title">  '  +
											'                               <a href="/people/' + data[key]['id'] +  '/">' + data[key]['name'] +  '</a>  '  +
											'                           </div>  '  +
											'                           <div class="item-text-date">  '  +
											'                               <span>' + data[key]['birthday'] +  '</span>  '  +
											'                           </div>  '  +
											'     '  +
											'                       </div>  '  +
											'                  </div>  ' );
										$('.content-item-dop-date').html(data[key]['date']);
									}
								}
								var currentSlide = window.mySlider.getCurrentSlide();

								w = window.innerWidth;

								if (w <= 992) {
									window.mySlider.reloadSlider({
										startSlide: currentSlide,
										slideWidth: 0,
										maxSlides: 2,
										minSlides: 2,
										infiniteLoop: true,
										slideMargin: 70,
										pager: false
									});
								} else {
									window.mySlider.reloadSlider({
										startSlide: currentSlide,
										slideWidth: 300,
										maxSlides: 2,
										minSlides: 2,
										infiniteLoop: true,
										slideMargin: 70,
										pager: false
									});
								}
							}
						},
						complete: function() {
							me.data('requestRunning', false);
						},
						error: function(){
							me.data('requestRunning', false);
						},
						timeout: 12000
					});
				}
			});
			$('.content-item-dop-date').click(function() {
				$('.outer-calendar').show();
				$('#calendar_birthday').datetimepicker("show");
				window.hide_calendar = true;
			});


			<!-- bxSlider Init -->
			$('.slider-load').css('display', 'block');
			$('.bxslider').bxSlider({
				auto: false,
				onSliderLoad: function(){
					$(".bxslider").css("visibility", "visible");
				}
			});
			w = window.innerWidth;

			if (w <= 992) {
				window.mySlider = $('.happy-carousel').bxSlider({
					slideWidth: 0,
					maxSlides: 2,
					minSlides: 2,
					infiniteLoop: true,
					slideMargin: 70,
					pager: false
				});
			} else {
				window.mySlider = $('.happy-carousel').bxSlider({
					slideWidth: 300,
					maxSlides: 2,
					minSlides: 2,
					infiniteLoop: true,
					slideMargin: 70,
					pager: false
				});
			}

			$("img.lazy").lazyload({
				effect : "fadeIn"
			});


			// ====Слайдер для меню трейлеров
			// == Секции Пк версия
			$("[data-type-trailersSectionButton]").on('click', function () {
				section = $(this).attr('data-type-trailersSectionButton');
				sliderTrailers(section);
				// меняет содержимое селектора для моб. версии
				html_r = $(this).html();
				$(".mobile__select .result").html(html_r);
				$(".mobile__select .result-list").css('display', 'none');
			});
			// == Тип ПК версия
			$("[data-type-trailersTypeButton]").on('click', function () {
				type = $(this).attr('data-type-trailersTypeButton');
				section = $(this).parents("[data-type-trailersSection]").attr('data-type-trailersSection');
				sliderTrailers(section, type);
			});
			// == Трейлеры ПК версия
			$("[data-type-trailersTrailerButton]").mouseover(function () {
				trailer = $(this).attr('data-type-trailersTrailerButton');
				type = $(this).parents("[data-type-trailersType]").attr('data-type-trailersType');
				section = $(this).parents("[data-type-trailersType]").parents("[data-type-trailersSection]").attr('data-type-trailersSection');
				sliderTrailers(section, type, trailer);
			});
		});
	</script>

	<script src="http://userapi.com/js/api/share.js?3" async="async" type="text/javascript"></script>
	<script src="http://vkontakte.ru/js/api/openapi.js?20" async="async" type="text/javascript"></script>
</body>
</html>