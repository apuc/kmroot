<?php
/**
 * @var string $login
 * @var string $static
 * @var array $list
 * @var array $min
 */
use Kinomania\Original\Key\User\User;
use Kinomania\System\Body\BodyScript;
?>
<!doctype html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Оценки пользователя <?= $login ?></title>

    <!-- include section/head.html.php -->
<body>
  <!--#include virtual="/design/ssi/top" -->
<div class="outer">
    <div class="wrap">
        <!-- include section/header.html.php -->
        <div class="banner">
              <!--#include virtual="/design/ssi/center" -->
        </div>
        <div class="main-content-other-page clear">
            <div class="head-content">
                <div class="info-user">
                    <h1 class="pagetitle mini__pagetitle login__user" id="login"><?= $login ?></h1>
                    <h2 class="name__page"><?= $min[User::NAME] ?> <?= $min[User::SURNAME] ?></h2>
                </div>
                <div class="nav-content">
                    <!-- include user/section/menu.html.php -->
                </div>
            </div>
            <section class="outer-section clear outer-content">
                <!-- Контент -->
                <content class="page-section-content profile-section-content section-content content-outercol-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">

                    <div class="list-content list-content-tile">
                        <div class="row-profile-raiting-content">
                            <div class="rating-profile">
                                <div class="rating-profile-item">
                                    <?php foreach ($list as $item): ?>
                                        <div class="rating-profile-item">
                                            <div class="section-result-content clear">
                                                <div class="section-result-item item1  list-preview">
                                                    <a href="/film/<?= $item[0] ?>/">
                                                <span>
                                                  <img class="lazy image-padding--white" data-original="<?= $item[1] ?>" src="//:0" width="88" height="130" alt="">
                                                </span>
                                                    </a>
                                                </div>
                                                <div class="section-result-item item2">
                                                    <div class="profile-cinema-heading"><?= $item[5] ?></div>
                                                    <?php if (empty($item[3])): ?>
                                                        <div class="name"><a href="/film/<?= $item[0] ?>/"><?= $item[2] ?></a></div>
                                                    <?php else: ?>
                                                        <div class="name"><a href="/film/<?= $item[0] ?>/"><?= $item[3] ?></a></div>
                                                        <div class="name__eng"><?= $item[2] ?></div>
                                                    <?php endif ?>

                                                    <div class="star-rating">
                                                        <span class="number"><?= $item[4] ?></span>
                                                        из 10
                                                    </div>
                                                    <div class="main-raiting">Общий рейтинг фильма: <span class="number">
                                                        <?php if (10 > $item[7]): ?>
                                                            _
                                                        <?php else: ?>
                                                            <?= $item[6] ?>
                                                        <?php endif ?>
                                                    </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="outer-pagelist-more">
                        <?php if (11 < count($list)): ?>
                        <div class="center-loader" style="display: none;">
                            <div class="ball-clip-rotate-multiple"><div></div><div></div></div>
                        </div>
                        <span class="pagelist-more sprite-before" data-type-openclose-button="hide-text"><span class="pagelist-more__text" id="more">Еще</span></span>
                        <?php endif ?>
                    </div>
                </content>
                <!-- include section/aside.html.php -->
            </section>
        </div>
    </div>
</div>
<!-- include section/footer.html.php -->
<!-- include section/scripts.html.php -->

<script type="text/javascript" src="<?= $static ?>/vendor/cms/jquery/jquery.lazyload.min.js"></script>

<script type="text/javascript">
    var md5 = new function(){
        var l='length',
            h=[
                '0123456789abcdef',0x0F,0x80,0xFFFF,
                0x67452301,0xEFCDAB89,0x98BADCFE,0x10325476
            ],
            x=[
                [0,1,[7,12,17,22]],
                [1,5,[5, 9,14,20]],
                [5,3,[4,11,16,23]],
                [0,7,[6,10,15,21]]
            ],
            A=function(x,y,z){
                return(((x>>16)+(y>>16)+((z=(x&h[3])+(y&h[3]))>>16))<<16)|(z&h[3])
            },
            B=function(s){
                var n=((s[l]+8)>>6)+1,b=new Array(1+n*16).join('0').split('');
                for(var i=0;i<s[l];i++)b[i>>2]|=s.charCodeAt(i)<<((i%4)*8);
                return(b[i>>2]|=h[2]<<((i%4)*8),b[n*16-2]=s[l]*8,b)
            },
            R=function(n,c){return(n<<c)|(n>>>(32-c))},
            C=function(q,a,b,x,s,t){return A(R(A(A(a,q),A(x,t)),s),b)},
            F=function(a,b,c,d,x,s,t){return C((b&c)|((~b)&d),a,b,x,s,t)},
            G=function(a,b,c,d,x,s,t){return C((b&d)|(c&(~d)),a,b,x,s,t)},
            H=function(a,b,c,d,x,s,t){return C(b^c^d,a,b,x,s,t)},
            I=function(a,b,c,d,x,s,t){return C(c^(b|(~d)),a,b,x,s,t)},
            _=[F,G,H,I],
            S=(function(){
                with(Math)for(var i=0,a=[],x=pow(2,32);i<64;a[i]=floor(abs(sin(++i))*x));
                return a
            })(),
            X=function (n){
                for(var j=0,s='';j<4;j++)
                    s+=h[0].charAt((n>>(j*8+4))&h[1])+h[0].charAt((n>>(j*8))&h[1]);
                return s
            };
        return function(s){
            var $=B(''+s),a=[0,1,2,3],b=[0,3,2,1],v=[h[4],h[5],h[6],h[7]];
            for(var i,j,k,N=0,J=0,o=[].concat(v);N<$[l];N+=16,o=[].concat(v),J=0){
                for(i=0;i<4;i++)
                    for(j=0;j<4;j++)
                        for(k=0;k<4;k++,a.unshift(a.pop()))
                            v[b[k]]=_[i](
                                v[a[0]],
                                v[a[1]],
                                v[a[2]],
                                v[a[3]],
                                $[N+(((j*4+k)*x[i][1]+x[i][0])%16)],
                                x[i][2][k],
                                S[J++]
                            );
                for(i=0;i<4;i++)
                    v[i]=A(v[i],o[i]);
            };return X(v[0])+X(v[1])+X(v[2])+X(v[3]);
        }};

    $(document).ready(function(){
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
        $("img.lazy").attr('proc', 'true');

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

            $.ajax({
                "type": "post",
                "url": "?handler=more&page=" + page,
                "success": function(data){
                    data = JSON.parse(data);

                    for (var key in data) {
                        if (data.hasOwnProperty(key) && /^0$|^[1-9]\d*$/.test(key) && key <= 4294967294) {
                            var item = data[key];
                            var image = '<?= \Kinomania\System\Config\Server::STATIC[0] ?>/app/img/content/nof.jpg';
                            if ('' != item[2]) {
                                var name = md5(item[0]);
                                image = item[1] + '/image/file/film/' + name.slice(0, 1) + '/' + name.slice(1, 3) + '/' + name + '.88.130.' + item[2];
                            }

                            var html = '<div class="rating-profile-item">' +
                                '<div class="section-result-content clear">' +
                                '<div class="section-result-item item1  list-preview">' +
                                '<a href="/film/' + item[0] + '/">' +
                                '<span>' +
                                '<img class="lazy image-padding--white" data-original="' + image + '" src="//:0" width="88" height="130" alt="">' +
                                '</span>' +
                                '</a>' +
                                '</div>' +
                                '<div class="section-result-item item2">' +
                                '<div class="profile-cinema-heading">' + item[6] + '</div>';
                                if ('' == item[4]) {
                                    html += '<div class="name"><a href="/film/' + item[0] + '/">' + item[3] + '</a></div>';
                                } else {
                                    html += '<div class="name"><a href="/film/' + item[0] + '/">' + item[4] + '</a></div>' +
                                    '<div class="name__eng">' + item[3] + '</div>';
                                }

                                html += '<div class="star-rating">' +
                                '<span class="number">' + item[5] + '</span>' +
                                ' из 10' +
                                '</div>' +
                                '<div class="main-raiting">Общий рейтинг фильма: <span class="number">';
                                if (10 > item[8]) {
                                    html += '_';
                                } else {
                                    html += item[7];
                                }
                                html += '</span></div>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                            $('.rating-profile').append(html);

                            $("img.lazy[proc!=true]").lazyload({
                                effect : "fadeIn"
                            });
                            $("img.lazy").attr('proc', 'true');
                        }
                    }

                    if (12 > data.length) {
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
    })
</script>
  <?php BodyScript::getContent();?>

</body>
</html>