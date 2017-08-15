<?php
/**
 * @var array $list
 */
?>
<?php if (count($list)): ?>
    <div class="sticker">
        <div class="sticker-item">СТАТЬИ И НОВОСТИ</div>
    </div>

    <div class="parent-content-item clear">
        <?php for ($i = 0; $i < 2; $i++): ?>
            <?php if (!isset($list[$i])): ?>
                <?php break; ?>
            <?php endif ?>
            <div class="content-item <?php if (0 == $i): ?> content-item-big <?php else: ?> content-item-small <?php endif ?>">
                <div class="content-item-row-image image-shadow ">
                    <a href="/news/<?= $list[$i]['id'] ?>/"><img alt="" src="//:0" data-original="<?= $list[$i]['image'] ?>" class="lazy image-prewiew"></a>
                    <div class="content-item-info">
                        <span class="content-item-info-date"><?= $list[$i]['title_short'] ?></span>
                    </div>
                </div>
                <div class="content-item-title">
                    <a href="/news/<?= $list[$i]['id'] ?>/"><?= $list[$i]['title'] ?></a>
                </div>
                <div class="content-item-text">
                    <?= $list[$i]['anons'] ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="parent-content-item clear">
        <?php for ($i = 2; $i < 4; $i++): ?>
            <?php if (!isset($list[$i])): ?>
                <?php break; ?>
            <?php endif ?>
            <div class="content-item <?php if (3 == $i): ?> content-item-big <?php else: ?> content-item-small <?php endif ?>">
                <div class="content-item-row-image image-shadow ">
                    <a href="/news/<?= $list[$i]['id'] ?>/"><img alt="" src="//:0" data-original="<?= $list[$i]['image'] ?>" class="lazy image-prewiew"></a>
                    <div class="content-item-info">
                        <span class="content-item-info-date"><?= $list[$i]['title_short'] ?></span>
                    </div>
                </div>
                <div class="content-item-title">
                    <a href="/news/<?= $list[$i]['id'] ?>/"><?= $list[$i]['title'] ?></a>
                </div>
                <div class="content-item-text">
                    <?= $list[$i]['anons'] ?>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="outer-dop-news outer-dop-content">
        <ul class="dop-news">
            <li>
                <a href="/news/awards/" class="all__news">ВСЕ НОВОСТИ</a>
            </li>
            <li>
                <a href="/rss/news/awards.xml" class="rss"></a>
            </li>
        </ul>
    </div>
<?php endif ?>