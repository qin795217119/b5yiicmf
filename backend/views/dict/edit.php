<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-dict-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|字典名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|字典标识','extend'=>['name'=>'type','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|字典状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-dict-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
