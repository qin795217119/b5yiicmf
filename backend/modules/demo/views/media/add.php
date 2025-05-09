<?php $this->context->layout = '/form';?>

<?= \backend\extend\widgets\Asset::widget(['type'=>['dragula','uploader']])?>

<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">单图片上传：</label>
        <div class="col-sm-8">
            <input type="hidden" name="img" value="" id="img" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'img','name'=>'img_upload','extend'=>['cat'=>'demo','link'=>1,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M']])?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">多图片图片上传：</label>
        <div class="col-sm-8">
            <input type="hidden" name="imgs" value="" id="imgs" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'img','name'=>'imgs_upload','extend'=>['link'=>1,'cat'=>'demo', 'multi'=>5,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M；最多上传5张；可拖动排序']])?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">裁剪上传：</label>
        <div class="col-sm-8">
            <input type="hidden" name="crop" value="" id="crop" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'img','name'=>'crop_upload','extend'=>['link'=>1,'cat'=>'demo', 'multi'=>2,'crop'=>1,'tips'=>'格式为jpg,jpeg,png,gif；大小不能超过10M；最多上传2张；可拖动排序']])?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label is-required">上传视频：</label>
        <div class="col-sm-8">
            <input type="hidden" name="video" value="" id="video" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'video','name'=>'video_upload','extend'=>['cat'=>'demo', 'tips'=>'格式为mp4；大小不能超过100M']])?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label is-required">单文件：</label>
        <div class="col-sm-8">
            <input type="hidden" name="file" value="" id="file" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'file','name'=>'file_upload','extend'=>['cat'=>'demo',  'link'=>1, 'exts'=>'txt|rar|doc|png','tips'=>'格式为txt|rar|doc|png；大小不能超过100M']])?>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label is-required">多文件文件：</label>
        <div class="col-sm-8">
            <input type="hidden" name="files" value="" id="files" required>
            <?=\backend\extend\widgets\Upload::widget(['type'=>'file','name'=>'files_upload','extend'=>['cat'=>'demo', 'link'=>1,'multi'=>3, 'exts'=>'txt|rar|doc|png','tips'=>'格式为txt|rar|doc|png；最大上传3个；大小不能超过100M']])?>
        </div>
    </div>
    <div class="row m-t-md">
        <div class="col-sm-offset-5 col-sm-10">
            <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            var img = '';
            var imgs = [];
            var crop = [];
            var file = [];
            var files = [];

            if($("input[name='img_upload[]']").length>0){
                $("input[name='img_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        img = imgval;
                    }
                })
            }
            $("#img").val(img);

            if($("input[name='imgs_upload[]']").length>0){
                $("input[name='imgs_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        imgs.push(imgval)
                    }
                })
            }
            $("#imgs").val(imgs.join(','));

            if($("input[name='crop_upload[]']").length>0){
                $("input[name='crop_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        crop.push(imgval)
                    }
                })
            }
            $("#crop").val(crop.join(','));

            $("#video").val($("#videourl_video_upload").val());

            if($("input[name='file_upload[]']").length>0){
                $("input[name='file_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        file = imgval
                    }
                })
            }
            $("#file").val(file);

            if($("input[name='files_upload[]']").length>0){
                $("input[name='files_upload[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        files.push(imgval)
                    }
                })
            }
            $("#files").val(files.join(','));

            if ($.validate.form("",{ignore:""})) {

                $.operate.saveTab(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
