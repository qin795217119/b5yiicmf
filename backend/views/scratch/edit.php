<?php $this->context->layout = 'form';?>

<?= \common\widgets\Asset::widget(['type'=>['mypicker']])?>

<form class="form-horizontal m" id="form-scratch-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'forminput|活动名称','extend'=>['name'=>'title','required'=>1,'info'=>$info]])?>
    <div class="form-group mb15">
        <label class="col-sm-3 control-label is-required">开始时间：</label>
        <div class="col-sm-3 mb5">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'start_time','class'=>'form-control','required'=>1,'id'=>'start_time','readonly'=>'','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label is-required">结束时间：</label>
        <div class="col-sm-3 mb5">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'end_time','class'=>'form-control','required'=>1,'id'=>'end_time','readonly'=>'','info'=>$info]])?>
        </div>
    </div>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label is-required">每日次数：</label>
        <div class="col-sm-3 ">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'daynum','info'=>$info,'class'=>'form-control']])?>
        </div>
        <label class="col-sm-2 control-label is-required">活动状态：</label>
        <div class="col-sm-3 ">
            <?= \common\widgets\FormInput::widget(['name'=>'radio','extend'=>['name'=>'status','info'=>$info]])?>
        </div>
        <div class="mb15 col-xs-12 col-xs-offset-3">
            <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 每日次数为每人每天可刮奖的次数，0为不限制</span>
        </div>
    </div>
    <div class="form-group mb0">
        <label class="col-sm-3 control-label">主办单位：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'company','class'=>'form-control','info'=>$info]])?>
        </div>
        <label class="col-sm-2 control-label">技术支持：</label>
        <div class="col-sm-3 mb15">
            <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'support','class'=>'form-control','info'=>$info]])?>
        </div>
    </div>
    <?= \common\widgets\FormInput::widget(['name'=>'formtextarea|规则介绍','extend'=>['name'=>'contents','info'=>$info]])?>
</form>
<?php $this->beginBlock('script'); ?>
    <script>
        $(function () {
            $("#start_time").click(function () {
                WdatePicker({maxDate:'#F{$dp.$D(\'start_time\')}',dateFmt:'yyyy-MM-dd HH:mm:00'})
            });
            $("#end_time").click(function () {
                WdatePicker({minDate:'#F{$dp.$D(\'start_time\')}',dateFmt:'yyyy-MM-dd HH:mm:00'})
            });
        });
        function submitHandler() {
            if ($.validate.form()) {
                $.operate.save(oesUrl, $('#form-scratch-edit').serialize());
            }
        }
    </script>
<?php $this->endBlock(); ?>
