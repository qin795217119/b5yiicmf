<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|公告标题','extend'=>['name'=>'like[title]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|公告类型','extend'=>['name'=>'where[type]','value'=>'','place'=>'所有','data'=>$this->params['typeList']]])?></li>
                <li class="select-time">
                    <label>创建时间： </label>
                    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'between[create_time][start]','id'=>'startTime','place'=>'开始时间']])?>
                    <span>-</span>
                    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'between[create_time][end]','id'=>'endTime','class'=>'place'=>'结束时间']])?>
                </li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'addbtn','extend'=>['full'=>'']])?>
    <?= $this->render('/iframe',['name'=>'editbtn','extend'=>['full'=>'']])?>
    <?= $this->render('/iframe',['name'=>'deletebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var typeList = <?=json_encode($this->params['typeList'])?>;
        $(function () {
            var options = {
                modalName: "通知公告",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '公告ID', align: 'center', sortable: true},
                    {field: 'title', title: '公告标题'},
                    {
                        field: 'type',
                        title: '公告类型',
                        align: 'center',
                        formatter:function (value, row, index) {
                            if(typeList.hasOwnProperty(value)){
                                return typeList[value];
                            }else{
                                return '-';
                            }
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        sortable: true,
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },

                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {field: 'note', title: '备注',visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["editfull","delete"],"rowId"=>"row.id"]])?>';
                        }
                    }
                ]
            };
            $.table.init(options);
        });
    </script>
<?php $this->endBlock(); ?>

