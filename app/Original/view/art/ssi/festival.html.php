<?php
/**
 * @var array $list
 */
?>

<?php foreach ($list as $k => $item): ?>
    <div class="art-awards-item art-awards-item-with-text clear">
        <div class="art-awards-image">
            <img src="<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/icon/award/<?= $item['id'] ?>.jpg" alt="<?= $item['name_ru'] ?>">
        </div>
        <div class="art-awards-content">
            <div class="art-awards__title"><a href="/awards/<?= $item['code'] ?>/"><?= $item['name_ru'] ?></a></div>
            <div class="art-awards__title-eng"><?= $item['name_en'] ?></div>
            <?php if (0 == $k): ?>
                <div class="art-awards__date">
                    <?php if (!empty($item['from'])): ?>
                        <span class="art-awards__date-from"><?= $item['from'] ?></span> — 
                    <?php endif ?>
                    <?php if (!empty($item['to'])): ?>
                        <span class="art-awards__date-from"><?= $item['to'] ?></span>
                    <?php endif ?>
                </div>
            <?php endif ?>
            <div class="art-awards__caption">
                <?php if (0 == $k): ?>
                    <?= $item['description'] ?>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="sticker">
    <div class="sticker-item">ФЕСТИВАЛИ И ПРЕМИИ</div>
</div>

<div class="outer-pagelist-more">
    <a href="/awards/">
    <span class="pagelist-more sprite-before"><span class="pagelist-more__text">Еще</span></span>
    </a>
</div>