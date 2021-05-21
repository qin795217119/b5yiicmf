<?php
use yii\helpers\Html;

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['public/emailrepass', 'token' => $data['token']]);
?>
<div class="password-reset">
    <p>你好 <?= Html::encode($data['name']) ?>：</p>

    <p>请点击下面的链接重置您的密码:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
