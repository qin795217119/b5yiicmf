<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">岗位名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">岗位编码：</label>
        <div class="col-sm-8">
            <input type="text" name="pos_key" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">排序：</label>
        <div class="col-sm-8">
            <input type="number" name="list_sort" value="" class="form-control" required autocomplete="off"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label ">备注：</label>
        <div class="col-sm-8">
            <textarea name="note" class="form-control" placeholder="请输入备注"></textarea>
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
