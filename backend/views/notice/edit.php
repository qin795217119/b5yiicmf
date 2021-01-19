<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['summernote']])?>

<form class="form-horizontal m" id="form-notice-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|公告标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|公告类型','extend'=>['name'=>'type','required'=>1,'data'=>$this->params['typelist'],'place'=>'','class'=>'form-control','sm'=>'2','info'=>$info]])?>
    <div class="form-group">
        <label class="col-sm-2 control-label">公告内容：</label>
        <div class="col-sm-9">
            <?= \common\widgets\FormInput::widget(['name'=>'textarea','extend'=>['name'=>'content','class'=>'summernote_content hide','info'=>$info]])?>
            <div class="summernote" data-place="请输入公告内容"></div>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formradio|公告状态','extend'=>['name'=>'status','required'=>1,'sm'=>'2','info'=>$info]])?>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oesUrl, $('#form-notice-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
