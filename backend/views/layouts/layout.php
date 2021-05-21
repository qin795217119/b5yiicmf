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
    <div class="container-div">
        <div class="row">
            <?= $content ?>
        </div>
    </div>
    <?= $this->render('footer')?>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
