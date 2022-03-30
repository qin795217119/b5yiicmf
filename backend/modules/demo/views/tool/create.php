<?php $this->context->layout = '/form';?>

<?= \backend\extend\widgets\Asset::widget(['type'=>['select2']])?>

<div class="main-content">
    <div class="col-sm-12 alert alert-warning alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>
        <p>该功能主要是基于已存在的数据表，创建控制器、model、模板以及菜单数据（列表、增、删、改）。没有那么智能，只是简单生成，视图html可能需要自己进行修改</p>
        <p>注意：表的字段要添加注释信息</p>
    </div>
    <form class="form-horizontal m" id="form-add">

        <div class="form-group">
            <label class="col-sm-3 control-label is-required">选择表：</label>
            <div class="col-sm-6">
                <select class="form-control select2" name="table" id="table" data-width="400px" data-clear="1" required>
                    <option value="">请选择要生成表</option>
                    <?php foreach ($tableList as $table):?>
                    <option value="<?=$table?>"><?=$table?></option>
                    <?php endforeach;?>
                </select>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 已经去除系统自带的表</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label is-required">生成类名：</label>
            <div class="col-sm-6">
                <input type="text" name="class" class="form-control" placeholder="生成类名" id="class" required>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 一般为去除表的前缀，例如：goods_info,生成控制器为 Goodsinfo，模型名为GoodsInfo</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">所属模块：</label>
            <div class="col-sm-6">
                <select class="form-control" name="dir">
                    <option value="">应用模块</option>
                    <?php foreach ($modules as $module):?>
                        <option value="<?=$module?>"><?=$module?></option>
                    <?php endforeach;?>
                </select>
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 创建的控制器和视图将在选择模块内，模型文件默认放在common\models下的模块名文件夹内</span>
            </div>
        </div>
        <div class="row m-t-md">
            <div class="col-sm-offset-5 col-sm-10">
                <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>
                <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
            </div>
        </div>
    </form>
</div>

<?php $this->beginBlock('script'); ?>
    <script type="text/javascript">

        function select2change(obj){
            var id = obj.attr('id');
            var val = obj.val();
            if(id == 'table'){
                $("#class").val(val)
            }

        }
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.saveTab(aUrl, $('#form-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
