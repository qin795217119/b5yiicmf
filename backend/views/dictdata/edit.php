<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['select2']])?>

<form class="form-horizontal m" id="form-dictdata-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|字典类型','extend'=>['name'=>'type','required'=>1,'data'=>$this->params['typelist']??[],'showvalue'=>'type','showname'=>'name','place'=>'','class'=>'select2','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|数据名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|数据值','extend'=>['name'=>'value','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|数据状态','extend'=>['name'=>'status','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-dictdata-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
