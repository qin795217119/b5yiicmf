<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-role-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|角色名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|权限字符','extend'=>['name'=>'rolekey','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|角色状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-role-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
