<?=$widget_data['title']?:''?>

<?php $wdradip_index=0;?>
<?php foreach ($widget_data['data']??[0=>'停用',1=>'启用'] as $key => $val):?>
    <?php $wdradip_index++; ?>
    <div class="radio-box">
        <?php if (is_array($val)):?>
            <?php if(isset($widget_data['value'])):?>
                <input type="radio"
                       id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>"
                       name="<?=$widget_data['name']?>"
                       value="<?=$val[$widget_data['showvalue']]?>"
                       <?=($val[$widget_data['showvalue']]==$widget_data['value']  && $widget_data['value']!=='')?'checked':''?>
                       <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                >
            <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])):?>
                <input type="radio"
                       id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>"
                       name="<?=$widget_data['name']?>"
                       value="<?=$val[$widget_data['showvalue']]?>"
                       <?=($val[$widget_data['showvalue']]==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='')?'checked':''?>
                       <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                >
            <?php else:?>
                <input type="radio" id="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>" name="<?=$widget_data['name']?>" value="<?=$val[$widget_data['showvalue']]?>"   <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
            <?php endif;?>
            <label for="<?=$widget_data['name']?>_<?=$val[$widget_data['showvalue']]?>"><?=$val[$widget_data['showname']]?></label>
        <?php else:?>
            <?php if(isset($widget_data['value'])):?>
                <input type="radio"
                       id="<?=$widget_data['name']?>_<?=$key?>"
                       name="<?=$widget_data['name']?>"
                       value="<?=$key?>"
                       <?=($key==$widget_data['value'] && $widget_data['value']!=='')?'checked':''?>
                       <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                >
            <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])):?>
                <input type="radio"
                       id="<?=$widget_data['name']?>_<?=$key?>"
                       name="<?=$widget_data['name']?>"
                       value="<?=$key?>"
                       <?=($key==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!=='')?'checked':''?>
                       <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>
                >
            <?php else:?>
                <input type="radio" id="<?=$widget_data['name']?>_<?=$key?>" name="<?=$widget_data['name']?>" value="<?=$key?>"  <?=(isset($widget_data['required']) && $wdradip_index==1)?'required':''?>>
            <?php endif;?>
            <label for="<?=$widget_data['name']?>_<?=$key?>"><?=$val?></label>
        <?php endif;?>
    </div>
<?php endforeach;?>

<?php if(isset($widget_data['tips']) && $widget_data['tips']):?>
    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?></span>
<?php endif;?>
