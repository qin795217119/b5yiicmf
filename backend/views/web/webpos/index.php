<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|位置ID','extend'=>['name'=>'where[id]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|位置名称','extend'=>['name'=>'like[title]']])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'addbtn'])?>
    <?= $this->render('/iframe',['name'=>'editbtn'])?>
    <?= $this->render('/iframe',['name'=>'deletebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>
<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "位置",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '位置ID',  sortable: true,align:"center"},
                    {field: 'title', title: '位置名称'},
                    {
                        field: 'width',
                        title: '宽度',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '-';
                            }
                            return value;
                        }
                    },
                    {
                        field: 'height',
                        title: '高度',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '-';
                            }
                            return value;
                        }
                    },
                    {
                        field: 'note',
                        title: '备注',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,20);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
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

