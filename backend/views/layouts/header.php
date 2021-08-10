<?php $this->registerCsrfMetaTags() ?>
<title><?= $this->params['title']??'' ?></title>
<meta charset="<?= Yii::$app->charset ?>">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/fontawesome/css/font-awesome.min.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/bootstrap-table/bootstrap-table.min.css') ?>" rel="stylesheet"/>

<?= $this->blocks['css_common']??''?>

<link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/layui/css/layui.css') ?>" rel="stylesheet">
<link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/animate/animate.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@appweb/public/static/admin/css/style.css') ?>" rel="stylesheet"/>
<link href="<?= yii\helpers\Url::to('@appweb/public/static/admin/css/iframe-ui.css') ?>" rel="stylesheet"/>
<script>
    var _M_ = "<?= $this->params['group']?>";
    var _C_ = "<?= $this->params['app']?>";
    var _A_ = "<?= $this->params['act']?>";
    var rootUrl ="/";
    var aUrl = "<?= \yii\helpers\Url::toRoute('')?>";
    var oasUrl="<?= \yii\helpers\Url::toRoute('add')?>";
    var oesUrl="<?= \yii\helpers\Url::toRoute('edit')?>";
    var upImgUrl="<?= \yii\helpers\Url::toRoute('common/uploadimg')?>";
    var bootUrl={
        url: "<?=\yii\helpers\Url::toRoute('index')?>",
        createUrl: decodeURIComponent("<?=\yii\helpers\Url::toRoute(['add','id'=>'{id}'])?>"),
        updateUrl: decodeURIComponent("<?=\yii\helpers\Url::toRoute(['edit','id'=>'{id}'])?>"),
        removeUrl: "<?=\yii\helpers\Url::toRoute('drop')?>",
        removeAllUrl: "<?=\yii\helpers\Url::toRoute('dropall')?>",
        clearCacheUrl: "<?=\yii\helpers\Url::toRoute('delcache')?>",
        cleanUrl: "<?=\yii\helpers\Url::toRoute('trash')?>",
        statusUrl:"<?=\yii\helpers\Url::toRoute('setstatus')?>",
        downUrl:"<?=\yii\helpers\Url::toRoute('index/download')?>",
    }

</script>
<?php $this->head() ?>
