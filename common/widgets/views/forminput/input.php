<?=$widget_data['title']?:''?>

<input
    type="<?=(isset($widget_data['type']) && $widget_data['type'])?$widget_data['type']:'text'?>"
    name="<?=$widget_data['name']??''?>"
    value="<?= isset($widget_data['value'])?$widget_data['value']:((isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']]))?$widget_data['info'][$widget_data['name']]:'') ?>"
    <?= $widget_data['id']?'id="'.$widget_data['id'].'"':''?>
    class="<?= $widget_data['class']??''?>"
    <?= isset($widget_data['place'])?'placeholder="'.$widget_data['place'].'"':''?>
    <?= (isset($widget_data['maxlen']) && $widget_data['maxlen'])?'maxlength="'.$widget_data['maxlen'].'"':'' ?>
    <?= isset($widget_data['required'])?'required':''?>
    <?= isset($widget_data['readonly'])?'readonly="true"':''?>
    <?= isset($widget_data['style'])?'style="'.$widget_data['style'].'"':''?>
    autocomplete="off"
/>
<?php if(isset($widget_data['addon']) && $widget_data['addon']): ?>
<span class="input-group-addon"><i class="fa <?=$widget_data['addon']?>"></i></span>
<?php endif; ?>



