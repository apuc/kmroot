<?php
/**
 * @var array $list
 */
?>
<div class="aside__title">ПОПУЛЯРНЫЕ МАТЕРИАЛЫ</div>
<div class="aside-treilers">
    <?php foreach ($list as $item): ?>
        <div class="aside-treilers-item">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-5 col-xs-5 aside-popular-image">
                    <div class="image-shadow">
                        <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/">
                            <img alt="" src="<?= $item['image'] ?>" class="responsive-image image-prewiew aside-image-prewiew">
                        </a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-6 col-sm-7 col-xs-7 aside-popular-content">
                    <div class="aside-popular__title">
                        <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>/"><?= $item['title'] ?></a>
                    </div>
                    <div class="aside-popular__comment">
                        <a href="/<?= $item['category'] ?>/<?= $item['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $item['comment'] ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>