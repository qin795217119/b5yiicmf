<?= \common\widgets\Asset::widget(['type'=>['select2']])?>

<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <input type="hidden" name="where[scratch_id]" value="<?=$this->params['scratchInfo']['id']?>" id="scratch_id">
        <div class="select-list">
            <ul>
                <li>所属活动：<span class="search-item-text"><?=$this->params['scratchInfo']['title']?></span></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|奖品名称','extend'=>['name'=>'like[name]']])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'addbtn','extend'=>['opid'=>$this->params['scratchInfo']['id']]])?>
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
                modalName: "活动奖品",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '奖品ID',  sortable: true,align:"center"},
                    {field: 'title', title: '奖品等级'},
                    {field: 'name', title: '奖品名称'},
                    {field: 'chance', title: '中奖概率'},
                    {
                        field: 'allnumber',
                        title: '奖品数量',
                        formatter: function(value, row, index) {
                            if(value=='0'){
                                return '不限';
                            }
                            return value;
                        }
                    },
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false);
                        }
                    },
                    {
                        field: 'isuse',
                        title: '是否可抽',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false,['否','是']);
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

