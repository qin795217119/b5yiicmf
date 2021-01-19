<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-adpos-add">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|位置名称','extend'=>['name'=>'title','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|位置标识','extend'=>['name'=>'type','required'=>1,'tips'=>'宽度或高度填写时，将会对上传的图片进行裁剪压缩']])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">宽度：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'width','type'=>'number','class'=>'form-control']])?>
        </div>
        <label class="col-sm-2 control-label">高度：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'height','type'=>'number','class'=>'form-control']])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-adpos-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
