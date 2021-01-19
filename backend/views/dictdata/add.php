<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['select2']])?>

<form class="form-horizontal m" id="form-dictdata-add">
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|字典类型','extend'=>['name'=>'type','required'=>1,'data'=>$this->params['typelist']??[],'showvalue'=>'type','showname'=>'name','place'=>'','value'=>$input['id']??'','class'=>'select2']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|数据名称','extend'=>['name'=>'name','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|数据值','extend'=>['name'=>'value','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','required'=>1,'value'=>0]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|数据状态','extend'=>['name'=>'status','value'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-dictdata-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
