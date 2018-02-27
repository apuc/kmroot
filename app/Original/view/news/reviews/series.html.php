<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 15.01.2018
 * Time: 11:07
 */
/**
 * @var array $series
 * @var string $list
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Original\Key\News\Preview as News;
use Kinomania\System\Body\BodyScript;
?>
<div class="outer-pagelist-item clear">
	<?php foreach ($list as $item): ?>
		<section class="pagelist-item clear">
			<div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<div class=" image-shadow ">
					<a href="/article/<?= $item[News::ID] ?>/"><img width="263" height="261" alt="" src="//:0" data-original="<?= $item[News::IMAGE] ?>" class="lazy image-prewiew"></a>
				</div>
			</div>
			<div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<?php if (empty($item[News::NAME_RU])): ?>
					<div class="pagelist-item-title reviews-pagelist-item-title">
						<a href="/film/<?= $item[News::FILM_ID] ?>">
							<?= $item[News::NAME_ORIGIN] ?>
						</a>
					</div>
					<div class="reviews-pagelist-dop-title">
						<span></span>
					</div>
				<?php else :?>
					<div class="pagelist-item-title reviews-pagelist-item-title">
						<a href="/film/<?= $item[News::FILM_ID] ?>">
							<?= $item[News::NAME_RU] ?>
						</a>
					</div>
					<div class="reviews-pagelist-dop-title">
						<span><?= $item[News::NAME_ORIGIN] ?></span>
					</div>
				<?php endif ?>
				
				<ul class="reviews-list">
					<li class="city">
						<?= $item[News::COUNTRY] ?>
						<?php if (!empty($item[News::YEAR])): ?>
							<?= $item[News::YEAR] ?>
						<?php endif ?>
					</li>
					<?php if (count($item[News::DIRECTOR])): ?>
						<li class="producer">Режиссер: <span class="producer__result">
	                                                <?php foreach ($item[News::DIRECTOR] as $person): ?>
		                                                <a href="/people/<?= $person[0] ?>/"><?= $person[1] ?></a>
	                                                <?php endforeach; ?>
	                                            </span></li>
					<?php endif ?>
					<?php if (count($item[News::CAST])): ?>
						<li class="role">В ролях: <span class="producer__result">
	                                                <?php foreach ($item[News::CAST] as $person): ?>
		                                                <a href="/people/<?= $person[0] ?>/"><?= $person[1] ?></a>
	                                                <?php endforeach; ?>
	                                            </span></li>
					<?php endif ?>
				</ul>
				<div class="pagelist-info">
					<?php if (!empty($item[News::LOGIN])): ?>
						<span class="pagelist__author"><a href="/user/<?= $item[News::LOGIN] ?>/"><?= $item[News::NAME] ?></a></span>,
					<?php endif; ?>
					<span class="date__month"><?= $item[News::PUBLISH] ?></span>
					<?php if (!empty($item[News::COMMENT])): ?>
						<a href="/article/<?= $item[News::ID] ?>#commentList/" class="pagelist__comments"><?= $item[News::COMMENT] ?></a>
					<?php endif ?>
				</div>
				<a href="/article/<?= $item[News::ID] ?>/" class="pagelist__link">Подробнее</a>
			</div>
		</section>
	<?php endforeach; ?>
</div>
</div>
<div id="series_block">
	<div class="outer-pagelist-more">
		<div class="center-loader" style="display: none;">
			<div class="ball-clip-rotate-multiple"><div></div><div></div></div>
		</div>
		<span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("img.lazy").lazyload({
			effect : "fadeIn"
		});

		window.page = 1;
		$('#more').click(function(){
			var me = $(this);
			if (me.data('requestRunning')) {
				return;
			}
			me.data('requestRunning', true);

			$('.center-loader').show();
			$('.pagelist-more').hide();
			window.page += 1;
			var page = window.page;

			$("img.lazy").attr('proc', 'true');

			$.ajax({
				"type": "post",
				"url": "?handler=getPageSeries&page=" + page,
				"success": function(data){
					data = JSON.parse(data);
					for (var key in data) {
						if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
							var html = '<section class="pagelist-item clear">' +
								'<div class="pagelist-item-image all-pagelist-item-image  col-xl-5 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
								'<div class=" image-shadow ">' +
								'<a href="/article/' + data[key][<?= News::ID ?>] + '/"><img width="263" height="261" alt="" src="//:0" data-original="' + data[key][<?= News::IMAGE ?>] + '" class="lazy image-prewiew"></a>' +
								'</div>' +
								'</div>' +
								'<div class="pagelist-item-content all-pagelist-item-content pagelist-item-content col-xl-7 col-lg-6 col-md-6 col-sm-12 col-xs-12">';
							if ('' == data[key][<?= News::NAME_RU ?>]) {
								html += '<div class="pagelist-item-title reviews-pagelist-item-title">' +
									'<a href="/film/' + data[key][<?= News::FILM_ID ?>] + '">' +
									data[key][<?= News::NAME_ORIGIN ?>] +
									'</a>' +
									'</div>' +
									'<div class="reviews-pagelist-dop-title">' +
									'<span></span>' +
									'</div>';
							} else {
								html += '<div class="pagelist-item-title reviews-pagelist-item-title">' +
									'<a href="/film/' + data[key][<?= News::FILM_ID ?>] + '">' +
									data[key][<?= News::NAME_RU ?>] +
									'</a>' +
									'</div>' +
									'<div class="reviews-pagelist-dop-title">' +
									'<span>' + data[key][<?= News::NAME_ORIGIN ?>] + '</span>' +
									'</div>';
							}
							html += '<ul class="reviews-list">' +
								'<li class="city">' +
								data[key][<?= News::COUNTRY ?>];
							if ('' != data[key][<?= News::YEAR ?>]) {
								html += data[key][<?= News::YEAR ?>];
							}
							html += '</li>';
							if (0 < data[key][<?= News::DIRECTOR ?>].length) {
								html += '<li class="producer">Режиссер: <span class="producer__result">';
								for (var k in data[key][<?= News::DIRECTOR ?>]) {
									if (data[key][<?= News::DIRECTOR ?>].hasOwnProperty(k)) {
										html += '<a href="/people/' + data[key][<?= News::DIRECTOR ?>][k][0] + '/">' + data[key][<?= News::DIRECTOR ?>][k][1] + '</a>';
									}
								}
								html += '</span></li>';
							}
							if (0 < data[key][<?= News::CAST ?>].length) {
								html += '<li class="role">В ролях: <span class="producer__result">';
								for (var kk in data[key][<?= News::CAST ?>]) {
									if (data[key][<?= News::CAST ?>].hasOwnProperty(kk)) {
										html += '<a href="/people/' + data[key][<?= News::CAST ?>][kk][0] + '/">' + data[key][<?= News::CAST ?>][kk][1] + '</a>';
									}
								}
								html += '</span></li>';
							}
							html += '</ul>' +
								'<div class="pagelist-info">';
							if ('' != data[key][<?= News::LOGIN ?>]) {
								html += '<span class="pagelist__author"><a href="/user/' + data[key][<?= News::LOGIN ?>] + '/">' + data[key][<?= News::NAME ?>] + '</a></span>, ';
							}
							html += '<span class="date__month">' + data[key][<?= News::PUBLISH ?>] + '</span>';
							if (0 < data[key][<?= News::COMMENT ?>]) {
								html += '<a href="/article/' + data[key][<?= News::ID ?>] + '#commentList/" class="pagelist__comments">' + data[key][<?= News::COMMENT ?>] + '</a>';
							}
							html += '</div>' +
								'<a href="/article/' + data[key][<?= News::ID ?>] + '/" class="pagelist__link">Подробнее</a>' +
								'</div>' +
								'</section>';

							$('.outer-pagelist-item').append(html);
						}
					}

					$("img.lazy[proc!=true]").lazyload({
						effect : "fadeIn"
					});
					$("img.lazy").attr('proc', 'true');

					if (1 > data.length) {
						$('.pagelist-more').hide();
					} else {
						$('.pagelist-more').show();
					}
				},
				complete: function() {
					me.data('requestRunning', false);
					$('.center-loader').hide();
				}
			});
		});
	});
</script>