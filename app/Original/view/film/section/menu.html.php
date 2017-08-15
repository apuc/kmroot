<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var int $id
 * @var array $stat
 */
use Kinomania\Original\Key\Film\Stat as Stat;
?>
<ul class="nav-content-list nav-content-list-films clear" id="filmMenu">
    <div class="mobile__select my-select">
        <span class="result"></span>
        <ul class="result-list">
            <li class="nav-content-item <?php if ('film/' . $id == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/">О фильме</a></li>
            <li class="nav-content-item <?php if ('film/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/reviews#filmMenu">Рецензии<span class="number"></span></a></li>
            <li class="nav-content-item <?php if ('film/' . $id . '/people' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/people#filmMenu">Актеры и создатели<span class="number"></span></a></li>

            <?php if (0 < $stat[Stat::FRAME]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/frames#filmMenu">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::WALLPAPER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/wallpapers#filmMenu">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::TRAILER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/trailers#filmMenu">Трейлеры <span class="number"><?= $stat[Stat::TRAILER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::SOUNDTRACK]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/soundtracks' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/soundtracks#filmMenu">Саундтреки <span class="number"><?= $stat[Stat::SOUNDTRACK] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::POSTER]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/posters' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/posters#filmMenu">Постеры <span class="number"><?= $stat[Stat::POSTER] ?></span></a></li>
            <?php endif ?>

            <?php if (0 < $stat[Stat::AWARD]): ?>
                <li class="nav-content-item <?php if ('film/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/awards#filmMenu">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>

    <li class="nav-content-item <?php if ('film/' . $id == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/">О фильме</a></li>
    <li class="nav-content-item <?php if ('film/' . $id . '/reviews' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/reviews#filmMenu">Рецензии<span class="number"></span></a></li>
    <li class="nav-content-item <?php if ('film/' . $id . '/people' == $request->route() || 'film/' . $id . '/people/creators' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/people#filmMenu">Актеры и создатели<span class="number"></span></a></li>

    <?php if (0 == $stat[Stat::FRAME]): ?>
        <li class="nav-content-item no-active"><span>Кадры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/frames' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/frames#filmMenu">Кадры <span class="number"><?= $stat[Stat::FRAME] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::WALLPAPER]): ?>
        <li class="nav-content-item no-active"><span>Обои</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/wallpapers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/wallpapers#filmMenu">Обои <span class="number"><?= $stat[Stat::WALLPAPER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::TRAILER]): ?>
        <li class="nav-content-item no-active"><span>Трейлеры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/trailers' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/trailers#filmMenu">Трейлеры <span class="number"><?= $stat[Stat::TRAILER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::SOUNDTRACK]): ?>
        <li class="nav-content-item no-active"><span>Саундтреки</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/soundtracks' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/soundtracks#filmMenu">Саундтреки <span class="number"><?= $stat[Stat::SOUNDTRACK] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::POSTER]): ?>
        <li class="nav-content-item no-active"><span>Постеры</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/posters' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/posters#filmMenu">Постеры <span class="number"><?= $stat[Stat::POSTER] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::AWARD]): ?>
        <li class="nav-content-item no-active"><span>Награды</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('film/' . $id . '/awards' == $request->route()): ?> active <?php endif ?>"><a href="/film/<?= $id ?>/awards#filmMenu">Награды <span class="number"><?= $stat[Stat::AWARD] ?></span></a></li>
    <?php endif ?>
</ul>