<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li>字典名称：<input type="text" name="like[name]" value=""></li>
                <li>字典类型：<input type="text" name="like[type]" value=""></li>
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
    <a class="btn btn-success" onclick="$.operate.add()"><i class="fa fa-plus"></i> 新增</a>
    <a class="btn btn-primary single disabled" onclick="$.operate.edit(this)"><i class="fa fa-edit"></i> 修改</a>
    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll(this)"><i class="fa fa-remove"></i> 批量删除</a>
<!--    <a class="btn btn-warning" onclick="$.operate.clearcache()"><i class="fa fa-refresh"></i> 清除缓存</a>-->
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "字典类型",
                sortName:'id',
                sortOrder: "asc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '字典编号', align: 'center', sortable:true},
                    // {
                    //     field: '',
                    //     title:'序号',
                    //     formatter:function (value, row, index){
                    //         return $.table.serialNumber(index);
                    //     }
                    // },
                    {field: 'name', title: '字典名称'},
                    {
                        field: 'type', title :'字典类型',
                        formatter:function (value, row, index) {
                            return '<a href="javascript:;" onclick="toData(\'' + value + '\')">'+value+'</a>'
                        }
                    },
                    {
                        title: '字典状态', field: 'status', align: 'center', sortable: true,
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
                            actions.push('<a class="btn btn-info btn-xs" href="javascript:;" onclick="toData(\'' + row.type + '\')"><i class="fa fa-list"></i> 数据</a> ');
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:;" onclick="$.operate.edit(\'' + row.id + '\')"><i class="fa fa-edit"></i> 编辑</a> ');
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:;" onclick="toDelete(\'' + row.id + '\')"><i class="fa fa-remove"></i> 删除</a> ');
                            return actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });

        function toData(dictType){
            var url = "<?=\yii\helpers\Url::toRoute('dict-data/index')?>";
            url=urlcreate(url,'type=' + dictType);
            $.modal.openTab("字典数据", url);
        }

        function toDelete(id){
            $.modal.confirm("确定删除该字典类型以及其下所有字典数据信息吗？", function() {
                var url = table.options.removeUrl;
                var data = { "id": id };
                $.operate.submit(url, "post", "json", data);
            });
        }
    </script>
<?php $this->endBlock(); ?>

