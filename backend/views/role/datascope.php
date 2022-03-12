<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['ztree']])?>

<form class="form-horizontal m" id="form-datascope-add">
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|角色名称','extend'=>['name'=>'name','readonly'=>'','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|角色表示','extend'=>['name'=>'rolekey','readonly'=>'','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|数据范围','extend'=>['name'=>'data_scope','data'=>$dataList,'info'=>$info,'id'=>'data_scope_select']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['type'=>'hidden','name'=>'id','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['type'=>'hidden','name'=>'treeId','id'=>'treeId','value'=>'']])?>
    <div class="form-group" id="customData">
        <label class="col-sm-3 control-label">数据权限：</label>
        <div class="col-sm-8">
            <label class="check-box">
                <input type="checkbox" value="1" class="treeOpClass">展开/折叠</label>
            <label class="check-box">
                <input type="checkbox" value="2" class="treeOpClass">全选/全不选</label>
            <label class="check-box">
                <input type="checkbox" value="3" class="treeOpClass">父子联动</label>
            <div id="menuTrees" class="ztree ztree-border"></div>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function() {
            dataScopeChange();
            $("#data_scope_select").change(function (){
                dataScopeChange();
            });
            initTree()

        });

        function initTree(){
            var url = urlcreate('<?=\yii\helpers\Url::toRoute(['getrolestructlist'])?>','roleId=<?=$info['id']?>');
            var options = {
                id: "menuTrees",
                url: url,
                ismult:true,
                childparent:false,
                expandLevel: 2,
            };
            $.tree.init(options);
            $('input.treeOpClass').on('ifChanged', function(obj){
                var type = $(this).val();
                var checked = obj.currentTarget.checked;
                if (type == 1) {
                    if (checked) {
                        $._tree.expandAll(true);
                    } else {
                        $._tree.expandAll(false);
                    }
                } else if (type == "2") {
                    if (checked) {
                        $._tree.checkAllNodes(true);
                        $.tree.zOnCheck();
                    } else {
                        $._tree.checkAllNodes(false);
                        $.tree.zOnCheck();
                    }
                } else if (type == "3") {
                    if (checked) {
                        $._tree.setting.check.chkboxType = { "Y": "ps", "N": "ps" };
                    } else {
                        $._tree.setting.check.chkboxType = { "Y": "", "N": "" };
                    }
                }
            })
        }
        function dataScopeChange(){
            var val = $("#data_scope_select").val()
            if(val=='8'){
                $("#customData").show()
            }else{
                $("#customData").hide()
            }
        }
        function submitHandler() {
            $.operate.save(aUrl, $('#form-datascope-add').serialize());
        }
    </script>
<?php $this->endBlock(); ?>
