<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.08.2017
 * Time: 22:23
 * @var $options \Kinomania\System\Options\Options
 */
use Kinomania\Control\Template\Menu;

?>
<!-- extends base.html.php -->
<link rel="stylesheet" href="/vendor/cms/datatable-bootstrap/css/dataTables.alternative.min.css">
<style>
	.link {
		position: relative;
		top: 1px;
	}
	
	.dataTables_wrapper table tr td {
		border: 0;
	}
</style>

<div class="content-heading">
	Выберите страницу
</div>

<div class="row">
	<div class="col-lg-10 col-sm-12 col-xs-12">
		<div class="panel panel-default">
			<div class="panel-wrapper">
				<div class="panel-body">
					<form method="post">
						<div class="dataTables_wrapper">
							<table class="table table-responsive">
								<colgroup>
									<col width="50px">
									<col width="auto">
								</colgroup>
								<tr>
									<th></th>
									<th></th>
								</tr>
								<?
								$arr = ['seo/main' => 'Главная',
									'seo/news' => 'Новости',
									'seo/top_films' => 'Топ фильмов',
									'seo/trailers' => 'Трейлеры',
									'seo/tv' => 'ТВ',
									'seo/releases/russia' => 'График премьер РФ',
									'seo/releases/usa' => 'График премьер США',
									'seo/shorts' => 'SHORTS',
									'seo/reviews' => 'Рецензии',
									'seo/interview' => 'Интервью',
									'seo/press_review' => 'Пресс-обзор',
									'seo/anticipation' => 'Ожидания',
									'seo/inside' => 'Инсайд',
									'seo/awards' => 'Фестивали и премии',
									'seo/movie_memorial' => 'BOOOM!!',
									'seo/scripts' => 'Все сценарии',
									'seo/posters' => 'Постеры',
									'seo/soundtracks' => 'Саундтреки',
									'seo/photos' => 'Фотографии',
									'seo/films' => 'Обои к фильмам',
									'seo/actors' => 'Обои к актерам',
									'seo/actresses' => 'Обои к актрисам',
									'seo/top' => 'Подборки киномании',
									'seo/boxoffice' => 'Бокс-офис',
									'seo/boxoffice/russia' => 'Сборы в РФ',
									'seo/boxoffice/cis' => 'Сборы в СНГ',
									'seo/boxoffice/usa' => 'Сборы в США']
								?>
								<tr>
									<? $i = 0;
									foreach($arr as $value => $key):$i++ ?>
									<td>
										<a href="/control/<?=$value;?>"><?=$key;?></a>
									</td>
									<? if($i == 4):?>
								</tr>
								<tr>
									<? $i = 0;?>
									<? endif;?>
									<? endforeach;?>
								</tr>
								<!--<tr>
                                    <td>Title</td>
                                    <td>
                                        <input type="text" name="title" value="<?=$options->get('seo_main_title')?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>
                                        <input type="text" name="description" value="<?=$options->get('seo_main_description')?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Keywords</td>
                                    <td>
                                        <input type="text" name="keywords" value="<?=$options->get('seo_main_keywords')?>" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>H1</td>
                                    <td>
                                        <input type="text" name="h1" value="<?=$options->get('seo_main_h1')?>" class="form-control">
                                    </td>
                                </tr>-->
							</table>
						</div>
						<br/>
						<!--<input type="hidden" name="handler" value="save" />
						<input type="submit" class="btn btn-primary" value="Сохранить" />-->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
