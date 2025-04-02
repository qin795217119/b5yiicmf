<?php $this->context->layout = '/full';?>

<?= \backend\extend\widgets\Asset::widget(['type'=>['ztree','jquery-layout']])?>
<div class="ui-layout-west">
    <div class="box box-main">
        <div class="box-header">
            <div class="box-title">
                <i class="fa icon-grid"></i> 组织部门
            </div>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" id="btnExpand" title="展开" style="display:none;"><i class="fa fa-chevron-up"></i></button>
                <button type="button" class="btn btn-box-tool" id="btnCollapse" title="折叠"><i class="fa fa-chevron-down"></i></button>
                <button type="button" class="btn btn-box-tool" title="刷新组织" onclick="getStructList()"><i class="fa fa-refresh"></i></button>
            </div>
        </div>
        <div class="ui-layout-content">
            <div id="tree" class="ztree"></div>
        </div>
    </div>
</div>

<div class="ui-layout-center">
    <div class="container-div">
        <div class="row">
            <div class="col-sm-12 search-collapse">
                <form id="role-form">
                    <input type="hidden" name="structId" id="structId" value="">
                    <div class="select-list">
                        <ul>
                            <li>名称 <input type="text" name="like[realname]" value=""></li>
                            <li>子部门
                                <select name="contains" style="min-width: 100px">
                                    <option value="1">包含</option>
                                    <option value="0">不包含</option>
                                </select>
                            <li>
                            <li>
                                <a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i> 搜索</a>
                                <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i> 重置</a>
                            </li>
                        </ul>
                    </div>
                </form>
            </div>
            <div class="btn-group-sm" id="toolbar" role="group">

            </div>
            <div class="col-sm-12 select-table table-striped">
                <table id="bootstrap-table"></table>
            </div>
        </div>
    </div>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var struct_treeUrl="<?=\yii\helpers\Url::toRoute('struct/tree')?>";
        var selectIds = "<?=$user_ids??''?>";
        var checkDisabled="<?=$check_disabled??''?>";
        var multiple = "<?=$mult??''?>";
        $(function () {
            var panehHidden = false;
            if ($(this).width() < 769) {
                panehHidden = true;
            }
            $('body').layout({ initClosed: panehHidden, west__size: 200,togglerContent_open:"<i class='fa fa-caret-left'></i>",togglerContent_closed:"<i class='fa fa-caret-right'></i>" });
            getStructList();
            getUserList();

            $('#btnExpand').click(function() {
                $._tree.expandAll(true);
                $(this).hide();
                $('#btnCollapse').show();
            });

            $('#btnCollapse').click(function() {
                $._tree.expandAll(false);
                $(this).hide();
                $('#btnExpand').show();
            });
        });
        function getStructList() {
            var options = {
                url: struct_treeUrl,
                expandLevel: 2,
                onClick : zOnClick
            };
            $.tree.init(options);
            $("#structId").val('');
            $.table.search();
            function zOnClick(event, treeId, treeNode) {
                $("#structId").val(treeNode.id);
                $.table.search();
            }
        }
        function getUserList() {
            var options = {
                modalName: "人员",
                url:"<?=\yii\helpers\Url::toRoute('ajaxtreelist')?>",
                sortName:'id',
                sortOrder:'asc',
                showToolbar:false,
				clickToSelect:true,//点击行选中/取消选中
                singleSelect : multiple !== '1',
                columns: [
                    {
                        checkbox: true,
                        formatter: function (value, row, index) {
                            if(selectIds && (","+selectIds+",").indexOf("," + row.id + ",")>-1){
                                return {
                                    checked: true,//设置选中
                                    disabled: multiple === '1' && checkDisabled === "1" // 默认选中的是否禁用
                                };
                            }
                            return value;
                        }
                    },
                    {field: 'id', title: '用户编号', align: 'center', visible: false},
                    {field: 'realname', align: 'center', title: '用户名称'},
                    {
                        field: 'struct_name',
                        title: '组织部门',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,15);
                        }
                    },
                    {
                        field: 'pos_name',
                        title: '岗位',
                        formatter:function (value, row, index) {
                            return $.table.tooltip(value,9);
                        }
                    },
                    {
                        title: '状态',
                        field: 'status',
                        align: 'center',
                        visible: false,
                        formatter: function (value, row, index) {
                            return $.view.statusTools(row,true);
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true,visible: false}
                ]
            };
            $.table.init(options);
        }

        //获取选择的行，数组形式
        function getCheckRows(){
            return $('#bootstrap-table').bootstrapTable('getSelections');
        }

        function getNewCheckRows() {
            var list = getCheckRows();
            if (!selectIds) return list;
            var selectIdsPattern = ","+selectIds+",";
            var newList = [];
            for (var i = 0; i < list.length; i++) {
                if(selectIdsPattern.indexOf("," + list[i].id + ",") === -1) {
                    newList.push(list[i]);
                }
            }
            return newList;
        }
    </script>
<?php $this->endBlock(); ?>

