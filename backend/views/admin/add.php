<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-admin-add">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|登录名称','extend'=>['name'=>'username','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'struct','type'=>'hidden','id'=>'treeId']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|组织部门','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>'请选择']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'roles','id'=>'roles','type'=>'hidden']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formcheckbox|角色分组','extend'=>['name'=>'role','data'=>$this->params['rolelist']]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|登录密码','extend'=>['name'=>'password','type'=>'password','value'=>'','tips'=>'可不填写，默认为123456']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|人员名称','extend'=>['name'=>'realname','tips'=>'可不填写，默认为登录名称']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|人员状态','extend'=>['name'=>'status','required'=>1,'value'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            //选择组织架构
            $("#treeName").click(function () {
                var treeId=$("#treeId").val();
                if($.common.isEmpty(treeId)) treeId='';
                var url = urlcreate('<?= \yii\helpers\Url::toRoute('struct/tree')?>',"ismult=1&id="+treeId);
                var options = {
                    title: '组织架构选择',
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
                var roles = $.form.selectCheckeds("role");
                $("#roles").val(roles);
                $.operate.save(oasUrl, $('#form-admin-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
