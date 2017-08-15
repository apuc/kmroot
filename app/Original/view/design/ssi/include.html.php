<?php
/**
 * @var string $css
 * @var string $html
 * @var string $pre_roll
 * @var string $pre_roll_link
 */
?>
<?php if (!empty($css)): ?>
    <link rel="stylesheet" href="<?= $css ?>">
<?php endif; ?>
<?= $html ?>
<?php if (!empty($pre_roll)): ?>
    <script type="text/javascript">
        window.__pre_roll__ = "<?= $pre_roll ?>";
        window.__pre_roll_link__ = "<?= $pre_roll_link ?>";
    </script>
<?php else: ?>
    <script type="text/javascript">
        window.__pre_roll__ = "";
        window.__pre_roll_link__ = "";
    </script>
<?php endif ?>
