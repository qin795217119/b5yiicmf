<?= \common\widgets\Asset::widget(['type'=>['treetable']])?>

<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|菜单名称','extend'=>['name'=>'like[name]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|菜单状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchtreebtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'addbtn'])?>
    <?= $this->render('/iframe',['name'=>'editbtn'])?>
    <?= $this->render('/iframe',['name'=>'expendbtn'])?>
</div>

<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-tree-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var datas = '';
        $(function() {
            var options = {
                modalName: "菜单",
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                    {
                        title: '菜单名称',
                        field: 'name',
                        formatter: function(value, row, index) {
                            if ($.common.isEmpty(row.icon)) {
                                return row.name;
                            } else {
                                return '<i class="' + row.icon + '"></i> <span class="nav-label">' + row.name + '</span>';
                            }
                        }
                    },
                    {field: 'listsort', title: '排序',},
                    {
                        field: 'url',
                        title: '请求地址',
                        formatter: function(value, row, index) {
                            return $.table.tooltip(value);
                        }
                    },
                    {
                        title: '类型',
                        field: 'type',
                        formatter: function(value, item, index) {
                            if (item.type == 'M') {
                                return '<span class="label label-success">目录</span>';
                            }
                            else if (item.type == 'C') {
                                return '<span class="label label-primary">菜单</span>';
                            }
                            else if (item.type == 'F') {
                                return '<span class="label label-warning">按钮</span>';
                            }
                        }
                    },
                    {
                        field: 'status',
                        title: '可见',
                        formatter: function(value, row, index) {
                            if (row.type == 'F') {
                                return $.view.statusShow(row,false,['禁止访问','可以访问']);
                            }
                            return $.view.statusShow(row,false,['隐藏','显示']);

                        }
                    },
                    {
                        field: 'perms',
                        title: '权限标识',
                        formatter: function(value, row, index) {
                            if(!value){
                                return '-';
                            }else{
                                return value;
                            }
                        }
                    },
                    {field: 'note', title: '备注',visible:false},
                    {
                        title: '操作',
                        formatter: function(value, row, index) {
                            return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add","delete"],"rowId"=>"row.id"]])?>';
                        }
                    }]
            };
            $.treeTable.init(options);
        });
    </script>
<?php $this->endBlock(); ?>
