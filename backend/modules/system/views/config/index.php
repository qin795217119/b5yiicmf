<?= \backend\extend\widgets\Asset::widget(['type'=>['export']])?>

<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>配置名称：<input type="text" name="like[title]" value=""></li>
                <li>配置标识：<input type="text" name="like[type]" value=""></li>
                <li>配置类型：
                    <select name="where[style]">
                        <option value="">全部</option>
                        <?php foreach ($styleList as $type=>$name):?>
                        <option value="<?=$type?>"><?=$name?></option>
                        <?php endforeach;?>
                    </select>
                <li>
                <li>配置分组：
                    <select name="where[groups]">
                        <option value="">全部</option>
                        <?php foreach ($groupList as $type=>$name):?>
                        <option value="<?=$type?>"><?=$name?></option>
                        <?php endforeach;?>
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
    <a class="btn btn-success" onclick="$.operate.add('',this)"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-primary single disabled" onclick="$.operate.edit(this)"><i class="fa fa-edit"></i> 修改</a>
    <a class="btn btn-warning" onclick="$.table.exportExcel()"><i class="fa fa-download"></i> 导出Excel</a>
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-trash"></i> 批量删除</a>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "配置",
                sortName:'id',
                sortOrder: "asc",
                showExport: true,
                columns: [
                    {
                        checkbox: true,
                        formatter:function (value,row,index){
                            if(row.id == 1){
                                return {
                                    disabled : true
                                }
                            }
                        }
                    },
                    {field: 'id', title: '配置ID',  sortable: true},
                    {field: 'title', title: '配置标题'},
                    {field: 'type', title: '配置标识', sortable: true},
                    {
                        field: 'value',
                        title: '配置值',
                        formatter: function(value, row, index) {
                            return $.table.tooltip(value,15);
                        }
                    },
                    {
                        field: 'extra',
                        title: '配置项',
                        formatter: function(value, row, index) {
                            if(value=='') return '-';
                            return $.table.tooltip(value);
                        }
                    },
                    {
                        title: '类型',
                        field: 'style',
                        sortable: true,
                        formatter: function(value, row, index) {
                            return row.style_name;
                        }
                    },
                    {
                        title: '分组',
                        field: 'groups',
                        sortable: true,
                        formatter: function(value, row, index) {
                            return row.group_name;
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var actions = [];
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            if(row.is_sys!=1){
                                actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                            }
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
<?php $this->endBlock(); ?>

