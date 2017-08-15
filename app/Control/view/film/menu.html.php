<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Film\Item $item
 */
?>

<style>
    .menu a {
        margin-top: 2px;
    }
</style>
<div class="menu">
    <a href="<?= $request->makeUrl('film/edit?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/edit')): ?> active <?php endif ?>">Основное</a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/credits?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/credits')): ?> active <?php endif ?>">Фильмография</a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/sound?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/sound')): ?> active <?php endif ?>">Саундтреки <?= $item->soundtrack() ?></a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/poster?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/poster')): ?> active <?php endif ?>">Постеры <?= $item->poster() ?></a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/frame?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/frame')): ?> active <?php endif ?>">Кадры <?= $item->frame() ?></a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/wallpaper?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/wallpaper')): ?> active <?php endif ?>">Обои <?= $item->wallpaper() ?></a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/video?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/video')): ?> active <?php endif ?>">Видео <?= $item->trailer() ?></a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/box?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/box')): ?> active <?php endif ?>">Сборы</a>
    &nbsp;
    <a href="<?= $request->makeUrl('film/parse?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'film/parse')): ?> active <?php endif ?>">Парсить</a>
</div>