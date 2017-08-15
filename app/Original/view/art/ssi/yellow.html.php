<?php
/**
 * @var array $review
 * @var array $interview
 * @var array $movie_memorial
 * @var array $shorts
 */
?>
<section class="inner-content outer-content-item parent-sticker outer-section-mini-prewiew art-yellow">
    <div class="section-mini-prewiew section-mini-prewiew--yellow">
        <div class="outer-section-mini-prewiew-list">
            <ul class="section-mini-prewiew-list clear">
                <li>
            <span>
                <a href="/art/reviews/">
                    Рецензии
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/article/interview/">
                    Интервью
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/article/movie_memorial/">
                    Booom!!
                </a>
            </span>
                </li>
                <li>
            <span>
                <a href="/article/shorts/">
                    Shortы
                </a>
            </span>
                </li>
            </ul>
        </div>
        <div class="outer-section-mini-prewiew-item clear">
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
                        <a href="/article/<?= $interview['id'] ?>/"><img alt="" src="//:0" data-original="<?= $interview['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $interview['id'] ?>/"><?= $interview['title'] ?></a>
                            <?php if (0 < $interview['comment']): ?>
                                <a href="/article/<?= $interview['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $interview['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $movie_memorial['id'] ?>/"><img alt="" src="//:0" data-original="<?= $movie_memorial['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $movie_memorial['id'] ?>/"><?= $movie_memorial['title'] ?></a>
                            <?php if (0 < $movie_memorial['comment']): ?>
                                <a href="/article/<?= $movie_memorial['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $movie_memorial['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <a href="/article/<?= $shorts['id'] ?>/"><img alt="" src="//:0" data-original="<?= $shorts['image'] ?>" class="lazy section-mini-prewiew-item__image"></a>
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $shorts['id'] ?>/"><?= $shorts['title'] ?></a>
                            <?php if (0 < $shorts['comment']): ?>
                                <a href="/article/<?= $shorts['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $shorts['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="sticker">
        <div class="sticker-item">РЕКОМЕНДУЕМ</div>
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
                    <li class="default"><a href="/art/reviews/">Рецензии</a></li>
                    <li class="default"><a href="/article/interview/">Интервью</a></li>
                    <li class="default"><a href="/article/movie_memorial/">Booom!!</a></li>
                    <li class="default"><a href="/article/shorts/">Shortы</a></li>
                </ul>
            </div>
        </div>
        <div class="outer-section-mini-prewiew-item clear">

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
                            <a href="/article/<?= $interview['id'] ?>/"><?= $interview['title'] ?></a>
                            <?php if (0 < $interview['comment']): ?>
                                <a href="/article/<?= $interview['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $interview['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $movie_memorial['id'] ?>/"><?= $movie_memorial['title'] ?></a>
                            <?php if (0 < $movie_memorial['comment']): ?>
                                <a href="/article/<?= $movie_memorial['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $movie_memorial['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="inner-section-mini-prewiew-item">
                <div class="section-mini-prewiew-wrap-item">
                    <div class="section-mini-prewiew-item">
                        <div class="section-mini-prewiew-item-text">
                            <a href="/article/<?= $shorts['id'] ?>/"><?= $shorts['title'] ?></a>
                            <?php if (0 < $shorts['comment']): ?>
                                <a href="/article/<?= $shorts['id'] ?>#commentList/" class="content-item-info-comment sprite-before"><?= $shorts['comment'] ?></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>