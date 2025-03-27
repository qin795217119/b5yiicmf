<?php $this->context->layout = '/form';?>
<?= \backend\extend\widgets\Asset::widget(['type'=>['summernote']])?>
<form class="form-horizontal m" id="form-edit">
    <input type="hidden" name="id" value="<?=$info['id']?>">
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">公告标题：</label>
        <div class="col-sm-9">
            <input type="text" name="title" value="<?=$info['title']?>" class="form-control" placeholder="请输入公告标题" required autocomplete="off"/>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label is-required">公告内容：</label>
        <div class="col-sm-9">
            <textarea class="summernote_content hide" id="content" name="content"><?=htmlspecialchars($info['content'])?></textarea>
            <div class="summernote" id="contentEditor"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">状态：</label>
        <div class="col-sm-9">
            <?=\backend\extend\widgets\DictOption::widget(['type'=>'sys_notice_status','value'=>$info['status'],'tag'=>'radio','name'=>'status'])?>
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
            $.operate.save(oesUrl, $('#form-edit').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
