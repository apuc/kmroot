<?php
/**
 * @var array $list
 */
?>
<div class="parent-sticker">
    <div class="bxslider" style="visibility: hidden;">
        <?php foreach ($list as $item): ?>
            <div class="item">
                <div class="inner-section clear row">
                    <div class="center-section-preview col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="outer-image-prewiew ">
                            <div class="inner-image-prewiew ">
                                <img alt="<?= $item['title'] ?>" src="<?= $item['image'] ?>" class="image-prewiew">
                                
                            </div>
                        </div>
                    </div>
                    <div class="section-description center-section-description col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="outer-desc">
                            <div class="title-description_def">
                                <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/" style="text-decoration: none; color: inherit;    font-weight: bold;"><?= $item['title'] ?></a>
                            </div>
                            <div class="info-section center-info-section">
                                <span class="date-info"><?= $item['publish'] ?></span>
                                <?php if (0 < $item['comment']): ?>
                                    , <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>#commentList/" class="comment-info"><?= $item['comment'] ?></a>
                                <?php endif ?>
                            </div>
                            <div class="outer-section-description__text">
                                <div class="slide-description" ><?= $item['anons'] ?></div>
                            </div>
                            <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/" class="button button2">ПОДРОБНО</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="sticker">
        <div class="sticker-item">В ЦЕНТРЕ ВНИМАНИЯ</div>
    </div>
</div>
