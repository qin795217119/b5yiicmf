<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-redtype-add">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|跳转名称','extend'=>['name'=>'title','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|跳转标识','extend'=>['name'=>'type','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|功能链接','extend'=>['name'=>'list_url']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|信息链接','extend'=>['name'=>'info_url']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|跳转状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-redtype-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
