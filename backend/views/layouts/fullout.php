<?php
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= $this->render('header');?>
</head>
<body class="gray-bg">
<?php $this->beginBody() ?>
<?= $content ?>
<?= $this->render('footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
