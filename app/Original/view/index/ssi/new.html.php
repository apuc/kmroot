<?php
/**
 * @var array $list
 * @var array $country
 */
?>
<div class="aside__title">Новинки</div>
<div class="aside-item-content">
    <div class="outer-aside-list">
        <div class="mobile__select aside-select aside-top my-select">
            <span class="result">КИНО</span>
            <ul class="result-list">
                <li class="active" data-type-sliderGroup="novelty" data-type-sliderButton="cinema">КИНО</li>
                <li class="default" data-type-sliderGroup="novelty" data-type-sliderButton="trailers">ТРЕЙЛЕРЫ</li>
                <li class="default" data-type-sliderGroup="novelty" data-type-sliderButton="wallpapers">ОБОИ</li>
            </ul>
        </div>
        <ul class="aside-list clear">
            <li class="active" data-type-sliderGroup="novelty" data-type-sliderButton="cinema">КИНО</li>
            <li class="default" data-type-sliderGroup="novelty" data-type-sliderButton="trailers">ТРЕЙЛЕРЫ</li>
            <li class="default" data-type-sliderGroup="novelty" data-type-sliderButton="wallpapers">ОБОИ</li>
        </ul>
    </div>
    <div class="outer-aside-result">
        <div class="aside-result active aside-top" data-type-sliderGroup="novelty" data-type-sliderElem="cinema">
            <?php foreach ($list['film'] as $item): ?>
                <div class="aside-result__item">
                    <p class="aside-result__title" onclick="document.location='/film/<?= $item['id'] ?>/'">
                            <span class="aside-result__title-text"><?= $item['name'] ?></span
                    </p>
                    <p class="aside-result__dop">
                    <?php foreach ($item['country'] as $code): ?>
                        <?php if (isset($country[$code])): ?>
                            <?= $country[$code] ?>,
                        <?php endif; ?>
                    <?php endforeach; ?>
                        <?= $item['year'] ?></p>
                </div>
            <?php endforeach; ?>
            <!--<a href="/billboard/" class="button button2">ВСЯ АФИША</a>-->
        </div>
        <div class="aside-result default" data-type-sliderGroup="novelty" data-type-sliderElem="trailers">
            <?php foreach ($list['trailer'] as $item): ?>
                <div class="aside-result__item">
                    <p class="aside-result__title" onclick="document.location='/film/<?= $item['id'] ?>/trailers/'">
                        <span class="aside-result__title-text"><?= $item['name'] ?></span
                    </p>
                    <p class="aside-result__dop">
                        <?php foreach ($item['country'] as $code): ?>
                            <?php if (isset($country[$code])): ?>
                                <?= $country[$code] ?>,
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?= $item['year'] ?></p>
                </div>
            <?php endforeach; ?>
            <a href="/trailers/" class="button button2">ВСЕ ТРЕЙЛЕРЫ</a>
        </div>
        <div class="aside-result default" data-type-sliderGroup="novelty" data-type-sliderElem="wallpapers">
            <?php foreach ($list['wallpaper'] as $item): ?>
                <div class="aside-result__item">
                    <p class="aside-result__title" onclick="document.location='/film/<?= $item['id'] ?>/wallpapers/'">
                        <span class="aside-result__title-text"><?= $item['name'] ?></span
                    </p>
                    <p class="aside-result__dop">
                        <?php foreach ($item['country'] as $code): ?>
                            <?php if (isset($country[$code])): ?>
                                <?= $country[$code] ?>,
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?= $item['year'] ?></p>
                </div>
            <?php endforeach; ?>
            <a href="/wallpapers/films/" class="button button2">ВСЕ ОБОИ</a>
        </div>
    </div>
</div>