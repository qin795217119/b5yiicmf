<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-struct-add">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','value'=>$this->params['parent_id']]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|上级组织','extend'=>['name'=>'fullname','id'=>'treeName','readonly'=>'','addon'=>'fa-search','value'=>$this->params['parent_name']]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|组织名称','extend'=>['name'=>'name','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|显示顺序','extend'=>['type'=>'number','name'=>'listsort','required'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|负责人','extend'=>['name'=>'leader']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|联系电话','extend'=>['type'=>'number','name'=>'phone']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|组织状态','extend'=>['name'=>'status','value'=>1]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note']])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            //选择组织树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > 0 ? treeId : 1;
                var url=urlcreate('<?=\yii\helpers\Url::toRoute('tree')?>',"id=" + menuId);
                var options = {
                    title: '组织选择',
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
                $.operate.save(oasUrl, $('#form-struct-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
