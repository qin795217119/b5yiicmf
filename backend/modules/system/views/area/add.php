<?php $this->context->layout = '/form';?>

<form class="form-horizontal m" id="form-add">
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">所属区划：</label>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <select name="province_id" class="form-control" id="province_id">
                        <option value="0">选择省份</option>
                        <?php foreach ($provinceList as $province):?>
                            <option value="<?=$province['code']?>"><?=$province['name']?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-sm-6">
                    <select name="city_id" class="form-control" id="city_id">
                        <option value="0">选择城市</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">名称：</label>
        <div class="col-sm-8">
            <input type="text" name="name" value="" class="form-control" required autocomplete="off" maxlength="30"/>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">编码：</label>
        <div class="col-sm-8">
            <input type="text" name="code" value="" class="form-control" required autocomplete="off" maxlength="20"/>
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 唯一，最好为行政区号</span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">状态：</label>
        <div class="col-sm-8">
            <label class="radio-box">
                <input type="radio" name="status" value="0"/> 隐藏
            </label>
            <label class="radio-box">
                <input type="radio" name="status" value="1" checked/> 显示
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label is-required">排序：</label>
        <div class="col-sm-8">
            <input type="number" name="list_sort" value="100" class="form-control" required autocomplete="off" min="0"/>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        $(function (){
            $("#province_id").change(function (){
                getCityList();
            })
        })
        //获取区划列表
        function getCityList(){
            var province_id = $("#province_id").val()
            if(!province_id || province_id=='0') {
                $("#city_id").html('<option value="0">选择城市</option>');
                return false;
            }
            $.ajax({
                type: "POST",
                url: "<?=\yii\helpers\Url::toRoute('ajax-get-area-list')?>",
                data: {pcode:province_id},
                dataType: "json",
                success: function (result) {
                    if (result.success) {
                        var list = result.data.list
                        var html = '<option value="0">选择城市</option>';
                        for (var i = 0; i < list.length; i++) {
                            html+='<option value="'+list[i].code+'">'+list[i].name+'</option>';
                        }
                        $("#city_id").html(html);
                    }else{
                        $("#city_id").html('<option value="0">选择城市</option>');
                    }
                },
                error:function (){
                    $("#city_id").html('<option value="0">选择城市</option>');
                }
            })
        }
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oasUrl, $('#form-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
