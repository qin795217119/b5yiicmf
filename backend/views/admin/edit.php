<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-admin-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|登录名称','extend'=>['name'=>'username','required'=>1,'info'=>$info]])?>

    <input type="hidden" name="struct" id="treeId" value="<?=$info['structid']?>">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|组织部门','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$info['structname']]])?>

    <input type="hidden" name="roles" id="roles" value="<?=$info['roleid']?>">
    <?= \common\widgets\FormInput::widget(['name'=>'formcheckbox|角色分组','extend'=>['name'=>'role','data'=>$this->params['roleList'],'showvalue'=>'id','showname'=>'name','value'=>$info['roleid']]])?>

    <?= \common\widgets\FormInput::widget(['name'=>'forminput|登录密码','extend'=>['name'=>'password','type'=>'password','value'=>'','tips'=>'可不填写，默认为原密码']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|人员名称','extend'=>['name'=>'realname','info'=>$info,'tips'=>'可不填写，默认为登录名称']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|人员状态','extend'=>['name'=>'status','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
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
                $.operate.save(oesUrl, $('#form-admin-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
