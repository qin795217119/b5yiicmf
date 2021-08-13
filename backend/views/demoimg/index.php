<?= \common\widgets\Asset::widget(['type'=>['viewer']])?>
<div class="col-sm-12 search-collapse">
    <form id="role-form">
        <div class="select-list">
            <ul>
                <li class="select-time">
                    <label>发布时间： </label>
                    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'between[sub_time][start]','id'=>'startTime','class'=>'time-input','place'=>'开始时间']])?>
                    <span>-</span>
                    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'between[sub_time][end]','id'=>'endTime','class'=>'time-input','place'=>'结束时间']])?>
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
    <?= $this->render('/iframe',['name'=>'addbtn','extend'=>['tab'=>1]])?>
    <?= $this->render('/iframe',['name'=>'editbtn','extend'=>['tab'=>1]])?>
    <?= $this->render('/iframe',['name'=>'deletebtn'])?>
</div>
<div class="col-sm-12 select-table table-striped">
    <table id="bootstrap-table"></table>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            var options = {
                modalName: "图片实例",
                sortName:'id',
                sortOrder: "desc",
                columns: [
                    {checkbox: true},
                    {field: 'id', title: 'ID',  sortable: true,visible:false},
                    {
                        title: '序号',
                        align: "center",
                        formatter: function (value, row, index) {
                            return $.table.serialNumber(index);
                        }
                    },
                    {
                        field: 'img1',
                        title: '单图片',
                        formatter: function (value, row, index) {
                            return $.table.imageView(value);
                        }
                    },
                    {
                        field: 'img2',
                        title: '多图片',
                        formatter: function (value, row, index) {
                            return $.table.imageView(value,null,null,'slide',row.id);
                        }
                    },
                    {
                        title: '裁剪图片',
                        field: 'img3',
                        formatter: function (value, row, index) {
                            return $.table.imageView(value);
                        }
                    },
                    {
                        title: '视频链接',
                        field: 'video',
                        align: 'center',
                        formatter: function (value, row, index) {
                            return $.table.tooltip(value,20,'link');
                        }
                    },
                    {field: 'create_time', title: '创建时间', align: 'center', sortable: true},
                    {field: 'update_time', title: '更新时间', align: 'center', sortable: true},
                    {
                        title: '操作',
                        align: 'center',
                        formatter: function(value, row, index) {
                            return '<?=$this->render("/iframe",["name"=>"formopbtn","extend"=>["type"=>["edittab","delete"],"rowId"=>"row.id"]])?>';
                        }
                    }
                ],
                onPostBody:function (data) {
                    for (let i = 0; i < data.length; i++) {
						if(data[i].img2){	
							new Viewer(document.getElementById('pts_'+data[i].id),{navbar:false,title:false});
						}
                    }
                }
            };
            $.table.init(options);
        });
    </script>
<?php $this->endBlock(); ?>

