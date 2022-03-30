<?php
    $widget_data['name'] = $widget_data['name']??'';
    $widget_data['title'] = $widget_data['title']??'上传图片';
    $widget_data['link'] = $widget_data['link']??'';
    $widget_data['tips'] = $widget_data['tips']??'';
    $widget_data['multi'] = intval($widget_data['multi']??'1');
    $widget_data['width'] = $widget_data['width']??'';
    $widget_data['height'] = $widget_data['height']??'';
    $widget_data['cat'] = $widget_data['cat']??'';
    $widget_data['crop'] = $widget_data['crop']??'';
    $widget_data['data'] = $widget_data['data']??'';
?>

<div class="b5uploadmainbox b5uploadimgbox" data-type="img">
    <button type="button" class="btn-b5upload btn btn-primary btn-sm" id="<?=$widget_data['name']?>" data-multi="<?=$widget_data['multi']?>" data-height="<?=$widget_data['height']?>" data-width="<?=$widget_data['width']?>" data-cat="<?=$widget_data['cat']?>"><i class="fa fa-image"></i><?=$widget_data['title']?></button>

<?php if($widget_data['link']):?>
     或 <div class="uploadimg_link">
        <input type="text" class="form-control" id="<?=$widget_data['name']?>_link" />
        <a href="javascript:;" class="btn btn-primary btn-sm" id="<?=$widget_data['name']?>_linkbtn"><i class="fa fa-link"></i>添加</a>
    </div>
<?php endif;?>
<?php if($widget_data['tips']):?>
    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?></span>
<?php endif;?>
    <div class="b5uploadlistbox <?=$widget_data['name']?>_imglist" id="<?=$widget_data['name']?>_imglist"></div>
</div>


<script>
    $(function () {
        <?php if($widget_data['link']):?>
            b5uploadImgLink("<?=$widget_data['name']?>");
        <?php endif;?>

        <?php if($widget_data['crop']){?>
            $("#<?=$widget_data['name']?>").click(function () {
                var url = "<?=\yii\helpers\Url::toRoute('/common/cropper')?>";
                var params = "id=<?=$widget_data['name']?>&cat=<?=$widget_data['cat']?>";
                url = urlcreate(url,params);
                $.modal.open("上传裁剪图片",url);
            });
        <?php }else{?>
            b5uploadimginit("<?=$widget_data['name']?>");
        <?php }?>

        <?php if($widget_data['multi']>1):?>
            dragula([<?=$widget_data['name']?>_imglist]);
        <?php endif;?>

        <?php
            if($widget_data['data']){
                if(is_string($widget_data['data'])){
                    $widget_data['data'] = explode(',',$widget_data['data']);
                }
                foreach ($widget_data['data'] as $widget_data_val){
                    $widget_data_url = \common\helpers\Functions::getFileUrl($widget_data_val);
        ?>
            b5uploadhtmlshow("<?=$widget_data['name']?>",b5uploadimghtml("<?=$widget_data_val?>","<?=$widget_data['name']?>","<?=$widget_data_url?>"))
        <?php
                }
            }
        ?>
    })
</script>
