<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var \Kinomania\Control\Person\Item $item
 */
?>

<a href="<?= $request->makeUrl('person/edit?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/edit')): ?> active <?php endif ?>">Основное</a>
&nbsp;
<a href="<?= $request->makeUrl('person/credits?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/credits')): ?> active <?php endif ?>">Фильмография</a>
&nbsp;
<a href="<?= $request->makeUrl('person/photo?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/photo')): ?> active <?php endif ?>">Фотографии <?= $item->photo() ?></a>
&nbsp;
<a href="<?= $request->makeUrl('person/wallpaper?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/wallpaper')): ?> active <?php endif ?>">Обои <?= $item->wallpaper() ?></a>
&nbsp;
<a href="<?= $request->makeUrl('person/video?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/video')): ?> active <?php endif ?>">Видео <?= $item->video() ?></a>
&nbsp;
<a href="<?= $request->makeUrl('person/parse?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/parse')): ?> active <?php endif ?>">Парсить</a>
<?php if ($item->casting()): ?>
    &nbsp;
    <a href="<?= $request->makeUrl('person/casting?id=' . $item->id()) ?>/" class="btn btn-xs btn-warning <?php if (false !== strpos($request->route(), 'person/casting')): ?> active <?php endif ?>">Кастинг</a>
<?php endif ?>
