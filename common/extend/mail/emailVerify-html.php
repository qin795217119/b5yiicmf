<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var $data */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $data['token']]);
?>
<div class="verify-email">
    <p>Hello <?= Html::encode($data['name']) ?>,</p>

    <p>Follow the link below to verify your email:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
