<?php
/**
 * @var string $static
 * @var array $list
 * @var string $date
 * @var string $current
 */
?>
<!-- Дни рождения -->
<link rel="stylesheet" href="http://fs.kinomania.ru/vendor/cms/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

<section class="outer-content-item content-item-dop">
    <div class="content-item-dop-title">
        <i class="icon-date sprite-before"></i>
        <a class="content-item-dop-date"><?= $current ?></a>
        <span>В ЭТОТ ДЕНЬ РОДИЛИСЬ</span>
        <div class="outer-calendar default">
            <input type="text" name="calendar_birthday" id="calendar_birthday" style="display: none" />
        </div>
    </div>
    <div class="content-item-dop-section">
        <div class="happy-carousel">
            <?php foreach ($list as $item): ?>
                <div class="item">
                    <div class="row-item-image image-shadow">
                        <a href="/people/<?= $item['id'] ?>/"><img alt="" src="<?= $item['image'] ?>" class="item-image image-prewiew"></a>
                    </div>
                    <div class="item-text">
                        <div class="item-text-title">
                            <a href="/people/<?= $item['id'] ?>/"><?= $item['name'] ?></a>
                        </div>
                        <div class="item-text-date">
                            <span><?= $item['birthday'] ?></span>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<script src="http://fs.kinomania.ru/vendor/cms/moment/min/moment-with-locales.min.js"></script>
<script src="http://fs.kinomania.ru/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script src="http://fs.kinomania.ru/vendor/cms/eonasdan-bootstrap-datetimepicker/build/js/ru.js"></script>