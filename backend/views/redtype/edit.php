<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-redtype-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|跳转名称','extend'=>['name'=>'title','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|跳转标识','extend'=>['name'=>'type','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|功能链接','extend'=>['name'=>'list_url','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|信息链接','extend'=>['name'=>'info_url','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|跳转状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-redtype-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
