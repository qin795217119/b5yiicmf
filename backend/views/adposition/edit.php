<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-adpos-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|位置名称','extend'=>['name'=>'title','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|位置标识','extend'=>['name'=>'type','required'=>1,'info'=>$info,'tips'=>'宽度或高度填写时，将会对上传的图片进行裁剪压缩']])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">宽度：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'width','type'=>'number','class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label">高度：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'height','type'=>'number','class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>

</form>


<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-adpos-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
