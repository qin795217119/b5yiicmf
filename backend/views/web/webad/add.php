<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['select2','summernote','dragula']])?>

<form class="form-horizontal m" id="form-webad-add">
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|推荐位置','extend'=>['name'=>'pos_id','required'=>1,'sm'=>'2','data'=>$this->params['posList'],'showvalue'=>'id','showname'=>'title','place'=>'','class'=>'select2','id'=>'pos_id']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|外链地址','extend'=>['name'=>'linkurl','sm'=>'2']])?>
    <div class="form-group mb0">
        <label class="col-sm-2 control-label">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control']])?>
        </div>
        <label class="col-sm-3 control-label">信息状态：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','required'=>1,'value'=>1]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'adlistimgbtn','multi'=>'true','sm'=>2,'tips'=>'','cat'=>'webad','drag'=>'true']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|文本内容','extend'=>['name'=>'text_text','sm'=>'2']])?>
    <div class="form-group">
        <label class="col-sm-2 control-label">图文内容：</label>
        <div class="col-sm-9">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'text_rich','type'=>'hidden','class'=>'summernote_content']])?>
            <div class="summernote" data-place=""></div>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
<script>
    var posList=<?=json_encode($this->params['posList'])?>;
    function select2change(obj) {
        if(obj.attr('id')=='pos_id'){
            showtipAndParam();
        }
    }
    function showtipAndParam() {
        var val=$("#pos_id").select2("val");
        $(".imglist_field .help-block").html('');
        $("#adlistimgbtn").attr("data-width",0).attr("data-height",0);

        if(posList.hasOwnProperty(val)){
            if($.common.isNotEmpty(posList[val].note)){
                $(".imglist_field .help-block").html('<i class="fa fa-info-circle"></i>'+posList[val].note+'，可拖动进行排序');
            }
            $("#adlistimgbtn").attr("data-width",posList[val].width).attr("data-height",posList[val].height);
        }
    }

    function submitHandler() {
        if ($.validate.form()) {
            var sHTML = $('.summernote').summernote('code');
            $(".summernote_content").val(sHTML);
            $.operate.save(oasUrl, $('#form-webad-add').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
