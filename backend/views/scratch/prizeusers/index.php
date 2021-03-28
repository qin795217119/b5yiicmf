<div class="col-sm-12 search-collapse">
    <form id="website-form">
        <input type="hidden" name="where[scratch_id]" value="<?=$this->params['scratchInfo']['id']?>" id="scratch_id">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|中奖奖品','extend'=>['name'=>'where[prize_id]','data'=>$this->params['prizeList'],'place'=>'','class'=>'select2']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|昵称','extend'=>['name'=>'like[nickname]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'select|领取状态','extend'=>['name'=>'where[status]','value'=>'','place'=>'所有','data'=>['未领取','已领取']]])?></li>
                <li>
                    <?= $this->render('/iframe',['name'=>'searchbtn|搜索'])?>
                    <?= $this->render('/iframe',['name'=>'resetbtn|重置'])?>
                </li>
            </ul>
        </div>
    </form>
</div>
<div class="btn-group-sm" id="toolbar" role="group">
    <?= $this->render('/iframe',['name'=>'deletebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>
<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "中奖信息",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID', align: 'center', sortable: true},
                    {field: 'prize_name', title: '奖品信息'},
                    {field: 'nickname', title: '中奖人员', align: 'center'},
                    {field: 'getcode', title: '领取码', align: 'center'},
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.view.statusShow(row,true,['未领取','已领取']);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'get_time', title: '领取时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false}
                ]
            };
            $.table.init(options);
        });
    </script>
    <?php $this->endBlock(); ?>

