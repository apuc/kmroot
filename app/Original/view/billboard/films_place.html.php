<strong style="font-size: 34px;"><?=$_GET['name']?>
<!--	г.-->
<?//= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<div id="block" >
    <table class="table">
        <thead>
        <tr>
            <td><strong>Кинотеатры:</strong></td>
        </tr>
        </thead>
        <tbody class="film__table">
        <?php foreach ($films_place as $film => $item):?>
            <tr>
                <td valign="bottom">
                    <span class="anchor-cube">
                    </span>
                        <?=$film?>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>