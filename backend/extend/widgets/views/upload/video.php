<?php
    $widget_data['name'] = $widget_data['name']??'';
    $widget_data['disabled'] = $widget_data['disabled'] ?? '';
    $widget_data['title'] = $widget_data['title']??'本地上传';
    $widget_data['place'] = $widget_data['place']??'';
    $widget_data['tips'] = $widget_data['tips']??'';
    $widget_data['cat'] = $widget_data['cat']??'';
    $widget_data['exts'] = $widget_data['exts']??'';
    $widget_data['data'] = $widget_data['data']??'';
?>
<div style="display:flex;align-items: center;justify-content: flex-start">
    <?php if (!$widget_data['disabled']):?>
        <button type="button" class="btn btn-primary btn-sm" id="videobtn_<?=$widget_data['name']?>" style="flex-shrink: 0"><i class="fa fa-video-camera"></i><?=$widget_data['title']?></button>
    <?php endif;?>
    &nbsp;&nbsp;
    <input type="text" id="videourl_<?=$widget_data['name']?>" class="form-control videourl_input" name="<?=$widget_data['name']?>" placeholder="<?=$widget_data['place']?>"  value="<?=$widget_data['data']?>">
    <a style="flex-shrink: 0" href="javascript:;" id="videoshow_<?=$widget_data['name']?>" data-url="<?=\common\helpers\Functions::getFileUrl($widget_data['data'])?>">&nbsp;查看</a>
</div>
<?php if($widget_data['tips'] && !$widget_data['disabled']):?>
    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?></span>
<?php endif;?>
<?php $this->beginBlock('script_before'); ?>
<?=$this->blocks['script_before']??''?>
<script>
    $(function () {
        <?php if (!$widget_data['disabled']):?>
            layui.use("upload", function(){
                var upload = layui.upload;
                //执行实例
                upload.render({
                    elem: "#videobtn_<?=$widget_data['name']?>"
                    ,url: "<?=\yii\helpers\Url::toRoute('/common/uploadvideo')?>"
                    ,field:"file"
                    ,multiple:false
                    ,number:1
                    ,data:{cat:"<?=$widget_data['cat']?>"}
                    ,accept:"video"
                    ,acceptMime:"video/mp4"
                    ,done: function(res){
                        if(res.success && res.code===0){
                            $("#videourl_<?=$widget_data['name']?>").val(res.data.path);
                            $("#videoshow_<?=$widget_data['name']?>").data("url",res.data.url);
                        }else{
                            $.modal.msgError(res.msg)
                        }
                    }
                    ,error: function(){
                        $.modal.msgWarning("网络连接错误")
                    }
                });
            });
        <?php endif;?>
        $("#videoshow_<?=$widget_data['name']?>").click(function () {
            var url = $(this).data('url')
            if(url){
                window.open(url)
            }
        });
    });
</script>
<?php $this->endBlock(); ?>