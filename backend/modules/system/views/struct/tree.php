<?php $this->context->layout = '/form';?>

<?= \backend\extend\widgets\Asset::widget(['type'=>['ztree']])?>

<style>
    body {height: auto;font-family: "Microsoft YaHei";background-color: #fff !important;}
    button {font-family: "SimSun", "Helvetica Neue", Helvetica, Arial;}
</style>
<input type="hidden" name='treeId' id='treeId' value='<?=$struct_id?>'>
<input type="hidden" name='treeName' id='treeName' value=''>
<div class="wrapper">
    <div class="treeShowHideButton" onclick="$.tree.toggleSearch();">
        <label id="btnShow" title="显示搜索" style="display:none;">︾</label>
        <label id="btnHide" title="隐藏搜索">︽</label>
    </div>
    <div class="treeSearchInput" id="search">
        <label for="keyword">关键字：</label><input type="text" class="empty" id="keyword" maxlength="50">
        <button class="btn" id="btn" onclick="$.tree.searchNode()"> 搜索</button>
    </div>
    <div class="treeExpandCollapse">
        <a href="javascript:;" onclick="$.tree.expand()">展开</a> /
        <a href="javascript:;" onclick="$.tree.collapse()">折叠</a>
        <?php if($ismult == '1'):?>
            /<a href="javascript:;" onclick="$._tree.checkAllNodes(false);$.tree.zOnCheck();">取消选择</a>
        <?php endif;?>
    </div>
    <div id="tree" class="ztree treeselect"></div>
</div>

<?php $this->beginBlock('script'); ?>
    <script>
        var parent ="<?=$parent?>";
        var ismult = "<?=$ismult??''?>";
        $(function () {
            var options = {
                url: aUrl,
                showParentLevel:parent=='1'?0:false,
                ismult:(ismult=='1')?true:false,
                expandLevel: 2
            };
            $.tree.init(options);
        });
    </script>
<?php $this->endBlock(); ?>