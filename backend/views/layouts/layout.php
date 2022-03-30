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
