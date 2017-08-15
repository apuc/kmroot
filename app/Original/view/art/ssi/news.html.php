<?php
/**
 * @var array $list
 */
?>
<div class="news-item col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?php foreach ($list as $item): ?>
        <div class="new-item-each <?php if ($item['active']): ?>active<?php endif ?>" data-news-element="news_<?= $item['id'] ?>">
            <div class="news-item__prewiew image-shadow">
                <img alt="" src="<?= $item['image'] ?>" class="responsive-image image-prewiew">
            </div>
            <p class="news-title title--normal"><a href="/news/<?= $item['id'] ?>/"><?= $item['title'] ?></a></p>
            <div class="outer-news-date info-section center-info-section">
                <span class="news-date date-info"><?= $item['publish'] ?></span>
                <?php if (0 < $item['comment']): ?>
                    , <a href="/news/<?= $item['id'] ?>#commentList/" class="news-comment comment-info"><?= $item['comment'] ?></a>
                <?php endif ?>
            </div>
            <div class="news-link-desc">
                <p>
                    <a href="/news/<?= $item['id'] ?>/">
                        <?= $item['anons'] ?>
                    </a>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="news-item news-item2 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <?php foreach ($list as $item): ?>
        <div class="news-child__item" data-news="news_<?= $item['id'] ?>">
            <p class="news-child-title news-title title--normal"><a href="/news/<?= $item['id'] ?>/"><?= $item['title'] ?></a></p>
            <p class="news-child-desc max-two-line"><a href="/news/<?= $item['id'] ?>/"><?= strip_tags($item['anons']) ?></a></p>
        </div>
    <?php endforeach; ?>
    <div class="outer-dop-news">
        <ul class="dop-news">
            <li>
                <a href="/news/artkinomania/" class="all__news">ВСЕ НОВОСТИ</a>
            </li>
            <li >
                <a href="/rss/news/artkinomania.xml" class="rss"></a>
            </li>
        </ul>
    </div>
</div>
