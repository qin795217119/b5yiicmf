<?php
use yii\helpers\Html;

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['public/emailverify', 'token' => $data['token']]);
?>
<div class="verify-email">
    <p>你好   <?= Html::encode($data['name']) ?>：</p>

    <p>请点击下面链接验证激活您的邮箱账号:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
