<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-user-repass">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|登录名称','extend'=>['name'=>'','value'=>$name,'readonly'=>'true']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|旧密码','extend'=>['type'=>'password','name'=>'oldpass','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|新密码','extend'=>['type'=>'password','name'=>'newpass','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|确认密码','extend'=>['type'=>'password','name'=>'confirmpass','required'=>1,'tips'=>'请再次输入新密码']])?>
    <input name="<?= Yii::$app->request->csrfParam?>" type="hidden" value="<?= Yii::$app->request->csrfToken ?>"/>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(aUrl, $('#form-user-repass').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
