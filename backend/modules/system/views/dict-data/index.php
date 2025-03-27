<?= \backend\extend\widgets\Asset::widget(['type'=>['select2']])?>
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>字典名称：
                    <select type="text" name="where[type]" class="select2">
                        <?php foreach ($typeList as $value):?>
                            <option value="<?=$value['type']?>" <?=$type==$value['type']?'selected':''?>><?=$value['name']?></option>
                        <?php endforeach;?>
                    </select>
                </li>
                <li>字典标签：<input type="text" name="like[title]" value=""></li>
                <li>状态：
                    <select name="where[status]">
                        <option value="">全部</option>
                        <option value="1">正常</option>
                        <option value="0">停用</option>
                    </select>
                <li>
                <li>
                    <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i> 搜索</a>
                    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <a class="btn btn-success" onclick="$.operate.add(null,'<?=$type?>')"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-primary single disabled" onclick="$.operate.edit(this)"><i class="fa fa-edit"></i> 修改</a>
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-remove"></i> 批量删除</a>
    <a class="btn btn-danger" onclick="closeItem()"> <i class="fa fa-reply-all"></i> 关闭</a>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var dictDataList = JSON.parse('<?=\common\services\system\DictService::getDictDataByType($type,true)?>');
        $(function () {
            var options = {
                modalName: "字典数据",
                sortName:'id',
                sortOrder: "asc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '字典编码', align: 'center', sortable:true},
                    // {
                    //     field: '',
                    //     title:'序号',
                    //     formatter:function (value, row, index){
                    //         return $.table.serialNumber(index);
                    //     }
                    // },
                    {
                        field: 'title', title: '字典标签', align: 'center',
                        formatter:function (value, row, index){
                            // return '<span class="label label-'+row.list_class+'">'+value+'</span>';
                            return $.table.selectDictLabel(dictDataList, row.value);
                        }
                    },
                    {field: 'value', title: '数据键值', align: 'center'},
                    {field: 'list_sort', title: '排序', align: 'center', sortable: true},
                    {
                        title: '状态', field: 'status', align: 'center', sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },
                    {
                        field: 'remark', title: '备注',
                        formatter: function(value, row, index) {
                            return $.table.tooltip(value,15);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {
                        title: '操作', align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i> 编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i> 删除</a> ');
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
<?php $this->endBlock(); ?>

