<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|信息标题','extend'=>['name'=>'like[title]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|推荐位置','extend'=>['name'=>'where[adtype]','value'=>'','place'=>'所有','data'=>$this->params['adposlist']]])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|跳转类型','extend'=>['name'=>'where[redtype]','value'=>'','place'=>'所有','data'=>$this->params['typelist']]])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|跳转模块','extend'=>['name'=>'where[redfunc]','value'=>'','place'=>'所有','data'=>$this->params['funclist']]])?></li>
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
    <?= $this->render('/iframe',['name'=>'cachebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var typelist = <?=json_encode($this->params['typelist'])?>;
        var funclist = <?=json_encode($this->params['funclist'])?>;
        var adposlist = <?=json_encode($this->params['adposlist'])?>;
        $(function () {
            var options = {
                modalName: "推荐信息",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '信息ID',  sortable: true},
                    {field: 'title', title: '信息标题'},
                    {
                        field: 'adtype',
                        title: '推荐位置',
                        formatter: function (value, row, index) {
                            return adposlist.hasOwnProperty(value)?adposlist[value]:'-';
                        }
                    },
                    {
                        field: 'redtype',
                        title: '跳转类型',
                        formatter: function (value, row, index) {
                            return typelist.hasOwnProperty(value)?typelist[value]:'-';
                        }
                    },
                    {
                        field: 'redfunc',
                        title: '跳转模块',
                        formatter: function (value, row, index) {
                            return funclist.hasOwnProperty(value)?funclist[value]:'-';
                        }
                    },
                    {
                        field: 'redinfo',
                        title: '跳转信息',
                        formatter:function (value, row, index) {
                            return value?$.table.tooltip(value,15):'-';
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
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

