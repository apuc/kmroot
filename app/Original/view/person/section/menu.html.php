<?php
/**
 * @var int $id
 * @var \Dspbee\Core\Request $request
 * @var array $stat
 */
use \Kinomania\Original\Key\Person\Stat;
?>
<ul class="nav-content-list clear nav-content-list-actor">
    <div class="mobile__select my-select">
        <span class="result">КИНО</span>
        <ul class="result-list">
            <li class="nav-content-item default <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="#">Фильмография</a></li>
            <li class="nav-content-item default <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

            <?php if (0 < $stat[Stat::PHOTO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::WALLPAPER]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::FRAME]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::VIDEO]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::AWARD]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span>/a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::NEWS]): ?>
                <li class="nav-content-item default <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>
    <li class="nav-content-item <?php if ('people/' . $id == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id ?>/">Фильмография</a></li>
    <li class="nav-content-item <?php if ('people/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id  . '/reviews'?>/">Отзывы</a></li>

    <?php if (0 == $stat[Stat::PHOTO]): ?>
        <li class="nav-content-item no-active"><span>Фото</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/photos' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/photos' ?>/">Фото <span class="number"><?= $stat[Stat::PHOTO] ?></span> </a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::WALLPAPER]): ?>
        <li class="nav-content-item no-active"><span>Обои</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/wallpapers' ?>/">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::FRAME]): ?>
        <li class="nav-content-item no-active"><span>Кадры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/frames' ?>/">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::VIDEO]): ?>
        <li class="nav-content-item no-active"><span>Видео</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/trailers' ?>/">Видео <span class="number"><?= $stat[Stat::VIDEO] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::AWARD]): ?>
        <li class="nav-content-item no-active"><span>Награды</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/awards' ?>/">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::NEWS]): ?>
        <li class="nav-content-item no-active"><span>Новости</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('people/' . $id . '/news' == $request->route()): ?> active <?php endif ?>"><a href="<?= '/people/' . $id . '/news' ?>/">Новости <span class="number"><?= $stat[Stat::NEWS] ?></span></a></li>
    <?php endif ?>
</ul>