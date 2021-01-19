<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['select2','summernote','dragula']])?>

<form class="form-horizontal m" id="form-adlist-add">
    <?= \common\widgets\FormInput::widget(['name'=>'formselect|推荐位置','extend'=>['name'=>'adtype','required'=>1,'sm'=>'2','data'=>$this->params['adposlist'],'showvalue'=>'type','showname'=>'title','place'=>'','value'=>'','class'=>'select2','id'=>'adtype','tips'=>'']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2']])?>
    <div class="form-group mb0">
        <label class="col-sm-2 control-label is-required">跳转类型：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'redtype','required'=>1,'data'=>$this->params['typelist'],'place'=>'','value'=>'','class'=>'form-control']])?>
        </div>
        <label class="col-sm-3 control-label">跳转模块：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'select','extend'=>['name'=>'redfunc','data'=>$this->params['funclist'],'place'=>'','value'=>'','class'=>'select2']])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|跳转值','extend'=>['name'=>'redinfo','sm'=>'2','tips'=>'当跳转类型为URL链接或信息内容时，此选项有效']])?>
    <div class="form-group mb0">
        <label class="col-sm-2 control-label">显示顺序：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'listsort','type'=>'number','class'=>'form-control','value'=>0]])?>
        </div>
        <label class="col-sm-3 control-label">信息状态：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','required'=>1,'value'=>1]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'adlistimgbtn','multi'=>'true','sm'=>2,'tips'=>'','cat'=>'adlist','drag'=>'true']])?>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|文本内容','extend'=>['name'=>'text_text','sm'=>'2']])?>
    <div class="form-group">
        <label class="col-sm-2 control-label">图文内容：</label>
        <div class="col-sm-9">
            <?= \common\widgets\FormInput::widget(['name'=>'textarea','extend'=>['name'=>'text_rich','class'=>'summernote_content hide']])?>
            <div class="summernote" data-place=""></div>
        </div>
    </div>
</form>

<?php $this->beginBlock('script'); ?>
    <script>
        var adposlist = '<?=json_encode($this->params['adposlist'])?>';

        function select2change(obj) {
            if(obj.attr('id')=='adtype'){
                var val=obj.val();
                $(".imglist_field .help-block").html('');
                $("#adlistimgbtn").attr("data-width",0).attr("data-height",0);

                if(adposlist.hasOwnProperty(val)){
                    if($.common.isNotEmpty(adposlist[val].note)){
                        $(".imglist_field .help-block").html('<i class="fa fa-info-circle"></i>'+adposlist[val].note+'，可拖动进行排序');
                    }
                    $("#adlistimgbtn").attr("data-width",adposlist[val].width).attr("data-height",adposlist[val].height);
                }
            }
        }
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oasUrl, $('#form-adlist-add').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
