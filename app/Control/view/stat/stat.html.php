<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $routeList
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">Статистика</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <p>
                        По умолчанию доступ к странице открыт.
                    </p>
                    <p>
                        Если заданы права доступа, то они переопределяются в таком порядке:
                        <ol>
                        <li>Права `Вне групп`</li>
                        <li>Права группы</li>
                        <li>Права администратора</li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>