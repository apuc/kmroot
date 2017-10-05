<?php if(!empty($list)): ?>
    <?php // Kinomania\System\Debug\Debug::prn($list) ?>
    <?php foreach ($list as $item): ?>
        <?php $offset++ ?>
        <div class="session-table-item table-top-item clear">
            <div class="table-top-info-one">
                <div class="table-number"><?= $offset ?></div>
                <div class="session-table-item__name">
                    <?php if ('' == $item['name_ru']): ?>
                        <div class="table-top-title"><a href="/film/
							                                <?= $item['id'] ?>/"><?= $item['name_origin'] ?></a>
                        </div>
                    <?php else: ?>
                        <div class="table-top-title">
                            <a href="/film/<?= $item['id'] ?>/">
                                <?= $item['name_ru'] ?></a>
                        </div>
                        <div class="table-top-title-eng">
                            <?= $item['name_origin'] ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="table-top-info">
                <div class="row-button-list">
                </div>
                <span class="table-top-info-text table-top-info-raiting">
		                                <?= $item['rate'] ?></span>
                <div class="table-top-info-text table-top-info-views open-help-in"><?= $item['rate_count'] ?>
                    <div class="help help--gray">Количество оценок</div>
                </div>
                <div class="main-folder-icon">
                    <div class="parent-dropdown-folder row-icon-add row-icon-add--white icon-folder collectFilm">
                        <a class="folder__icon icon"></a>
                        <div class="hint">Добавить в Избранное</div>
                        <div class="row-dropdown-folder">
                            <div class="dropdown-folder dropdown-folder-content">
                                <div class="dropdown-folder-title"><span>В избранное</span></div>
                                <ul class="dropdown-folder-list" data-id="<?= $item['id'] ?>"></ul>
                            </div>
                            <div class="dropdown-folder dropdown-folder-setting">
                                <a href="#" class="clear">
                                    <i class="setting-icon"></i>
                                    <span>Управление папками</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
    <h1><?= 'Ничего не найдено'?></h1>
<?php endif;?>

<?php $pagination = New \Kinomania\System\Pagination\Pagination($itemCount, $page)?>
<?php $pagination->printPag()?>
