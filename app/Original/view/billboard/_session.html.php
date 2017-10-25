<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 21.10.2017
 * Time: 15:37
 * @var $sessions array
 */
?>

<div>
    <?php foreach ($sessions as $session): ?>
        <div class="sessionsItem">
            <a title="Купить билет" href='javascript:ticketManager.richSession(<?= $session->SessionID ?>)'>
	            <?= substr($session->DateTime, 11); ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>
