<?php
/**
 * @var array $list
 */
?>
<div class="aside__title">ЛИДЕРЫ ПРОКАТА</div>
<div class="aside-item-content">
    <div class="outer-aside-list">
        <ul class="aside-list clear">
            <li class="active" data-type-sliderGroup="leaders" data-type-sliderButton="Russia">РОССИЯ</li>
            <li class="default" data-type-sliderGroup="leaders" data-type-sliderButton="SNG">СНГ</li>
            <li class="default" data-type-sliderGroup="leaders" data-type-sliderButton="USA">США</li>
        </ul>
    </div>
    <div class="outer-aside-result">
        <div class="aside-result active" data-type-sliderGroup="leaders" data-type-sliderButton="Russia">
            <div class="aside-result__item">
                <div class="aside-result__date">
                    <p class="aside-result__date-text"><?= $list['russia']['date'] ?></p>
                </div>
                <div class="aside-result-image image-shadow">
                    <img width="171" height="247" alt="" src="<?= $list['russia']['image'] ?>" class="image-prewiew">
                    <div class="outer-number sprite">
                        <p class="outer-number__text"><a href="<?= $list['russia']['id'] ?>/"><?= $list['russia']['gross'] ?></a></p>
                    </div>
                </div>
                <p class="aside-result__title">
                    <span class="aside-result__title-text top__title" onclick="document.location='<?= $list['russia']['id'] ?>/'"><?= $list['russia']['name'] ?></span>
                </p>
                <div class="top-aside-result__outer-list clear">
                    <?php foreach ($list['russia']['list'] as $item): ?>
                        <ul class="top-aside-result__list clear">
                            <li>
                                <ul>
                                    <li class="outer-name">
                                        <a href="<?= $item[1] ?>/"><span class="number"><?= $item[0] ?></span>.
                                            <span class="name"><?= $item[2] ?></span></a>
                                    </li>
                                    <li class="price"><?= $item[3] ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="/boxoffice/russia/" class="button button2">подробно</a>
        </div>
        <div class="aside-result default" data-type-sliderGroup="leaders" data-type-sliderButton="SNG">
            <div class="aside-result__item">
                <div class="aside-result__date">
                    <p class="aside-result__date-text"><?= $list['cis']['date'] ?></p>
                </div>
                <div class="aside-result-image image-shadow">
                    <img width="171" height="247" alt="" src="<?= $list['cis']['image'] ?>" class="image-prewiew">
                    <div class="outer-number sprite">
                        <p class="outer-number__text"><a href="<?= $list['cis']['id'] ?>/"><?= $list['cis']['gross'] ?></a></p>
                    </div>
                </div>
                <p class="aside-result__title">
                    <span class="aside-result__title-text top__title" onclick="document.location='<?= $list['cis']['id'] ?>/'"><?= $list['cis']['name'] ?></span>
                </p>
                <div class="top-aside-result__outer-list clear">
                    <?php foreach ($list['cis']['list'] as $item): ?>
                        <ul class="top-aside-result__list clear">
                            <li>
                                <ul>
                                    <li class="outer-name">
                                        <a href="<?= $item[1] ?>/"><span class="number"><?= $item[0] ?></span>.
                                            <span class="name"><?= $item[2] ?></span></a>
                                    </li>
                                    <li class="price"><?= $item[3] ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="/boxoffice/cis/" class="button button2">подробно</a>
        </div>
        <div class="aside-result default" data-type-sliderGroup="leaders" data-type-sliderButton="USA">
            <div class="aside-result__item">
                <div class="aside-result__date">
                    <p class="aside-result__date-text"><?= $list['usa']['date'] ?></p>
                </div>
                <div class="aside-result-image image-shadow">
                    <img width="171" height="247" alt="" src="<?= $list['usa']['image'] ?>" class="image-prewiew">
                    <div class="outer-number sprite">
                        <p class="outer-number__text"><a href="<?= $list['usa']['id'] ?>/"><?= $list['usa']['gross'] ?></a></p>
                    </div>
                </div>
                <p class="aside-result__title">
                    <span class="aside-result__title-text top__title" onclick="document.location='<?= $list['usa']['id'] ?>/'"><?= $list['usa']['name'] ?></span>
                </p>
                <div class="top-aside-result__outer-list clear">
                    <?php foreach ($list['usa']['list'] as $item): ?>
                        <ul class="top-aside-result__list clear">
                            <li>
                                <ul>
                                    <li class="outer-name">
                                        <a href="<?= $item[1] ?>/"><span class="number"><?= $item[0] ?></span>.
                                            <span class="name"><?= $item[2] ?></span></a>
                                    </li>
                                    <li class="price"><?= $item[3] ?>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
            <a href="/boxoffice/usa/" class="button button2">подробно</a>
        </div>
    </div>
</div>