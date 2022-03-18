<div class="form-group <?=$widget_data['name']?>_field">
    <label class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-2':'col-sm-3'?> control-label <?=(isset($widget_data['required']))?'is-required':''?>"><?=$widget_data['title']?>：</label>
    <div class="<?=(isset($widget_data['sm']) && $widget_data['sm']=='2')?'col-sm-9':'col-sm-8'?>">
        <textarea name="<?=$widget_data['name']?>"  <?= $widget_data['id']?'id="'.$widget_data['id'].'"':''?> class="<?=$widget_data['class']?:'form-control'?>" <?php if (isset($widget_data['place'])): ?>placeholder="<?=$widget_data['place']?>"<?php else: ?>placeholder="请输入<?=$widget_data['title']?>"<?php endif; ?><?php if (isset($widget_data['maxlen']) && $widget_data['maxlen']): ?> maxlength="<?=$widget_data['maxlen']?>"<?php endif; ?><?=isset($widget_data['required'])?' required':''?><?=isset($widget_data['readonly'])?' readonly="true"':''?><?=isset($widget_data['disabled'])?' disabled="true"':''?> rows="<?=$widget_data['rows']??'3'?>"><?=(isset($widget_data['value']))?$widget_data['value']:((isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))?$widget_data['info'][$widget_data['name']]:'')?></textarea>
        <?php if(isset($widget_data['tips'])):?>
            <span class="help-block m-b-none"><?php if($widget_data['tips']):?><i class="fa fa-info-circle"></i> <?=$widget_data['tips']?><?php endif; ?></span>
        <?php endif; ?>
    </div>
</div>
