<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title><?= $this->params['system_name']??'b5YiiCMF' ?></title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;url=/ie.html"/>
    <![endif]-->
    <link href="<?= Url::to('@web/static/plugins/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/plugins/contextMenu/jquery.contextMenu.min.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/plugins/fontawesome/css/font-awesome.min.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/plugins/layui/css/layui.css')?>" rel="stylesheet">
    <link href="<?= Url::to('@web/static/plugins/animate/animate.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/css/style.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/css/skins.css')?>" rel="stylesheet"/>
    <link href="<?= Url::to('@web/static/css/iframe-ui.css')?>" rel="stylesheet"/>
    <script>
        if (window !== top) top.location.replace(location.href);

        var lockUrl="<?= \yii\helpers\Url::toRoute('common/lockscreen')?>";
    </script>
</head>
<body class="fixed-sidebar full-height-layout gray-bg theme-dark skin-blue" style="overflow: hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <a href="">
            <li class="logo hidden-xs">
                <span class="logo-lg"><?= $this->params['system_name']??'b5YiiCMF' ?></span>
            </li>
        </a>
        <div class="sidebar-collapse tab-content" id="side-menu">
            <div class="user-panel">
                <a class="menuItem noactive" title="个人中心" href="">
                    <div class="hide" text="个人中心"></div>
                    <div class="pull-left image">
                        <img src="<?= Url::to('@web/static/images/profile.jpg')?>" class="img-circle" alt="User Image">
                    </div>
                </a>
                <div class="pull-left info">
                    <p style="height: 15px;line-height: 16px;width: 100%;overflow: hidden;font-size: 12px"><?=$user_info['struct']?$user_info['struct'][0]['name']:"未分配部门"?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
                    <a href="<?=Url::toRoute('public/logout')?>" style="padding-left:5px;"><i class="fa fa-sign-out text-danger"></i> 注销</a>
                </div>
            </div>
            <!--- 菜单 -->
            <!--- 菜单 -->
            <?php foreach($menuList as $menu):?>
            <?php if($menu['type']!='C' && $menu['child']):?>
            <div class="tab-pane fade height-full" id="menu_<?=$menu['id']?>">
                <ul class="nav">
                    <?php foreach($menu['child'] as $menu1):?>
                    <li>
                        <?php if($menu1['type'] =='C'):?>
                        <a class="menu-content <?=$menu1['target'] == '1'?'menuBlank':'menuItem'?>" href="<?=$menu1['url']?>" data-refresh="<?=$menu1['is_refresh']=='1'?>">
                            <i class="<?=$menu1['icon']?> fa-fw"></i>
                            <span class="nav-label"><?=$menu1['name']?></span>
                        </a>
                        <?php elseif($menu1['child']):?>
                        <a href="javascript:;">
                            <i class="<?=$menu1['icon']?> fa-fw"></i>
                            <span class="nav-label"><?=$menu1['name']?></span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level collapse">
                            <?php foreach($menu1['child'] as $menu2):?>
                            <li>
                                <?php if($menu2['type'] =='C'):?>
                                <a class="<?=$menu2['target'] == '1'?'menuBlank':'menuItem'?>" href="<?=$menu2['url']?>" data-refresh="<?=$menu2['is_refresh']=='1'?>">
                                    <i class="<?=$menu2['icon']?> fa-fw"></i>
                                    <span class="nav-label"><?=$menu2['name']?></span>
                                </a>
                                <?php elseif($menu2['child']):?>
                                <a href="javascript:;">
                                    <i class="<?=$menu2['icon']?> fa-fw"></i>
                                    <span class="nav-label"><?=$menu2['name']?></span>
                                    <span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-third-level collapse">
                                    <?php foreach($menu2['child'] as $menu3):?>
                                    <?php if($menu3['type'] =='C'):?>
                                    <li>
                                        <a class="<?=$menu3['target'] == '1'?'menuBlank':'menuItem'?>" href="<?=$menu3['url']?>" data-refresh="<?=$menu2['is_refresh']=='1'?>">
                                            <i class="<?=$menu3['icon']?> fa-fw"></i>
                                            <span class="nav-label"><?=$menu3['name']?></span>
                                        </a>
                                    </li>
                                    <?php endif;?>
                                    <?php endforeach;?>
                                </ul>
                                <?php endif;?>
                            </li>
                            <?php endforeach;?>
                        </ul>
                        <?php endif;?>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>
            <?php endif;?>
            <?php endforeach;?>

            <div class="tab-pane fade height-full" id="index">
                <ul class="nav">
                    <li>
                        <a class="menuItem" href="<?=Url::toRoute(['index/home'])?>"><i class="fa fa-home"></i> <span class="nav-label">首页</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2" style="color:#FFF;" href="#" title="收起菜单">
                        <i class="fa fa-bars"></i>
                    </a>
                </div>


                <div id="navMenu">
                    <ul class="nav navbar-toolbar nav-tabs navbar-left hidden-xs">
                        <!-- 顶部菜单列表 -->
                        <?php foreach($menuList as $menu):?>
                        <li role="presentation" id="tab_<?=$menu['id']?>">
                            <?php if($menu['type'] == 'C'): ?>
                            <a data-toggle="tab" href="<?=$menu['url']?>" class="<?=$menu['target'] == '1'?'menuBlank':''?>">
                                <i class="<?=$menu['icon']?>"></i> <span><?=$menu['name']?></span>
                            </a>
                            <?php elseif($menu['child']):?>
                            <a data-toggle="tab" href="#menu_<?=$menu['id']?>" >
                                <i class="<?=$menu['icon']?>"></i> <span><?=$menu['name']?></span>
                            </a>
                            <?php endif;?>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>

                <ul class="nav navbar-top-links navbar-right welcome-message">
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="清除缓存" href="javascript:clearCacheAll();"><i class="fa fa-recycle"></i> 清除缓存</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="开发文档" href="javascript:alert('暂无');"><i class="fa fa-question-circle"></i> 文档</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="锁定屏幕" href="#" id="lockScreen" data-url="<?=Url::toRoute('common/lockscreen')?>"><i class="fa fa-lock"></i> 锁屏</a></li>
                    <li><a data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="全屏显示" href="#" id="fullScreen"><i class="fa fa-arrows-alt"></i> 全屏</a></li>
                    <li class="dropdown user-menu">
                        <a href="javascript:;" class="dropdown-toggle" data-hover="dropdown">
                            <img src="<?= Url::to('@web/static/images/profile.jpg')?>" class="user-image">
                            <span class="hidden-xs"><?=$user_info['info']['name']?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="mt5">
                                <a href="" class="menuItem"><i class="fa fa-user"></i> 个人中心</a>
                            </li>
                            <li>
                                <a href="javascript:rePass();"><i class="fa fa-key"></i> 修改密码</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?= Url::toRoute('public/logout')?>"><i class="fa fa-sign-out"></i> 退出登录</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="row content-tabs">
            <button class="roll-nav roll-left tabLeft">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active menuTab" data-id="<?=Url::toRoute(['index/home'])?>">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right tabRight">
                <i class="fa fa-forward"></i>
            </button>
            <a href="javascript:;" class="roll-nav roll-right tabReload"><i class="fa fa-refresh"></i> 刷新</a>
        </div>

        <a id="ax_close_max" class="ax_close_max" href="#" title="关闭全屏"> <i class="fa fa-times-circle-o"></i> </a>

        <div class="row mainContent" id="content-main">
            <iframe class="RuoYi_iframe" name="iframe0" width="100%" height="100%" data-id="<?=Url::toRoute(['index/home'])?>" src="<?=Url::toRoute(['index/home'])?>" frameborder="0" seamless></iframe>
        </div>

        <div class="footer">
            <div class="pull-right">© 2021 b5net.com Copyright </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="<?= Url::to('@web/static/plugins/jquery/jquery-1.12.4.min.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/metismenu/jquery.metisMenu.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/contextMenu/jquery.contextMenu.min.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/blockUI/jquery.blockUI.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/layui/layui.js')?>"></script>
<script src="<?= Url::to('@web/static/js/iframe-ui.js')?>"></script>
<script src="<?= Url::to('@web/static/js/common.js')?>"></script>
<script src="<?= Url::to('@web/static/js/index.js')?>"></script>
<script src="<?= Url::to('@web/static/js/resize-tabs.js')?>"></script>
<script src="<?= Url::to('@web/static/plugins/fullscreen/jquery.fullscreen.js')?>"></script>
<script>
    // history（表示去掉地址的#）否则地址以"#"形式展示
    var mode = "history";
    // 历史访问路径缓存
    var historyPath = storage.get("historyPath");
    // 是否页签与菜单联动
    var isLinkage = true;


    /** 刷新时访问路径页签 */
    function applyPath(url) {
        var $dataObj = $('a[href$="' + decodeURI(url) + '"]');
        $dataObj.click();
        if (!$dataObj.hasClass("noactive")) {
            $dataObj.parent("li").addClass("selected").parents("li").addClass("active").end().parents("ul").addClass("in");
        }
        // 顶部菜单同步处理
        var tabStr = $dataObj.parents(".tab-pane").attr("id");
        if ($.common.isNotEmpty(tabStr)) {
            var sepIndex = tabStr.lastIndexOf('_');
            var menuId = tabStr.substring(sepIndex + 1, tabStr.length);
            $("#tab_" + menuId + " a").click();
        }
    }
    $(function() {
        var lockPath = storage.get('lockPath');
        if($.common.equals("history", mode) && window.performance.navigation.type == 1) {
            var url = storage.get('publicPath');
            if ($.common.isNotEmpty(url)) {
                applyPath(url);
            } else {
                $(".navbar-toolbar li a").eq(0).click();
            }
        } else if($.common.isNotEmpty(lockPath)) {
            applyPath(lockPath);
            storage.remove('lockPath');
        } else {
            var hash = location.hash;
            if ($.common.isNotEmpty(hash)) {
                var url = hash.substring(1, hash.length);
                applyPath(url);
            } else {
                if($.common.equals("history", mode)) {
                    storage.set('publicPath', "");
                }
                $(".navbar-toolbar li a").eq(0).click();
            }
        }
        $("[data-toggle='tooltip']").tooltip();
    });


    /* 修改密码 */
    function rePass() {
        var url = "<?=Url::toRoute('common/repass')?>";
        $.modal.open("修改密码", url, '770', '380');
    }
    function clearCacheAll() {
        $.operate.b5get('<?=Url::toRoute('public/cacheclear')?>');
    }
</script>
</body>
</html>


