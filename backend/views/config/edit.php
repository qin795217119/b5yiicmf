<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-config-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|配置标题','extend'=>['name'=>'title','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|配置标识','extend'=>['name'=>'type','required'=>1,'info'=>$info]])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">配置类型：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'style','data'=>$this->params['stylelist'],'class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label">配置分组：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'groups','place'=>'不分组','class'=>'form-control','data'=>$this->params['grouplist'],'info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|配置值','extend'=>['name'=>'value','tips'=>'当为枚举类型时，标识选中得值','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|配置项','extend'=>['name'=>'extra','tips'=>'只有类型为枚举类型时有效，表示枚举列表','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['name'=>'listsort','type'=>'number','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
<script>
    function submitHandler() {
        if ($.validate.form()) {
            $.operate.save(oesUrl, $('#form-config-edit').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
