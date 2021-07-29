<?php
if(isset($widget_data['type']) && $widget_data['type']):
    foreach($widget_data['type'] as $type):
?>
    <?php if($type=='edit'): ?><a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + <?= $widget_data['rowId']?> + '\')"><i class="fa fa-edit"></i>编辑</a><?php endif; ?>
    <?php if($type=='editfull'): ?><a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.editFull(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-edit"></i>编辑</a><?php endif; ?>
    <?php if($type=='edittab'): ?><a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.editTab(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-edit"></i>编辑</a><?php endif; ?>
    <?php if($type=='add'): ?><a class="btn btn-info btn-xs" href="javascript:;" onclick="$.operate.add(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-plus"></i>新增</a><?php endif; ?>
    <?php if($type=='addfull'): ?><a class="btn btn-info btn-xs" href="javascript:;" onclick="$.operate.addFull(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-plus"></i>新增</a><?php endif; ?>
    <?php if($type=='addtab'): ?><a class="btn btn-info btn-xs" href="javascript:;" onclick="$.operate.addTab(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-plus"></i>新增</a><?php endif; ?>
    <?php if($type=='list_mine'): ?><a class="btn btn-info btn-xs" href="javascript:;" onclick="detail_mine(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-list-ul"></i>列表</a><?php endif; ?>
    <?php if($type=='delete'): ?><a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-remove"></i>删除</a><?php endif; ?>
    <?php if($type=='deleteauth'): ?><a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + <?= $widget_data['rowId']?>+ '\')"><i class="fa fa-remove"></i>取消授权</a><?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
