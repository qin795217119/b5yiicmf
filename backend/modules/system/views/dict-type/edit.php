<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="<?=$info['id']?>">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">字典名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="<?=$info['name']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">字典类型：</label>
        <div class="col-sm-8">
            <input type="text" name="type" value="<?=$info['type']?>" class="form-control" required autocomplete="off"/>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 唯一标识，只能由大小写字母、数字或‘_’组成</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box"><input type="radio" name="status" value="0" <?=$info['status']==0?'checked':''?>/> 隐藏</label>
            <label class="radio-box"><input type="radio" name="status" value="1" <?=$info['status']==1?'checked':''?>/> 显示</label>
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
