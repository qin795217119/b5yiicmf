<?php
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= $this->render('header')?>
</head>
<body class="white-bg">
<?php $this->beginBody() ?>
    <div class="wrapper wrapper-content animated fadeInRight ibox-content">
      <?= $content ?>
    </div>
    <?= $this->render('footer')?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>