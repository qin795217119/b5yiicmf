<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['mypicker','summernote','dragula']])?>

<form class="form-horizontal m" id="form-weblist-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'catid','type'=>'hidden','id'=>'treeId','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|所属栏目','extend'=>['name'=>'','id'=>'treeName','readonly'=>'','sm'=>'2','addon'=>'fa-search','value'=>$this->params['catInfo']['name']]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|信息标题','extend'=>['name'=>'title','required'=>1,'sm'=>'2','info'=>$info]])?>
    <div class="form-group mb0">
        <label class="col-sm-2 control-label">信息来源：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'froms','class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-3 control-label">编辑作者：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'author','class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|信息简介','extend'=>['name'=>'remark','sm'=>'2','tips'=>'为空时自动截取内容的前100个字符','info'=>$info]])?>
    <div class="form-group mb0">
        <label class="col-sm-2 control-label">发布时间：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'subtime','class'=>'form-control','id'=>'subtime','readonly'=>'','info'=>$info]])?>
        </div>
        <label class="col-sm-3 control-label">信息状态：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','required'=>1,'info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|外链地址','extend'=>['name'=>'linkurl','sm'=>'2','tips'=>'详情为第三链接时，点击跳转到改地址','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'image|图片信息','extend'=>['name'=>'imglist','id'=>'weblistimgbtn','multi'=>'true','sm'=>2,'tips'=>'默认第一张为该信息的缩略图','cat'=>'weblist','drag'=>'true','info'=>$this->params['extInfo']]])?>
    <div class="form-group">
        <label class="col-sm-2 control-label">图文内容：</label>
        <div class="col-sm-9">
                <?= \common\widgets\FormInput::widget(['name'=>'textarea','extend'=>['name'=>'content','class'=>'summernote_content hide','info'=>$this->params['extInfo']]])?>

            <div class="summernote" data-place=""></div>
        </div>
    </div>
</form>


<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            $("#subtime").click(function () {
                WdatePicker({maxDate:'%y-%M-%d',dateFmt:'yyyy-MM-dd HH:mm:ss'})
            });
            //选择菜单树
            $("#treeName").click(function () {
                var treeId = $("#treeId").val();
                var menuId = treeId > -1 ? treeId : 1;
                var url = urlcreate("<?=\yii\helpers\Url::toRoute('webcat/tree')?>","id=" + menuId + "&root=0");
                console.log(url)
                var options = {
                    title: '菜单选择',
                    width: "380",
                    url: url,
                    callBack: doSubmit,
                    onClick : zOnClick
                };
                $.modal.openOptions(options);
            });
        });
        function zOnClick(event, treeId, treeNode) {
            console.log(treeNode)
        }
        function doSubmit(index, layero){
            var body = layer.getChildFrame('body', index);
            $("#treeId").val(body.find('#treeId').val());
            $("#treeName").val(body.find('#treeName').val());
            layer.close(index);
        }
        function submitHandler() {
            if ($.validate.form()) {
                var sHTML = $('.summernote').summernote('code');
                $(".summernote_content").val(sHTML);
                $.operate.save(oesUrl, $('#form-weblist-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
