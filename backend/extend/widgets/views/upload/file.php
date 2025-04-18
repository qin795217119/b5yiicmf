<?php
    $widget_data['name'] = $widget_data['name'] ?? '';
    $widget_data['disabled'] = $widget_data['disabled'] ?? '';
    $widget_data['title'] = $widget_data['title'] ?? '上传文件';
    $widget_data['tips'] = $widget_data['tips'] ?? '';
    $widget_data['cat'] = $widget_data['cat'] ?? '';
    $widget_data['exts'] = $widget_data['exts'] ?? '';
    $widget_data['link'] = $widget_data['link'] ?? '';
    $widget_data['multi'] = intval($widget_data['multi']??'1');
    $widget_data['inputname'] = $widget_data['inputname']??'';
    $widget_data['data'] = $widget_data['data']??'';
?>
<div class="b5uploadmainbox b5uploadfilebox" data-type="file">
    <?php if (!$widget_data['disabled']):?>
        <button type="button" class="btn-b5upload btn btn-primary btn-sm" id="<?=$widget_data['name']?>" data-exts="<?=$widget_data['multi']?>"  data-multi="<?=$widget_data['multi']?>"  data-cat="<?=$widget_data['cat']?>" data-inputname="<?=$widget_data['inputname']?>"><i class="fa fa-upload"></i> <?=$widget_data['title']?></button>

        <?php if($widget_data['link']):?>
            或 <div class="uploadimg_link">
                <input type="text" id="<?=$widget_data['name']?>_link" class="form-control" value=""><a href="javascript:;" class="btn btn-primary btn-sm" id="<?=$widget_data['name']?>_linkbtn"><i class="fa fa-link"></i>添加</a>
            </div>
        <?php endif;?>
        <?php if($widget_data['tips']):?>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?></span>
        <?php endif;?>

    <?php else:?>
        <div id="<?=$widget_data['name']?>" data-multi="<?=$widget_data['multi']?>"></div>
    <?php endif;?>
    <div class="b5uploadlistbox <?=$widget_data['name']?>_filelist" id="<?=$widget_data['name']?>_filelist"></div>
</div>
<?php $this->beginBlock('script_before'); ?>
<?=$this->blocks['script_before']??''?>
<script>
    $(function () {
        <?php if (!$widget_data['disabled']):?>
            b5uploadfileinit("<?=$widget_data['name']?>");
            <?php if($widget_data['link']):?>
                b5uploadimglink("<?=$widget_data['name']?>");
            <?php endif;?>
            <?php if($widget_data['multi']>1):?>
                dragula([<?=$widget_data['name']?>_filelist])
            <?php endif;?>
        <?php endif;?>
        <?php
        if($widget_data['data']){
            if(is_string($widget_data['data'])){
                $widget_data['data'] = explode(',',$widget_data['data']);
            }
            foreach ($widget_data['data'] as $widget_data_val){
                $widget_data_name = '';
                if (is_array($widget_data_val)) {
                    $widget_data_name = $widget_data_val['name']??'';
                    $widget_data_val = $widget_data_val['path']??'';
                }
                $widget_data_url = \common\helpers\Functions::getFileUrl($widget_data_val);
        ?>
            b5uploadhtmlshow("<?=$widget_data['name']?>",b5uploadfilehtml("<?=$widget_data_val?>","<?=$widget_data['name']?>","<?=$widget_data_url?>","<?=$widget_data_name?>","<?=$widget_data['disabled']?>"));
        <?php
            }
        }
        ?>
    });
</script>
<?php $this->endBlock(); ?>
