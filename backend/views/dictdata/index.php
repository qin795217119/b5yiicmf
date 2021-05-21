<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|字典类型','extend'=>['name'=>'where[parent_id]','id'=>'dictType','class'=>'select2','data'=>$this->params['typeList'],'showvalue'=>'id','showname'=>'name','place'=>'所有字典','value'=>$input['parent_id']??'']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|数据名称','extend'=>['name'=>'where[name]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|数据状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有']])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'btn|新增','extend'=>['class'=>'btn-success','id'=>'addDictData']])?>
    <?= $this->render('/iframe',['name'=>'editbtn'])?>
    <?= $this->render('/iframe',['name'=>'deletebtn'])?>
    <?= $this->render('/iframe',['name'=>'closetab'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "数据",
                sortName:'listsort',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '数据ID',  sortable: true},
                    {field: 'name', title: '数据名称'},
                    {field: 'value', title: '数据值'},
                    {field: 'listsort', title: '显示顺序',align: 'center', sortable: true},
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
                            return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","delete"],"rowId"=>"row.id"]])?>';
                        }
                    }
                ]
            };
            $.table.init(options);

            //新增字典数据-传入当前类型
            $("#addDictData").click(function () {
                var dictType = $("#dictType option:selected").val();
                $.operate.add(dictType);
            })
        });
    </script>
<?php $this->endBlock(); ?>

