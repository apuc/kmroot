<?php
/**
 * @var string $login
 */
?>
<aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside">
            <div class="inner-aside inner-aside-billboards">
                <div class="aside-item">
                    <div class="aside__title" id="collectionTitle">КОЛЛЕКЦИИ <?= $login ?></div>
                    <div class="row-select-folder">
                        <ul class="select-folder-list" id="userFolderList">
                            <div class="center-loader" style="margin-top: 10px;">
                                <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                                <br />
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="aside-item ">
                    <!--#include virtual="/index/ssi/new" -->
                </div>
                <div class="aside-item leaders no-mobile">
                    <!--#include virtual="/index/ssi/boxoffice" -->
                </div>
            </div>
        </div>
        <div class="dop-aside no-mobile">
            <div class=" outer-aside-treilers">
                <div class="dop-aside__treilers">
                    <!--#include virtual="/index/ssi/popular" -->
                </div>
            </div>
            <div class="dop-aside__item outer-dop-aside__banner">
                <div class="dop-aside__banner">
                      <!--#include virtual="/design/ssi/right_bottom" -->
                </div>
            </div>
        </div>
    </div>
</aside>