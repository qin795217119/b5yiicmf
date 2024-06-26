<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="<?=$info['id']?>">
    <input type="hidden" name="parent_id" id="treeId" value="<?=$info['parent_id']?>">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">上级菜单：</label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text" id="treeName" value="<?=$parent_name?>" class="form-control" placeholder="请选择上级菜单" readonly autocomplete="off"/>
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">菜单名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="<?=$info['name']?>" class="form-control" placeholder="请输入菜单名称" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">菜单类型：</label>
        <div class="col-sm-8">
            <?php foreach ($typeList as $type=>$name):?>
            <label class="radio-box">
                <input type="radio" name="type" value="<?=$type?>" <?=$info['type']==$type?'checked':''?> required /> <?=$name?>
            </label>
            <?php endforeach;?>
        </div>
    </div>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">权限标识：</label>
        <div class="col-sm-3 ">
            <input type="text" name="perms" value="<?=$info['perms']?>" class="form-control" placeholder="请输入权限标识" autocomplete="off"/>
        </div>

        <label class="col-sm-2 control-label">请求地址：</label>
        <div class="col-sm-3 ">
            <input type="text" name="url" value="<?=$info['url']?>" class="form-control" placeholder="请输入请求地址" autocomplete="off"/>
        </div>
        <div class="col-xs-12 mb15">
            <label class="col-sm-3"></label>
            <span class="help-block m-b-none col-sm-9"><i class="fa fa-info-circle"></i> 菜单类型为目录时，都不填写；为菜单时，都需要填写；为方法时，不需要填写地址</span>
        </div>
    </div>

    <div class="form-group mb0">
        <label class="col-sm-3 control-label">打开方式：</label>
        <div class="col-sm-3 mb15">
            <select name="target" class="form-control">
                <option value="0" <?=$info['target']=='0'?'selected':''?>>页签</option>
                <option value="1" <?=$info['target']=='1'?'selected':''?>>窗口</option>
            </select>
        </div>
        <label class="col-sm-2 control-label">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <input type="number" name="list_sort" value="<?=$info['list_sort']?>" class="form-control" placeholder="请输入显示顺序" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group icon_dropbox">
        <label class="col-sm-3 control-label">图标：</label>
        <div class="col-sm-8">
            <input type="text" name="icon" id="icon" value="<?=$info['icon']?>" class="form-control" placeholder="请选择图标"  autocomplete="off"/>
            <div class="ms-parent" style="width: 100%;">
                <div class="icon-drop animated flipInX" style="display: none;max-height:180px;overflow-y:auto">
                    <?=$this->render('icon')?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group mb0">
        <label class="col-sm-3 control-label is-required">菜单状态：</label>
        <div class="col-sm-3 mb15">
            <label class="radio-box">
                <input type="radio" name="status" value="0" <?=$info['status']=='0'?'checked':''?>/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" <?=$info['status']=='1'?'checked':''?>/> 显示
            </label>
        </div>

        <label class="col-sm-2 control-label is-required">是否刷新：</label>
        <div class="col-sm-3 mb15">
            <label class="radio-box">
                <input type="radio" name="is_refresh" value="0" <?=$info['is_refresh']=='0'?'checked':''?>/> 否
            </label>
            <div class="radio-box">
                <input type="radio" name="is_refresh" value="1" <?=$info['is_refresh']=='1'?'checked':''?>/> 是
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="note" class="form-control" placeholder="请输入备注"><?=$info['note']?></textarea>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var url = urlcreate("<?=\yii\helpers\Url::toRoute('tree')?>","id=" + treeId + "&root=1") ;
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
                $.operate.save(oesUrl, $('#form-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
