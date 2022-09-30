<?= $this->blocks['js_common']??''?>
     <!-- bootstrap-table 表格插件 -->
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap-table/bootstrap-table.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap-table/locale/bootstrap-table-zh-CN.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/bootstrap-table/extensions/mobile/bootstrap-table-mobile.min.js') ?>"></script>
    <!-- jquery-validate 表单验证插件 -->
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/validate/jquery.validate.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/validate/messages_zh.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/validate/jquery.validate.extend.js') ?>"></script>

    <script src="<?= yii\helpers\Url::to('@web/static/plugins/blockUI/jquery.blockUI.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/iCheck/icheck.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/plugins/layui/layui.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/js/iframe-ui.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@web/static/js/common.js') ?>"></script>
    <?= $this->blocks['script_before']??''?>
    <?= $this->blocks['script']??''?>
    <?= $this->blocks['script_after']??''?>
