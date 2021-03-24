<?php
$this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$this->params['web_site_name']??''?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="Keywords" content="{{$siteInfo['name']??''}}" />
    <link href="<?= yii\helpers\Url::to('@appweb/public/static/pc/site/default/css/b5net.css') ?>" rel="stylesheet"/>
    <link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/swiper/css/swiper.min.css') ?>" rel="stylesheet"/>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/jquery/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/swiper/js/swiper.min.js') ?>"></script>
    <body>
    <?php $this->beginBody() ?>
    <?= $this->render('header');?>
    <?= $content ?>
    <?= $this->render('footer')?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>