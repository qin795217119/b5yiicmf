<div class="form-group <?=$widget_data['name']?>_field">
    <label class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-2':'col-sm-3'?> control-label <?=(isset($widget_data['required']))?'is-required':''?>"><?=$widget_data['title']?:''?>：</label>
    <div class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-9':'col-sm-8'?>">
        <div style="display:flex;align-items: center;justify-content: flex-start">
            <a href="javascript:;" class="btn btn-primary btn-sm" id="uploadFileBtn"><i class="fa fa-video-camera"></i>本地上传</a>
            &nbsp;&nbsp;
            <input type="text" id="videoUrl" class="form-control" name="<?=$widget_data['name']??'videourl'?>" <?=isset($widget_data['required'])?'required':''?> <?php if (isset($widget_data['place'])): ?>placeholder="<?=$widget_data['place']?>"<?php else: ?>placeholder="请输入<?=$widget_data['title']?>"<?php endif; ?> value="<?=(isset($widget_data['value']))?$widget_data['value']:((isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))?$widget_data['info'][$widget_data['name']]:'')?>">
            <a style="flex-shrink: 0" href="javascript:;" id="showVideo">&nbsp;查看</a>
        </div>
        <?php if(isset($widget_data['tips'])):?>
            <span class="help-block m-b-none"><?php if($widget_data['tips']):?><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?> <?php endif;?></span>
        <?php endif;?>

    </div>
</div>
<?php $this->beginBlock('script_after'.($widget_data['script_after']??'')); ?>
<script>
    $(function () {
        initUploadFile();
        $("#showVideo").click(function () {
            var url = $("#videoUrl").val()
            if(url){
                window.open(url)
            }
        });
    });
    function initUploadFile() {
        layui.use('upload', function(){
            var upload = layui.upload;
            //执行实例
            var uploadInst = upload.render({
                elem: '#uploadFileBtn'//绑定元素
                ,url: "<?= \yii\helpers\Url::toRoute('common/uploadvideo')?>" //上传接口
                ,field:'file'
                ,multiple:false
                ,number:1
                ,data:{cat:"<?=$widget_data['cat']??'video'?>"}
                ,accept:'video'
                ,acceptMime:'video/mp4'
                ,done: function(res){
                    if(res.success && res.code===0){
                        $("#videoUrl").val(res.data.path)
                    }else{
                        $.modal.msgError(res.msg)
                    }
                }
                ,error: function(){
                    $.modal.msgWarning('网络连接错误')
                }
            });
        });
    }
</script>
<?php $this->endBlock(); ?>
