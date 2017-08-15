<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\News\Item $item
 */
?>

<style>
    .menu a {
        margin-top: 2px;
    }
</style>
<div class="menu">
    <a href="<?= $request->makeUrl('news/edit?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'news/edit')): ?> active <?php endif ?>">Основное</a>
    &nbsp;
    <a href="<?= $request->makeUrl('news/gallery?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'news/gallery')): ?> active <?php endif ?>">Галерея</a>
</div>