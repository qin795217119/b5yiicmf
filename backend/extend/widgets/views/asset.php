<?php $this->beginBlock('css_common'); ?>
    <?php foreach($css as $val):?>
        <link rel="stylesheet" href="<?= yii\helpers\Url::to('@web/static/plugins/'.$val)?>">
    <?php endforeach; ?>
<?php $this->endBlock(); ?>

<?php $this->beginBlock('js_common'); ?>
    <?php foreach($js as $val):?>
        <script src="<?= yii\helpers\Url::to('@web/static/plugins/'.$val)?>"></script>
    <?php endforeach; ?>
<?php $this->endBlock(); ?>
