<?= \common\widgets\Asset::widget(['type'=>['treetable']])?>

<div class="col-sm-12 search-collapse">
    <form id="webcat-form">
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
        $(function() {
            var options = {
                modalName: "网站栏目",
                columns: [{
                    field: 'selectItem',
                    radio: true
                },
                {
                    title: '栏目标题',
                    field: 'name',
                    formatter: function(value, row, index) {
                        return $.table.tooltip(value,7);
                    }
                },
                {title: 'ID', field: 'id'},
                {title: '类型', field: 'type_name'},
                {
                    field: 'status',
                    title: '状态',
                    formatter: function(value, row, index) {
                        return $.view.statusShow(row,false,['隐藏','显示']);
                    }
                },
                {title: '排序', field: 'listsort'},
                {title: '外链地址', field: 'url',visible: false,formatter: function(value, row, index) {return value?value:'-';}},
                {title: '列表模板', field: 'template_list',visible: false,formatter: function(value, row, index) {return value?value:'-';}},
                {title: '详情模板', field: 'template_info',visible: false,formatter: function(value, row, index) {return value?value:'-';}},
                {title: '选中标识', field: 'checkcode',visible: false,formatter: function(value, row, index) {return value?value:'-';}},
                {
                    title: '操作',
                    formatter: function(value, row, index) {
                        return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edit","add","delete"],"rowId"=>"row.id"]])?>';
                    }
                }]
            };
            $.treeTable.init(options);

            //新增字典数据-传入当前网站
            $("#addWebCat").click(function () {
                var website = $("#website option:selected").val();
                $.operate.addExt("website="+website);
            })
        });
        function cacheDel() {
            var website=$("#website").val();
            $.operate.clearcache('website='+website);
        }
    </script>
<?php $this->endBlock(); ?>
