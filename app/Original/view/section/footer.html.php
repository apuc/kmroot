<?php
/**
 * @var string $static
 */
?>
<div class="footer">

    <!--<div class="overlay-location">-->
    <!--    <div class="location-window">-->
    <!---->
    <!--        <h1>Где вы находитесь?</h1>-->
    <!--        <span>введите название вашего города </span>-->
    <!--        <form role="form" class="location-form">-->
    <!--            <div class="location-form-wrapper">-->
    <!--                <input type="text" data-id="0" class="search-location" value="-->
    <? //= (isset($location['city'])) ? $location['city'] : '' ?><!-- test">-->
    <!--                <span class="loction-delete">X</span>-->
    <!--            </div>-->
    <!--            <a href="#" type="button" class="button button1 button-location">Сохранить</a>-->
    <!---->
    <!--        </form>-->
    <!---->
    <!--        <div class="location-form-result">-->
    <!--            <div class="result-items">Ивано-Франковск(Ивано-Франковская область)</div>-->
    <!--            <div class="result-items">Донецк </div>-->
    <!--            <div class="result-items">Симферополь </div>-->
    <!--            <div class="result-items">Ростов на Дону </div>-->
    <!--            <div class="result-items">Хмельницкий </div>-->
    <!--            <div class="result-items">Ростов на Дону </div>-->
    <!--        </div>-->
    <!---->
    <!--        <div class="search-location-result">-->
    <!--            <div class="search-loader">-->
    <!--                <div class="ball-clip-rotate-multiple"><div></div><div></div></div>-->
    <!--            </div>-->
    <!--            <div class="location-result">-->
    <!---->
    <!--            </div>-->
    <!--        </div>-->
    <!---->
    <!--    </div>-->
    <!--</div>-->

    <script type="text/javascript">
        $(document).ready(function () {
            var modal = document.getElementById('modalWrap');
            var span = document.getElementsByClassName("__close")[0];
            console.log(modal);
            <?php if (!isset($_COOKIE['city'])): ?>
                modal.style.display = "block";
            <?php endif; ?>
            span.onclick = function() {
                modal.style.display = "none";
            }
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>


    <div class="wrap">
        <div class="inner-footer">
            <a href="/casting/" class="footer-sticker button button2">КАСТИНГ-БАЗА</a>
            <div class="copy-paste">ИСПОЛЬЗОВАНИЕ МАТЕРИАЛОВ САЙТА ВОЗМОЖНО ТОЛЬКО С РАЗРЕШЕНИЯ РЕДАКЦИИ. ГИПЕРССЫЛКА НА
                САЙТ ОБЯЗАТЕЛЬНА
            </div>
            <div class="mail"><a href="mailto:INFO@KINOMANIA.RU/">INFO@KINOMANIA.RU</a></div>
            <div class="footer-nav">
                <div class="outer-footer-nav-list">
                    <a href="/billboard/">СМОТРЕТЬ</a>
                    <ul class="footer-nav-list">
                        <!--<li><a href="/billboard/">АФИША</a></li>-->
                        <li><a href="/tv/">ТВ</a></li>
                        <li><a href="/releases/russia/">СКОРО В КИНО</a></li>
                        <li><a href="/article/shorts/">SHORTЫ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/news/">ЧИТАТЬ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/news/">НОВОСТИ</a></li>
                        <li><a href="/article/interview/">ИНТЕРВЬЮ</a></li>
                        <li><a href="/reviews/">РЕЦЕНЗИИ</a></li>
                        <li><a href="/blog/">БЛОГИ</a></li>
                        <li><a href="/article/press_review/">ПРЕССА</a></li>
                        <li><a href="http://forum.kinomania.ru/">ФОРУМ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/art/">АРТКИНОМАНИЯ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/awards/">ФЕСТИВАЛИ И ПРЕМИИ</a></li>
                        <li><a href="/article/movie_memorial/">BOOOM!!</a></li>
                        <li><a href="/scripts/">СЦЕНАРИИ</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/trailers/">МЕДИА</a>
                    <ul class="footer-nav-list">
                        <li><a href="/trailers/">ТРЕЙЛЕРЫ</a></li>
                        <li><a href="/posters/">ПОСТЕРЫ</a></li>
                        <li><a href="/soundtracks/">САУНДТРЕКИ</a></li>
                        <li><a href="/photos/">ФОТО</a></li>
                        <li><a href="/wallpapers/films/">ОБОИ (ФИЛЬМЫ)</a></li>
                        <li><a href="/wallpapers/actors/">ОБОИ (АКТЕРЫ)</a></li>
                        <li><a href="/wallpapers/actresses/">ОБОИ (АКТРИСЫ)</a></li>
                    </ul>
                </div>
                <div class="outer-footer-nav-list">
                    <a href="/top/films/">ЛУЧШИЕ ФИЛЬМЫ</a>
                    <ul class="footer-nav-list">
                        <li><a href="/top/films/">РЕЙТИНГ КИНОМАНИИ</a></li>
                        <li><a href="/top/">ПОДБОРКИ</a></li>
                        <li><a href="/article/boxoffice/">БОКС-ОФИС</a></li>
                    </ul>
                </div>
            </div>
            <div class="outer-social clear">
                <ul class="social-list social-list--horizontal">
                    <li class="vk" id="vk_main_share"><a
                                href="http://vkontakte.ru/share.php?url=http%3A%2F%2Fkinomania.ru%2F/"><span
                                    class="number"></span></a></li>
                    <li class="fb" id="fb_main_share"><a
                                href="http://www.facebook.com/sharer.php?u=http%3A%2F%2Fkinomania.ru%2F&t=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU&src=sp/"><span
                                    class="number"></span></a></li>
                    <li class="ok" id="ok_main_share"><a
                                href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=http%3A%2F%2Fkinomania.ru%2F&st.comments=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span
                                    class="number"></span></a></li>
                    <li class="pinterest" id="pt_main_share"><a
                                href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fkinomania.ru%2F&description=%D0%9D%D0%BE%D0%B2%D0%B8%D0%BD%D0%BA%D0%B8%20%D0%BA%D0%B8%D0%BD%D0%BE%20%7C%20KINOMANIA.RU/"><span
                                    class="number"></span></a></li>
                </ul>
            </div>
            <div class="copyright">© KINOMANIA.RU, 2000—2017</div>
            <div class="metrica">
                <script type="text/javascript">
                    document.write('<a href="http://www.liveinternet.ru/click" ' +
                        'target=_blank><img src="http://counter.yadro.ru/hit?t20.3;r' +
                        escape(document.referrer) + ((typeof(screen) == 'undefined') ? '' :
                            ';s' + screen.width + '*' + screen.height + '*' + (screen.colorDepth ?
                                screen.colorDepth : screen.pixelDepth)) + ';u' + escape(document.URL) +
                        ';' + Math.random() +
                        '" title="LiveInternet: показано число просмотров за 24 часа, посетителей за 24 часа и за сегодн\я" ' +
                        'border=0 width=88 height=31></a>')
                </script>
            </div>
            <div class="planeta-inform"><a href="http://planeta-inform.tv//"><img alt="planeta inform"
                                                                                  src="<?= $static ?>/app/img/icon/pi.png"></a>
            </div>
        </div>
    </div>
</div>
<div id="modalWrap" class="modal">
    <div class="content">
        <span class="__close">&times;</span>
        <div class="content__title">
            <h2>Где вы находитесь?</h2>
            <p>введите название вашего города</p>
        </div>
        <form id="form" method="get">
            <div class="inputs">
                <?php $city = unserialize($_COOKIE['city'] ?? '') ?>
                <input type="text" data-id="<?= $city['city_id']?>" id="city" class="search-location" value="<?= $city['city']?>">
                <input type="submit" id="find-city" class="button-location" value="Сохранить">
            </div>
            <div class="cities">
                <div class="location-result"></div>
                <!--<div class="city">-->
                <!--    <a href="#">Симферополь</a>-->
                <!--    <a href="#">Суммы</a>-->
                <!--    <a href="#">Сургут</a>-->
                <!--</div>-->
                <!--<div class="city">-->
                <!--    <a href="#">Симферополь</a>-->
                <!--    <a href="#">Суммы</a>-->
                <!--    <a href="#">Сургут</a>-->
                <!--</div>-->
            </div>
        </form>
    </div>
</div>

<?php if (!empty($static)): ?>
    <noindex>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-34377221-1']);
            _gaq.push(['_setDomainName', 'kinomania.ru']);
            _gaq.push(['_setAllowLinker', true]);
            _gaq.push(['_trackPageview']);

            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>

        <script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter36442360 = new Ya.Metrika({
                            id: 36442360,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true,
                            webvisor: true
                        });
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                    s = d.createElement("script"),
                    f = function () {
                        n.parentNode.insertBefore(s, n);
                    };
                s.type = "text/javascript";
                s.async = true;
                s.src = "https://mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/36442360" style="position:absolute; left:-9999px;" alt=""/></div>
        </noscript>

        <script type="text/javascript">(window.Image ? (new Image()) : document.createElement('img')).src = location.protocol + '//vk.com/rtrg?r=n9YDAoQsS3qBs6nctL6/sKpAaXKqQUmWz2JpHbOhtVW5rhWj77lg8BM5v*ca1XNVEO*m9p9V91MVojo7t33gipPfdZYKcFC7OkNTn2ZZigqziiN0VdNuzic/Oypu7aH8tm72z7WYCQ0R9MPyR9F6pCDJnljbiMycdpE1KHtxV6I-';</script>


        <script>
            !function (f, b, e, v, n, t, s) {
                if (f.fbq)return;
                n = f.fbq = function () {
                    n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

            fbq('init', '130228840716894');
            fbq('track', "PageView");</script>
        <noscript><img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id=130228840716894&ev=PageView&noscript=1"/></noscript>


        <script language="JavaScript" type="text/javascript">
            //<!--
            d = document;
            var a = '';
            a += ';r=' + escape(d.referrer)
            js = 10//-->
        </script>
        <script language="JavaScript1.1" type="text/javascript">//<!--
            a += ';j=' + navigator.javaEnabled()
            js = 11//-->
        </script>
        <script language="JavaScript1.2" type="text/javascript">//<!--
            s = screen;
            a += ';s=' + s.width + '*' + s.height
            a += ';d=' + (s.colorDepth ? s.colorDepth : s.pixelDepth)
            js = 12//-->
        </script>
        <script language="JavaScript1.3" type="text/javascript">//<!--
            js = 13//-->
        </script>
        <script language="JavaScript" type="text/javascript">//<!--
            d.write('<a href="http://top.mail.ru/jump?from=94147"' +
                ' target=_top><img src="http://df.c6.b1.a0.top.list.ru/counter' +
                '?id=94147;t=51;js=' + js + a + ';rand=' + Math.random() +
                '" alt="Рейтинг@Mail.ru"' + ' border=0 height=31 width=88/><\/a>')
            //if(11<js)d.write('<'+'!-- ')//-->
        </script>
    </noindex>
<?php endif ?>
