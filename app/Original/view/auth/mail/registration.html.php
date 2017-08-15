<?php
/**
 * @var string $login
 * @var string $host
 * @var string $hash
 */
?>

<br /><br />
Добро пожаловать на сайт <a href="http://kinomania.ru/" target="_blank">KINOMANIA.RU</a>!
<br/><br/>
Вы зарегистрировались под логином <b><?= $login ?></b>, указав данный e-mail.<br/><br/>
Чтобы начать пользоваться сайтом, <b>необходимо подтвердить регистрацию</b>.
Для этого <b>перейдите по ссылке:</b>
<br/>
<a href="http://<?= $host ?>/registration_?handler=activate&h=<?= $hash ?>/">http://<?= $host ?>/registration_?handler=activate&h=<?= $hash ?></a>
<br/><br/>
Если при переходе возникла ошибка, пожалуйста, скопируйте ссылку в адресную строку вашего браузера.<br/><br/>
Если вы не регистрировались — проигнорируйте это письмо.
<br/>
<p>
    <i>
        Не нужно отвечать на данное письмо. Если у вас есть вопросы или пожелания - отправьте их на почту support@kinomania.ru и мы обязательно вам ответим.<br/><br/>
        Ваша KINOMANIA.RU
    </i>
</p>