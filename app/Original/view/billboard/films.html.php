<strong style="font-size: 34px;">Фильмы г.
<?= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<div id="block" >
    <table class="table">
        <thead>
        <tr>
            <td><strong>Фильмы:</strong></td>
	        <td><strong>Заказать билеты:</strong></td>
        </tr>
        </thead>
        <tbody class="film__table">
	        <?php foreach ($films as $film):?>
	            <tr>
	                <td valign="bottom">
	                    <span class="anchor-cube">
	                    </span>
	                        <a data-id="<?=$film->ObjectID?>" data-name="<?=$film->Name?>" href="#" id="film">
		                        <?=$film->Name?>
	                        </a>
	                </td>
		            <td>
					<!-- Start Ticket widget-->
		                <rb:schedule key="55b5814d-8c7e-4c67-95ac-8d583eae8c9a" classType="place" objectID="<?=$film->ObjectID?>" cityID="<?= $places[0]->CityID ?>" filter="" locale="" xmlns:rb="http://kassa.rambler.ru">
		                </rb:schedule>
	                </td>
	            </tr>
	        <?php endforeach;?>
        </tbody>
    </table>
</div>
<!--End Ticket widget-->
<script type="text/javascript" src="https://kassa.rambler.ru/s/widget/js/TicketManager.js"></script>