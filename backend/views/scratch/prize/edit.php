<?php $this->context->layout = 'form';?>

    <form class="form-horizontal m" id="form-scratchprize-edit">
        <?= \common\widgets\FormInput::widget(['name'=>'forminput|所属活动','extend'=>['name'=>'','required'=>1,'sm'=>'2','value'=>$this->params['scratchInfo']['title']??'未知','disabled'=>'']])?>
        <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
        <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'scratch_id','type'=>'hidden','info'=>$info]])?>
        <div class="form-group mb15">
            <label class="col-sm-2 control-label is-required">奖品等级：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'title','class'=>'form-control','required'=>1,'place'=>'等级:一等奖','info'=>$info]])?>
            </div>
            <label class="col-sm-3 control-label is-required">奖品名称：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'name','class'=>'form-control','required'=>1,'place'=>'真实名称','info'=>$info]])?>
            </div>
        </div>
        <?= \common\widgets\FormInput::widget(['name'=>'image|奖品图片','extend'=>['name'=>'thumbimg','id'=>'thumbimgbtn','sm'=>2,'tips'=>'400*400像素','width'=>'400','height'=>'400','cat'=>'scratch','required'=>1,'info'=>$info]])?>
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">中奖概率：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'chance','class'=>'form-control','type'=>'number','required'=>1,'info'=>$info]])?>
            </div>
            <label class="col-sm-3 control-label is-required">奖品数量：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'allnumber','class'=>'form-control','type'=>'number','required'=>1,'info'=>$info]])?>
            </div>
            <div class="mb15 col-xs-12 col-xs-offset-2">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 整数大于0。设置1000，概率为1000分之一。0为抽不中，1为一定中</span>
            </div>
        </div>
        <div class="form-group mb0">
            <label class="col-sm-2 control-label is-required">奖品状态：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','info'=>$info]])?>
            </div>
            <label class="col-sm-3 control-label is-required">是否可抽：</label>
            <div class="col-sm-3 ">
                <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'isuse','info'=>$info,'data'=>['否','是']]])?>
            </div>
            <div class="mb15 col-xs-12 col-xs-offset-2">
                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 奖品状态决定用户是否可以看到和抽取；是否可抽决定是否能够抽到</span>
            </div>
        </div>
        <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|奖品介绍','extend'=>['name'=>'contents','sm'=>2,'info'=>$info]])?>
    </form>

<?php $this->beginBlock('script'); ?>
    <script>
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-scratchprize-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
