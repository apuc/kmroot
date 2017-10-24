<strong style="font-size: 34px;">Фильмы г.
<?= \Kinomania\System\GeoLocation\IpGeoBase::getCityInfo()['city'] ?>
</strong>
<div id="block" >
    <table class="table">
        <thead>
	        <tr>
	            <td><strong>Фильмы:</strong></td>
	        </tr>
        </thead>
    </table>
	<div  class="block__films">
	    <?php foreach ($films as $film):?>
	        <div class="block__film">
	            <a data-id="<?=$film->ObjectID?>" data-name="<?=$film->Name?>" data-img="<?=$film->Thumbnail?>" href="#" id="film">
		            <div class="block__film__img">
	                    <img src="<?=$film->Thumbnail?>">
	                 </div>
		            <p>
			            <?=$film->Genre?>
		            </p>
		                <span>
		                    <?=$film->Name?>
		                </span>
		            <p>Премьера(РФ): <?=$film->ReleaseDate?></p>
	            </a>
	        </div>
	    <?php endforeach;?>
	</div>
</div>
<!--End Ticket widget-->
