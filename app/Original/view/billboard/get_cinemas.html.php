<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.10.2017
 * Time: 14:30
 */
?>

<strong style="font-size: 34px;">Кинотеатры г.
    <?= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<div id="block">
    <table class="table">
        <thead>
        <tr>
            <td><strong>Кинотеатр:</strong></td>
            <td><strong>Адрес:</strong></td>
        </tr>
        </thead>
        <tbody class="film__table">
        <?php foreach ($cinema as $place): ?>
            <tr>
                <td valign="bottom">
								                    <span class="anchor-cube">
								                    </span>
                    <a href="/billboard/cinema?id=<?= $place->ObjectID ?>">
                        <?= $place->Name ?>
                    </a>
                </td>
                <td valign="bottom">
                    <?= $place->Address ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
