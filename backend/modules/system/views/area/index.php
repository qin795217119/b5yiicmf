<?= \backend\extend\widgets\Asset::widget(['type'=>['treetable-async']])?>
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>编码：<input type="text" name="code"></li>
                <li>名称：<input type="text" name="name"></li>
                <li>
                    <a class="btn btn-primary btn-rounded btn-sm" onclick="$.treeTable.search()"><i class="fa fa-search"></i> 搜索</a>
                    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <a class="btn btn-success" onclick="$.operate.add(this)"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-info" id="expendinfobtn"><i class="fa fa-exchange"></i> 展开/折叠</a>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-tree-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
<script>
    $(function () {
        var options = {
            modalName: "行政区划",
            code: "code",
            parentCode: "p_code",
            uniqueId: "code",
            async: true,
            asyncLevel: 2,
            columns: [
                {
                    field: 'selectItem',
                    radio: true
                },
                {
                    field: 'name',
                    title: '名称',
                    formatter: function (value, row, index) {
                        return $.table.tooltip(value,25);
                    }
                },
                {field: 'code', title: '编码'},
                {field: 'level', title: '等级'},
                {
                    field: 'status',
                    title: '状态',
                    formatter: function (value, row, index) {
                        return $.view.statusShow(row,false);
                    }
                },
                {field: 'list_sort', title: '排序'},

                {
                    title: '操作',
                    formatter: function(value, row, index) {
                        var actions = [];
                        actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="$.operate.remove(\'' + row.id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                        return actions.join('');
                    }
                }
            ]
        };
        $.treeTable.init(options);
    });
</script>
<?php $this->endBlock(); ?>

