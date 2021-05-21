<?=$widget_data['title']?:''?>

<textarea
    name="<?=$widget_data['name']?>"
    <?=$widget_data['id']?'id="'.$widget_data['id'].'"':''?>
    class="<?=$widget_data['class']?:'form-control'?>"
    <?php if (isset($widget_data['place'])): ?>
        placeholder="<?=$widget_data['place']?>"
    <?php else: ?>
        placeholder="请输入<?=$widget_data['title']?>"
    <?php endif; ?>
    <?php if (isset($widget_data['maxlen']) && $widget_data['maxlen']): ?>
        maxlength="<?=$widget_data['maxlen']?>"
    <?php endif; ?>

    <?=isset($widget_data['required'])?' required':''?>

    <?=isset($widget_data['readonly'])?' readonly="true"':''?>

    <?=isset($widget_data['disabled'])?' disabled="true"':''?>
    rows="<?=$widget_data['rows']??'3'?>"
><?=(isset($widget_data['value']))?$widget_data['value']:((isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))?$widget_data['info'][$widget_data['name']]:'')?></textarea>

