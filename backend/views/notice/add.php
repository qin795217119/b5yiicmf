<?php $this->context->layout = '/form';?>
<?= \backend\extend\widgets\Asset::widget(['type'=>['summernote']])?>
<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">公告标题：</label>
        <div class="col-sm-9">
            <input type="text" name="title" value="" class="form-control" placeholder="请输入公告标题" required autocomplete="off"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label is-required">公告内容：</label>
        <div class="col-sm-9">
            <textarea id="content" name="content" class="hide" required></textarea>
            <div class="summernote" data-place="请输入公告内容" id="contentEditor"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">状态：</label>
        <div class="col-sm-9">
            <label class="radio-box"><input type="radio" name="status" value="0"/> 无效</label>
            <label class="radio-box"><input type="radio" name="status" value="1" checked/> 有效</label>
        </div>
    </div>
</form>
<?php $this->beginBlock('script'); ?>
<script>
    function submitHandler() {
        if ($.validate.form()) {
            if($("#contentEditor").summernote('isEmpty')){
                $.modal.msgError('请填写内容')
                return false;
            }
            var sHTML = $('#contentEditor').summernote('code');
            $("#content").val(sHTML);
            $.operate.saveTab(oasUrl, $('#form-add').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
