<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="<?=$info['id']?>">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">岗位名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="<?=$info['name']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">岗位编码：</label>
        <div class="col-sm-8">
            <input type="text" name="pos_key" value="<?=$info['pos_key']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">排序：</label>
        <div class="col-sm-8">
            <input type="number" name="list_sort" value="<?=$info['list_sort']?>" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0" <?=$info['status']==0?'checked':''?>/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" <?=$info['status']==1?'checked':''?>/> 显示
            </label>
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
    function submitHandler() {
        if ($.validate.form()) {
            $.operate.save(oesUrl, $('#form-edit').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
