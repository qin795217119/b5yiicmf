<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="<?=$info['id']?>">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">字典类型：</label>
        <div class="col-sm-8">
            <input type="text" value="<?=$typeInfo['name']?>" class="form-control" required  readonly/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">数据标签：</label>
        <div class="col-sm-8">
            <input type="text" name="title" value="<?=$info['title']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">数据键值：</label>
        <div class="col-sm-8">
            <input type="text" name="value" value="<?=$info['value']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="col-sm-6 control-label is-required">排序：</label>
                <div class="col-sm-6">
                    <input type="number" name="list_sort" min="0" value="<?=$info['list_sort']?>" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="col-sm-4 control-label is-required">状态：</label>
                <div class="col-sm-6">
                    <label class="radio-box"><input type="radio" name="status" value="0" <?=$info['status']==0?'checked':''?>/> 隐藏</label>
                    <label class="radio-box"><input type="radio" name="status" value="1" <?=$info['status']==1?'checked':''?>/> 显示</label>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label class="col-sm-6 control-label">样式属性：</label>
                <div class="col-sm-6">
                    <input type="text" name="css_class" class="form-control" value="<?=$info['css_class']?>">
                </div>
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label class="col-sm-4 control-label">回显样式：</label>
                <div class="col-sm-6">
                    <select name="list_class" class="form-control">
                        <option value="default" <?=$info['list_class']=='default'?'selected':''?>>默认(default)</option>
                        <option value="primary" <?=$info['list_class']=='primary'?'selected':''?>>主要(primary)</option>
                        <option value="success" <?=$info['list_class']=='success'?'selected':''?>>成功(success)</option>
                        <option value="info" <?=$info['list_class']=='info'?'selected':''?>>信息(info)</option>
                        <option value="warning" <?=$info['list_class']=='warning'?'selected':''?>>警告(warning)</option>
                        <option value="danger" <?=$info['list_class']=='danger'?'selected':''?>>危险(danger)</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="remark" class="form-control" placeholder="请输入备注"><?=$info['remark']?></textarea>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
<script>
    function submitHandler() {
        if ($.validate.form()) {
            $.operate.save(oesUrl, $('#form-edit').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
