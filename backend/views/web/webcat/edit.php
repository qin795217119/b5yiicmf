<?php $this->context->layout = 'form';?>
<form class="form-horizontal m" id="form-webcat-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|菜单标题','extend'=>['name'=>'name','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|上级菜单','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$info['parent_name']]])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label is-required">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label is-required">菜单类型：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'type','required'=>1,'data'=>$this->params['typeList'],'class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|请求地址','extend'=>['name'=>'url','info'=>$info,'tips'=>'当菜单类型为外链跳转时有效']])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">列表模板：</label>
        <div class="col-sm-3">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'template_list','class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label">详情模板：</label>
        <div class="col-sm-3">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'template_info','class'=>'form-control','info'=>$info]])?>
        </div>
        <div class="mb15 col-xs-12 col-xs-offset-3">
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 只有类型为图文信息、产品信息时，详情模板有效</span>
        </div>
    </div>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">菜单状态：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','info'=>$info,'data'=>['隐藏','显示']]])?>
        </div>
        <label class="col-sm-2 control-label">选中标识：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'checkcode','class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > -1 ? treeId : 1;
                var url=urlcreate('<?=\yii\helpers\Url::toRoute('tree')?>',"id=" + menuId);
                var options = {
                    title: '上级菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });

        });
        function doSubmit(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#treeId").val(body.find('#treeId').val());
            $("#treeName").val(body.find('#treeName').val());
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-webcat-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
