<?=$widget_data['title']?:''?>

<select
    name="<?=$widget_data['name']?>"
    <?= $widget_data['id']?'id="'.$widget_data['id'].'"':''?>"
    class="<?= $widget_data['class']??''?>"
    <?= isset($widget_data['required'])?'required':''?>
    <?= isset($widget_data['readonly'])?'readonly="true"':''?>
    <?= isset($widget_data['mult'])?'multiple':''?>>
    <?php if (isset($widget_data['place'])): ?>
        <?php if ($widget_data['place']): ?>
            <option value=""><?=$widget_data['place']?></option>
        <?php else: ?>
            <option value="">请选择<?=$widget_data['title']?></option>
        <?php endif; ?>
    <?php endif; ?>
    <?php foreach ($widget_data['data']??[1=>'正常',0=>'停用'] as $key => $val): ?>
      <?php if (is_array($val)): ?>
            <option value="<?=$val[$widget_data['showvalue']]?>"
                <?php if(isset($widget_data['value'])): ?>
                    <?php if ($val[$widget_data['showvalue']]==$widget_data['value']  && $widget_data['value']!==''): ?>
                        selected=""
                    <?php endif; ?>
                <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])) :?>
                    <?php if ($val[$widget_data['showvalue']]==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!==''):?>
                        selected=""
                     <?php endif; ?>
                <?php endif; ?>
            ><?=$val[$widget_data['showname']]?></option>
        <?php else: ?>
            <option value="<?=$key?>"
                <?php if(isset($widget_data['value'])):?>
                    <?php if ($key==$widget_data['value']  && $widget_data['value']!==''):?>
                        selected=""
                    <?php endif; ?>
                <?php elseif(isset($widget_data['info']) && isset($widget_data['info'][$widget_data['name']])):?>
                    <?php if ($key==$widget_data['info'][$widget_data['name']]  && $widget_data['info'][$widget_data['name']]!==''):?>
                        selected=""
                    <?php endif; ?>
                <?php endif; ?>
            ><?=$val?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>
