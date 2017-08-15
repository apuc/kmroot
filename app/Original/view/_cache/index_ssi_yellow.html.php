<?php
/**
 * @var array $box
 * @var array $review
 * @var array $wait
 * @var array $be
 */
?>
<section class="no-mobile inner-content outer-content-item parent-sticker outer-section-mini-prewiew">
    <div class="section-mini-prewiew section-mini-prewiew--yellow">
        <div class="outer-section-mini-prewiew-list">
            <ul class="section-mini-prewiew-list clear">
                <li>
            <span>
                <a href="/article/boxoffice/">
                    Бокс-офис
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/reviews/">
                    Рецензии
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/article/anticipation/">
                    Ожидания
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/article/reason/">
                    Был бы повод...
                </a>
            </span>
                </li>
            </ul>
        </div>
        <div class="outer-section-mini-prewiew-item clear">
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $box['id'] ?>/"><img alt="" src="//:0" data-original="<?= $box['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $box['id'] ?>/"><?= $box['title'] ?></a>
                            <?php if (0 < $box['comment']): ?>
                                <a href="/article/<?= $box['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $box['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $review['id'] ?>/"><img alt="" src="//:0" data-original="<?= $review['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $review['id'] ?>/"><?= $review['title'] ?></a>
                            <?php if (0 < $review['comment']): ?>
                                <a href="/article/<?= $review['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $review['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $wait['id'] ?>/"><img alt="" src="//:0" data-original="<?= $wait['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $wait['id'] ?>/"><?= $wait['title'] ?></a>
                            <?php if (0 < $wait['comment']): ?>
                                <a href="/article/<?= $wait['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $wait['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $be['id'] ?>/"><img alt="" src="//:0" data-original="<?= $be['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $be['id'] ?>/"><?= $be['title'] ?></a>
                            <?php if (0 < $be['comment']): ?>
                                <a href="/article/<?= $be['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $be['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Рекомендации -->
<section class="inner-content recomenned outer-content-item parent-sticker">
    <div class="section-mini-prewiew mobile section--yellow">
        <div class="sticker">
            <div class="sticker-item">Рекомендуем</div>
        </div>
        <div class="row-mobile-select">
            <div class="mobile__select my-select">
                <span class="result">Перейти в</span>
                <ul class="result-list">
                    <li class="default"><a href="/article/boxoffice/">Бокс-офис</a></li>
                    <li class="default"><a href="/reviews/">Рецензии</a></li>
                    <li class="default"><a href="/article/anticipation/">Ожидания</a></li>
                    <li class="default"><a href="/article/reason/">Был бы повод...</a></li>
                </ul>
            </div>
        </div>
        <div class="outer-section-mini-prewiew-item clear">

            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $box['id'] ?>/"><?= $box['title'] ?></a>
                            <?php if (0 < $box['comment']): ?>
                                <a href="/article/<?= $box['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $box['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $review['id'] ?>/"><?= $review['title'] ?></a>
                            <?php if (0 < $review['comment']): ?>
                                <a href="/article/<?= $review['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $review['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $wait['id'] ?>/"><?= $wait['title'] ?></a>
                            <?php if (0 < $wait['comment']): ?>
                                <a href="/article/<?= $wait['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $wait['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $be['id'] ?>/"><?= $be['title'] ?></a>
                            <?php if (0 < $be['comment']): ?>
                                <a href="/article/<?= $be['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $be['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
