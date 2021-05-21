<a
    class="btn btn-primary single {{isset($widget_data['disabled'])?'disabled':''}}"
<?php if(isset($widget_data['full'])): ?>
    onclick="$.operate.editFull('<?=$widget_data['opid']??''?>',this)"
<?php else: ?>
    onclick="$.operate.edit('<?=$widget_data['opid']??''?>',this)"
<?php endif; ?>
>
    <i class="fa fa-edit"></i> <?=$widget_data['title']?:'修改'?>
</a>

