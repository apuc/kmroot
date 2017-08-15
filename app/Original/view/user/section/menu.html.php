<?php
/**
 * @var \Dspbee\Core\Request $request
 * @var string $login
 * @var array $stat
 * @var bool $authProb
 */
use Kinomania\Original\Key\User\Stat;
?>
<ul class="nav-content-list clear" id="userMenu">
    <div class="mobile__select my-select">
        <span class="result">Профиль</span>
        <ul class="result-list" id="userMenuMobile">
            <li class="nav-content-item <?php if ('user/' . $login == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/">Профиль</a></li>

            <?php if (0 == $stat[Stat::REVIEW]): ?>
                <li class="nav-content-item no-active"><span>Рецензии</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/reviews' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/reviews/">Рецензии <span class="number"><?= $stat[Stat::REVIEW] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::FEEDBACK]): ?>
                <li class="nav-content-item no-active"><span>Отзывы</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/stars' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/stars/">Отзывы <span class="number"><?= $stat[Stat::FEEDBACK] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::COMMENT]): ?>
                <li class="nav-content-item no-active"><span>Комментарии</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/comments' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/comments/">Комментарии <span class="number"><?= $stat[Stat::COMMENT] ?></a></li>
            <?php endif ?>

            <?php if (0 == $stat[Stat::RATE]): ?>
                <li class="nav-content-item no-active"><span>Оценки</span></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/ratings' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/ratings/">Оценки <span class="number"><?= $stat[Stat::RATE] ?></span></a></li>
            <?php endif ?>

            <?php if ($authProb): ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM] ?></span></a></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM_PUB] ?></span></a></li>
            <?php endif ?>
            <?php if ($authProb): ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON] ?></span></a></li>
            <?php else: ?>
                <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON_PUB] ?></span></a></li>
            <?php endif ?>
        </ul>
    </div>

    <li class="nav-content-item <?php if ('user/' . $login == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/">Профиль</a></li>

    <?php if (0 == $stat[Stat::REVIEW]): ?>
        <li class="nav-content-item no-active"><span>Рецензии</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/reviews' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/reviews/">Рецензии <span class="number"><?= $stat[Stat::REVIEW] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::FEEDBACK]): ?>
        <li class="nav-content-item no-active"><span>Отзывы</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/stars' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/stars/">Отзывы <span class="number"><?= $stat[Stat::FEEDBACK] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::COMMENT]): ?>
        <li class="nav-content-item no-active"><span>Комментарии</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/comments' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/comments/">Комментарии <span class="number"><?= $stat[Stat::COMMENT] ?></span></a></li>
    <?php endif ?>

    <?php if (0 == $stat[Stat::RATE]): ?>
        <li class="nav-content-item no-active"><span>Оценки</span></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/ratings' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/ratings/">Оценки <span class="number"><?= $stat[Stat::RATE] ?></span></a></li>
    <?php endif ?>

    <?php if ($authProb): ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM] ?></span></a></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/films' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/films/">Фильмы <span class="number filmNumber"><?= $stat[Stat::FILM_PUB] ?></span></a></li>
    <?php endif ?>
    <?php if ($authProb): ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON] ?></span></a></li>
    <?php else: ?>
        <li class="nav-content-item <?php if ('user/' . $login . '/people' == $request->route()): ?>active<?php endif ?>"><a href="/user/<?= $login ?>/people/">Персоналии <span class="number personNumber"><?= $stat[Stat::PERSON_PUB] ?></span></a></li>
    <?php endif ?>
</ul>

<?php if ($authProb): ?>
    <script type="text/javascript">
        $(document).ready(function(){
            var matches = document.cookie.match(new RegExp("(?:^|; )__user__=([^;]*)"));
            matches = matches ? decodeURIComponent(matches[1]) : undefined;
            if (undefined !== matches) {
                matches = matches.split('.');
                var login = document.location.href;
                login = login.split('/');
                if (4 in login) {
                    login = login[4];
                } else {
                    login = '_';
                }
                if (matches[0] == login) {
                    if (-1 != document.location.href.indexOf(matches[0] + '/settings')) {
                        $('#userMenu').append('<li class="nav-content-item active"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                        $('#userMenuMobile').append('<li class="nav-content-item active"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                    } else {
                        $('#userMenu').append('<li class="nav-content-item"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                        $('#userMenuMobile').append('<li class="nav-content-item"><a href="/user/' + matches[0] + '/settings/">Настройки</a></li>');
                    }
                }
            }
        });
    </script>
<?php endif ?>
