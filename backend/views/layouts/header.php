<?php $this->registerCsrfMetaTags() ?>
<title><?= $this->params['system_name']??'b5YiiCMF' ?></title>
<meta charset="charset">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@web/static/plugins/fontawesome/css/font-awesome.min.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap-table/bootstrap-table.min.css') ?>" rel="stylesheet"/>
<?= $this->blocks['css_common']??''?>

<link href="<?= yii\helpers\Url::to('@web/static/plugins/layui/css/layui.css') ?>" rel="stylesheet">
<link href="<?= yii\helpers\Url::to('@web/static/plugins/animate/animate.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@web/static/css/style.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@web/static/css/iframe-ui.css') ?>" rel="stylesheet"/>
<script src="<?= yii\helpers\Url::to('@web/static/plugins/polyfill.min.js') ?>"></script>
<script src="<?= yii\helpers\Url::to('@web/static/plugins/jquery/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script>

    var aUrl = "<?= \yii\helpers\Url::toRoute('')?>";
    var oasUrl="<?= \yii\helpers\Url::toRoute('add')?>";
    var oesUrl="<?= \yii\helpers\Url::toRoute('edit')?>";
    var upImgUrl="<?= \yii\helpers\Url::toRoute('/common/uploadimg')?>";
    var upFileUrl="<?= \yii\helpers\Url::toRoute('/common/uploadfile')?>";
    var bootUrl={
        url: "<?=\yii\helpers\Url::toRoute('index')?>",
        createUrl: decodeURIComponent("<?=\yii\helpers\Url::toRoute(['add','id'=>'%id%'])?>"),
        updateUrl: decodeURIComponent("<?=\yii\helpers\Url::toRoute(['edit','id'=>'%id%'])?>"),
        removeUrl: "<?=\yii\helpers\Url::toRoute('drop')?>",
        removeAllUrl: "<?=\yii\helpers\Url::toRoute('dropall')?>",
        clearCacheUrl: "<?=\yii\helpers\Url::toRoute('delcache')?>",
        cleanUrl: "<?=\yii\helpers\Url::toRoute('trash')?>",
        statusUrl:"<?=\yii\helpers\Url::toRoute('setstatus')?>",
        downUrl:"<?=\yii\helpers\Url::toRoute('/index/download')?>",
    }

</script>
<?php $this->head() ?>
