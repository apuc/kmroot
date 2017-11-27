<?php
/**
 * @var array $list
 * @var string $static
 * @var $player
 */
?>
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
	       // var href = $(this).parent().parent().parent().parent().find('.dop-download').find('a:last').attr('href');
	        $.ajax({
                url: '/film/?handler=getTrailer&id=' + id,
                type: "POST",
                success: function (data) {
	                data = JSON.parse(data);
	                return false;
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