<a class="btn btn-success"
<?php if(isset($widget_data['full'])): ?>
   onclick="$.operate.addFull('<?=$widget_data['opid']??''?>',this)"
<?php else: ?>
   onclick="$.operate.add('<?=$widget_data['opid']??''?>',this)"
<?php endif; ?>
   data-width="<?=$widget_data['width']??''?>"
   data-height="<?=$widget_data['height']??''?>"
>
    <i class="fa fa-plus"></i> <?=$widget_data['title']?:'新增'?>
</a>

