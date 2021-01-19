<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|配置名称','extend'=>['name'=>'like[title]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|配置标识','extend'=>['name'=>'like[type]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|配置分组','extend'=>['name'=>'where[groups]','value'=>'','place'=>'所有','data'=>$this->params['grouplist']]])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/public/toolbar')?>
    <?= $this->render('/iframe',['name'=>'cachebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var stylelist=<?= json_encode($this->params['stylelist'])?>;
        var grouplist=<?= json_encode($this->params['grouplist'])?>;
        $(function () {
            var options = {
                modalName: "配置",
                sortName:'groups',
                columns: [
                    {checkbox: true},
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
                        formatter: function (value, row, index) {
                            return stylelist.hasOwnProperty(value)?stylelist[value]:'-';
                        }
                    },
                    {
                        title: '分组',
                        field: 'groups',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return grouplist.hasOwnProperty(value)?grouplist[value]:'-';
                        }
                    },
                    {field: 'listsort', title: '显示顺序',align: 'center', sortable: true},
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","delete"],"rowId"=>"row.id"]])?>';
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
<?php $this->endBlock(); ?>

