
<div class="bs-callout bs-callout-danger" id="callout-tables-striped-ie8">
    <h4>使用提示</h4>
    <p>1.关注首页的测试微信公众号</p>
    <p>2.在微信打开链接 http://b5yiicmf.b5net.com/h5/scratch?act_id=1</p>
</div>
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|活动ID','extend'=>['name'=>'where[id]']])?></li>
                <li><?= \common\widgets\FormInput::widget(['name'=>'input|活动名称','extend'=>['name'=>'like[title]']])?></li>
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
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>
<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "微刮奖",
                sortName:'id',
                columns: [
                    {checkbox: true},
                    {field: 'id', title: '活动ID',  sortable: true,align:"center"},
                    {field: 'title', title: '活动名称'},
                    {field: 'start_time', title: '开始时间'},
                    {field: 'end_time', title: '结束时间'},
                    {
                        field: 'status',
                        title: '状态',
                        formatter: function(value, row, index) {
                            return $.view.statusShow(row,false);

                        }
                    },
                    {
                        field: 'daynum',
                        title: '每日次数',
                        formatter:function (value, row, index) {
                            if(value=='0'){
                                return '不限';
                            }
                            return value;
                        }
                    },
                    {field: 'company', title: '主办单位'},
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true,visible: false},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            var str='<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edit"],"rowId"=>"row.id"]])?>';

                            var actions = [];
                            var more = [];
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='getPrizeUser(" + row.id + ")'><i class='fa fa-user'></i> 中奖记录</a>");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='prizeSet(" + row.id + ")'><i class='fa fa-gift'></i> 奖品设置</a> ");
                            more.push("<a class='btn btn-default btn-xs' href='javascript:;' onclick='dataClear(" + row.id + ")'><i class='fa fa-trash'></i> 数据清除</a>");
                            actions.push('<a tabindex="0" class="btn btn-info btn-xs" data-placement="left" data-toggle="popover" data-html="true" data-trigger="focus" data-container="body" data-content="' + more.join('') + '"><i class="fa fa-chevron-circle-right"></i>更多操作</a>');
                            return str+actions.join('');
                        }
                    }
                ]
            };
            $.table.init(options);
        });
        function getPrizeUser(scratch_id) {
            var url='<?= \yii\helpers\Url::toRoute('scratchprizeusers/index')?>';
            url = urlcreate(url,'scratch_id='+scratch_id);
            $.modal.openTab("【"+scratch_id+"】中奖列表", url);
        }
        function prizeSet(scratch_id) {
            var url='<?= \yii\helpers\Url::toRoute('scratchprize/index')?>';
            url = urlcreate(url,'scratch_id='+scratch_id);
            $.modal.openTab("【"+scratch_id+"】活动奖品", url);
        }
        function dataClear(scratch_id) {
            var url='<?= \yii\helpers\Url::toRoute('initdata')?>';
            url = urlcreate(url,'scratch_id='+scratch_id);
            $.modal.openTab("【"+scratch_id+"】数据清除", url);
        }
    </script>
<?php $this->endBlock(); ?>

