<?php
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
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
