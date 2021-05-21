<?php $this->context->layout = 'form';?>

<form class="form-horizontal m" id="form-menu-add">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'parent_id','type'=>'hidden','id'=>'treeId','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|上级菜单','extend'=>['name'=>'','id'=>'treeName','value'=>$info['parent_name'],'readonly'=>'','addon'=>'fa-search']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|菜单名称','extend'=>['name'=>'name','required'=>1,'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|菜单类型','extend'=>['name'=>'type','required'=>1,'data'=>$this->params['typeList'],'info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|权限标识','extend'=>['name'=>'perms','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|请求地址','extend'=>['name'=>'url','info'=>$info]])?>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">打开方式：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'target','data'=>['页签','窗口'],'class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
    <div class="form-group icon_dropbox">
        <label class="col-sm-3 control-label">图标：</label>
        <div class="col-sm-8">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'icon','id'=>'icon','class'=>'form-control','place'=>'请选择图片','info'=>$info]])?>
            <div class="ms-parent" style="width: 100%;">
                <div class="icon-drop animated flipInX" style="display: none;max-height:180px;overflow-y:auto">
                    <?=$this->render('icon')?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb0">
        <label class="col-sm-3 control-label">菜单状态：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','data'=>['隐藏','显示'],'info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label" title="打开菜单选项卡是否刷新页面">是否刷新：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'is_refresh','data'=>['否','是'],'info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|备注','extend'=>['name'=>'note','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > -1 ? treeId : 1;
                var url = urlcreate('<?=\yii\helpers\Url::toRoute('tree')?>','id=' + menuId) ;
                var options = {
                    title: '菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit
                };
                $.modal.openOptions(options);
            });

            //选择图标
            $("#icon").click(function() {
                $(".icon-drop").toggle();
            });
            $("body").click(function(event) {
                var obj = event.srcElement || event.target;
                if (!$(obj).is("#icon")) {
                    $(".icon-drop").hide();
                }
            });
            $(".icon-drop").find(".ico-list i").on("click", function() {
                $('#icon').val($(this).attr('class'));
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
                $.operate.save(oesUrl, $('#form-menu-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
