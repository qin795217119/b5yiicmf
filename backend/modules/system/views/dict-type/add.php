<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">字典名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="" class="form-control" placeholder="请输入字典名称" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">字典类型：</label>
        <div class="col-sm-8">
            <input type="text" name="type" value="" class="form-control" placeholder="请输入字典类型" required autocomplete="off"/>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 唯一标识，只能由大小写字母、数字或‘_’组成</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box"><input type="radio" name="status" value="0"/> 隐藏</label>
            <label class="radio-box"><input type="radio" name="status" value="1" checked/> 显示</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="remark" class="form-control" placeholder="请输入备注"></textarea>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
