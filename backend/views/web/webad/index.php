<?= \common\widgets\Asset::widget(['type'=>['select2']])?>
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|广告位置','extend'=>['name'=>'where[pos_id]','data'=>$this->params['posList'],'showvalue'=>'id','showname'=>'title','class'=>'select2','place'=>'']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|信息标题','extend'=>['name'=>'like[title]']])?></li>
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
        var posList=<?=json_encode($this->params['posList'])?>;
        $(function () {
            var options = {
                modalName: "位置",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    // {
                    //     field: '',
                    //     title: '序号',
                    //     sortable: false,
                    //     align: "center",
                    //     width: 40,
                    //     formatter: function (value, row, index) {
                    //         return $.table.serialNumber(index);
                    //     }
                    // },
                    {field: 'id', title: 'ID',  sortable: true,align:"center"},
                    {
                        field: 'title',
                        title: '信息标题',
                        formatter:function (value, row, index) {
                            if(value==''){
                                return '-';
                            }
                            return $.table.tooltip(value,20);
                        }},
                    {
                        field: 'pos_id',
                        title: '广告位置',
                        sortable: true,
                        formatter:function (value, row, index) {
                            return $.table.tooltip(posList.hasOwnProperty(value)?posList[value].title:value,20);
                        }
                    },
                    {
                        field: 'linkurl',
                        title: '外链地址',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '-';
                            }
                            return $.table.tooltip(value,20);
                        }
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false);

                        }
                    },
                    {field: 'listsort',title: '排序',sortable: true},
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

