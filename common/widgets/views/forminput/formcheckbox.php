<div class="form-group <?=$widget_data['name']?>_field">
    <label class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-2':'col-sm-3'?> control-label <?=(isset($widget_data['required']))?'is-required':''?>"><?=$widget_data['title']?>：</label>
    <div class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-9':'col-sm-8'?>" id="<?=$widget_data['name']?>_checklist">
        <?php if(isset($widget_data['data']) && $widget_data['data']): ?>
            <?php $wdradip_index=0;?>
            <?php foreach ($widget_data['data'] as $key => $val): ?>
                <?php $wdradip_index++; ?>
                <?php if (is_array($val)): ?>
                    <label class="check-box" for="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>">
                        <?php if(isset($widget_data['value'])): ?>
                            <input type="checkbox"
                                   id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>"
                                   name="<?=$widget_data['name']?>"
                                   value="<?=$val[$widget_data['showvalue']]?>"
                                   text="<?=$val[$widget_data['showname']]?>"
                                   <?=(in_array($val[$widget_data['showvalue']],is_array($widget_data['value'])?$widget_data['value']:explode(',',$widget_data['value'])))?'checked':''?>
                                   <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                            >
                        <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])): ?>
                            <input type="checkbox"
                                   id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>"
                                   name="<?=$widget_data['name']?>"
                                   value="<?=$val[$widget_data['showvalue']]?>"
                                   text="<?=$val[$widget_data['showname']]?>"
                                   <?=(in_array($val[$widget_data['showvalue']],is_array($widget_data['info'][$widget_data['name']])?$widget_data['info'][$widget_data['name']]:explode(',',$widget_data['info'][$widget_data['name']])))?'checked':''?>
                                   <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                            >
                        <?php else: ?>
                            <input type="checkbox" id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>" name="<?=$widget_data['name']?>" value="<?=$val[$widget_data['showvalue']]?>" text="<?=$val[$widget_data['showname']]?>"  <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>>
                        <?php endif;?>
                            <?=$val[$widget_data['showname']]?>
                    </label>
                <?php else: ?>
                    <label class="check-box" for="<?=$widget_data['name']?>_<?=$key?>">
                        <?php if(isset($widget_data['value'])): ?>
                            <input type="checkbox"
                                   id="<?=$widget_data['name']?>_<?=$key?>"
                                   name="<?=$widget_data['name']?>"
                                   value="<?=$key?>"
                                   text="<?=$val?>"
                                   <?=(in_array($key,is_array($widget_data['value'])?$widget_data['value']:explode(',',$widget_data['value'])))?'checked':''?>
                                    <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                            >
                        <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])): ?>
                            <input type="checkbox"
                                   id="<?=$widget_data['name']?>_<?=$key?>"
                                   name="<?=$widget_data['name']?>"
                                   value="<?=$key?>"
                                   text="<?=$val?>"
                                   <?=(in_array($key,is_array($widget_data['info'][$widget_data['name']])?$widget_data['info'][$widget_data['name']]:explode(',',$widget_data['info'][$widget_data['name']])))?'checked':''?>
                                    <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                            >
                        <?php else: ?>
                            <input type="checkbox" id="<?=$widget_data['name']?>_<?=$key?>" name="<?=$widget_data['name']?>" value="<?=$key?>" text="<?=$val?>" <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>>
                        <?php endif;?>
                            <?=$val?>
                    </label>
                <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
        <?php if(isset($widget_data['tips']) && $widget_data['tips']): ?>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?></span>
        <?php endif;?>
    </div>
</div>
