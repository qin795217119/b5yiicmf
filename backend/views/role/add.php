<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-role-add">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|角色名称','extend'=>['name'=>'name','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|权限字符','extend'=>['name'=>'rolekey','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','value'=>0]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|角色状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-role-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
