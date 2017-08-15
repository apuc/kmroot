<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var array $list
 */
?>
<!-- extends base.html.php -->

<div class="content-heading">
    Киномания
</div>

<div class="row">
    <div class="col-lg-10 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-wrapper">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <!-- START widget-->
                            <div class="panel widget bg-primary">
                                <div class="row row-table">
                                    <div class="col-xs-4 text-center bg-primary-dark pv-lg">
                                        <em class="fa fa-film fa-3x"></em>
                                    </div>
                                    <div class="col-xs-8 pv-lg">
                                        <div class="h2 mt0"><?= number_format($list['film'], 0, '', ' ') ?></div>
                                        <div class="text-uppercase">film</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <!-- START widget-->
                            <div class="panel widget bg-purple">
                                <div class="row row-table">
                                    <div class="col-xs-4 text-center bg-purple-dark pv-lg">
                                        <em class="fa fa-users fa-3x"></em>
                                    </div>
                                    <div class="col-xs-8 pv-lg">
                                        <div class="h2 mt0"><?= number_format($list['person'], 0, '', ' ') ?></div>
                                        <div class="text-uppercase">person</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- START widget-->
                            <div class="panel widget bg-green">
                                <div class="row row-table">
                                    <div class="col-xs-4 text-center bg-green-dark pv-lg">
                                        <em class="fa fa-pencil fa-3x"></em>
                                    </div>
                                    <div class="col-xs-8 pv-lg">
                                        <div class="h2 mt0"><?= number_format($list['news'], 0, '', ' ') ?></div>
                                        <div class="text-uppercase">news</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <!-- START date widget-->
                            <div class="panel widget">
                                <div class="row row-table">
                                    <div class="col-xs-4 text-center bg-green pv-lg">
                                        <em class="icon-users fa-3x"></em>
                                    </div>
                                    <div class="col-xs-8 pv-lg">
                                        <div class="h2 mt0"><?= number_format($list['user'], 0, '', ' ') ?></div>
                                        <div class="text-uppercase">user</div>
                                    </div>
                                </div>
                            </div>
                            <!-- END date widget    -->
                        </div>
                    </div>
                    <form method="post">
                        <input type="submit" class="btn btn-default" value="Update" />
                        <input type="hidden" name="handler" value="update" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>