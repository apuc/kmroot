<?php
/**
 * @var array $list
 */
use Kinomania\Original\Key\Casting\Company as Company;
?>
<aside class="main-aside col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="section-gray layout outer-aside">
        <div class="aside-branding no-mobile">
              <!--#include virtual="/design/ssi/right_top" -->
        </div>

        <div class="aside-item aside-item-agency">
            <div class="aside__title">АКТЕРСКИЕ АГЕНТСТВА</div>
            <div class="row-table-aside">
                <?php foreach ($list['company'] as $item): ?>
                    <div class="table-aside-item">
                        <div class="table-aside-inner-item table-aside-name"><a href="/company/<?= $item[Company::ID] ?>/"><?= $item[Company::NAME] ?></a></div>
                        <div class="table-aside-inner-item table-aside-value"><?= $item[Company::MALE] ?></div>
                        <div class="table-aside-inner-item table-aside-value2"><?= $item[Company::FEMALE] ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php if (count($list['promo'])): ?>
            <div class="aside no-mobile">
                <div class="inner-aside">
                    <div class="aside-item ">
                        <div class="aside__title">Промо</div>
                        <div class="row-posters__image">
                            <a href="/people/<?= $list['promo'][0][Person::ID] ?>/">
                                <div class="image-shadow-poster posters__image">
                                    <img alt="" src="<?= $list['promo'][0][Person::IMAGE] ?>" class="parent responsive-image image-prewiew">
                                </div>
                            </a>
                        </div>
                        <div class="bxslider-part-title"><a href="/people/<?= $list['promo'][0][Person::ID] ?>/"><?= $list['promo'][0][Person::NAME] ?></a></div>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div class="aside">
            <div class="inner-aside inner-aside-billboards">
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