<div class="form-group <?=$widget_data['name']?>_field">
    <label class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-2':'col-sm-3'?> control-label <?=(isset($widget_data['required']))?'is-required':''?>"><?=$widget_data['title']?:''?>：</label>
    <div class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-9':'col-sm-8'?>">
        <div class="b5uploadmainbox">
            <a href="javascript:;" class="btn btn-primary btn-sm"
               <?= $widget_data['id']?'id="'.$widget_data['id'].'"':''?>
               data-multi="<?=$widget_data['multi']??'false'?>"
               data-name="<?=$widget_data['name']??'uploadimg'?>"
               data-cat="<?=$widget_data['cat']??'images'?>"
               data-width="<?=$widget_data['width']??'0'?>"
               data-height="<?=$widget_data['height']??'0'?>"
            ><i class="fa fa-image"></i>上传图片</a>
            <?php if(!isset($widget_data['link']) || $widget_data['link']!='false'):?>
            或
            <div class="uploadimg_link">
                <input type="text" class="form-control" id="<?=$widget_data['id']?>_link"><a href="javascript:;" class="btn btn-primary btn-sm" id="<?=$widget_data['id']?>_linkbtn"><i class="fa fa-link"></i>添加</a>
            </div>
            <?php endif;?>
            <?php if(isset($widget_data['tips'])):?>
                <span class="help-block m-b-none"><?php if($widget_data['tips']):?><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?> <?php endif;?></span>
            <?php endif;?>
            <div class="b5uploadlistbox <?=$widget_data['name']?>_imglist" id="<?=$widget_data['name']?>_imglist">
                <?php if(isset($widget_data['data']) && $widget_data['data']):?>
                    <?php foreach(is_array($widget_data['data'])?$widget_data['data']:explode(',',$widget_data['data']) as $imglink):?>
                        <div class="b5uploadimg_li">
                            <input type="hidden" name="<?=$widget_data['name']?>[]" value="<?=$imglink?>">
                            <div class="b5uploadimg_con">
                                <div class="b5uploadimg_cell">
                                     <img src="<?=$imglink?>" alt="">
                                </div>
                            </div>
                            <div class="b5uploadimg_footer">
                                <a href="javascript:;" onclick="b5uploadRemove(this)"><i class="fa fa-trash-o"></i>删除</a>
                                <a href="<?=$imglink?>" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]) && $widget_data['info'][$widget_data['name']]):?>
                    <?php foreach(is_array($widget_data['info'][$widget_data['name']])?$widget_data['info'][$widget_data['name']]:explode(',',$widget_data['info'][$widget_data['name']]) as $imglink):?>
                        <div class="b5uploadimg_li">
                            <input type="hidden" name="<?=$widget_data['name']?>[]" value="<?=$imglink?>">
                            <div class="b5uploadimg_con">
                                <div class="b5uploadimg_cell">
                                    <img src="<?=$imglink?>" alt="">
                                </div>
                            </div>
                            <div class="b5uploadimg_footer">
                                <a href="javascript:;" onclick="b5uploadRemove(this)"><i class="fa fa-trash-o"></i>删除</a>
                                <a href="<?=$imglink?>" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php $this->beginBlock('script_after'); ?>
<script>
    $(function () {
        b5uploadimginit("<?=$widget_data['id']?>");
        <?php if(isset($widget_data['drag'])):?>
            dragula(["<?=$widget_data['name']?>_imglist"]);
        <?php endif;?>
    })
</script>
<?php $this->endBlock(); ?>
