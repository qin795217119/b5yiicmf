<?php $this->context->layout = 'form';?>
<div class="main_box">
    <div class="col-xs-4">
        <p>
            <a href="javascript:;" class="btn btn-success b5ajaxget" data-title="确定执行此操作吗" data-url="<?= \yii\helpers\Url::toRoute(['','scratch_id'=>$this->params['scratchInfo']['id'],'type'=>'prizeusers'])?>">
                清空中奖信息及刮奖记录
            </a>
        </p>

        <p class="mt20">
            <a href="javascript:;" class="btn btn-danger b5ajaxget" data-title="确定执行此操作吗" data-url="<?= \yii\helpers\Url::toRoute(['','scratch_id'=>$this->params['scratchInfo']['id'],'type'=>'all'])?>">
                删除该活动及相关信息
            </a>
        </p>
    </div>
</div>

