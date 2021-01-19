<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <title>b5yiicmf</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/layui/css/layui.css') ?>" rel="stylesheet"/>
    <link href="<?= yii\helpers\Url::to('@appweb/public/static/admin/css/login.css') ?>" rel="stylesheet"/>
    <script>
        if (window !== top) top.location.replace(location.href);
    </script>
</head>
<body>
<div class="login-wrapper layui-anim layui-anim-scale layui-hide">
    <form class="layui-form" id="loginform">
        <h2>B5YiiCMF</h2>
        <div class="layui-form-item layui-input-icon-group">
            <i class="layui-icon layui-icon-username"></i>
            <input class="layui-input" id="username" name="username" value="" placeholder="请输入登录账号" autocomplete="off" lay-verType="tips" lay-reqText='请输入登录账号' lay-verify="required" required/>
        </div>
        <div class="layui-form-item layui-input-icon-group">
            <i class="layui-icon layui-icon-password"></i>
            <input class="layui-input" id="password" name="password" value="" placeholder="请输入登录密码" type="password" lay-verType="tips" lay-reqText='请输入登录密码' lay-verify="required" required/>
        </div>
        <div class="layui-form-item layui-input-icon-group login-captcha-group">
            <i class="layui-icon layui-icon-auz"></i>
            <input class="layui-input" id="captcha" name="verifycode" value="" placeholder="请输入验证码" autocomplete="off" lay-verType="tips" lay-reqText='请输入验证码' lay-verify="required" required/>
            <img onclick="this.src=urlcreate('<?= \yii\helpers\Url::toRoute('captcha')?>','_t='+Math.random())" src="<?= \yii\helpers\Url::toRoute('captcha')?>" width="130px" height="48px" class="login-captcha" alt="点击刷新验证码"/>
        </div>
        <div class="layui-form-item">
            <input type="checkbox" id="remember" name="remember" value="1" title="记住密码" lay-skin="primary" checked>
        </div>
        <input name="<?= Yii::$app->request->csrfParam?>" type="hidden" value="<?= Yii::$app->request->csrfToken ?>"/>
        <div class="layui-form-item">
            <button class="layui-btn layui-btn-fluid" lay-filter="loginSubmit" lay-submit id="subBtn">登录</button>
        </div>
    </form>
</div>
<div class="login-copyright">copyright © 2021 b5net.com all rights reserved.</div>
<script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/jquery/jquery-1.12.4.min.js') ?>"></script>
<script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/layui/layui.js') ?>"></script>
<script>
    layui.use(['layer', 'form'], function () {
        var $ = layui.jquery;
        var layer = layui.layer;
        var form = layui.form;
        $('.login-wrapper').removeClass('layui-hide');
        form.on('submit(loginSubmit)', function (data) {
            $("#subBtn").attr('disabled', true).text('登录中...');
            var loadIndex = layer.load(2, {shade: [0.2,'#000']});
            $.ajax({
                type: "POST",
                url: "<?=\yii\helpers\Url::toRoute('login')?>",
                data: $("#loginform").serialize(),
                dataType: "json",
                success: function (res) {
                    if (res.success) {
                        layer.msg('登录成功',{icon: 1,shade: [0.5, '#393D49'],time:1500},function () {
                            window.location.href = "<?=\yii\helpers\Url::toRoute('index/index')?>";
                        });
                    } else {
                        layer.msg(res.msg,{shade: [0.5, '#393D49'],time:1500},function () {
                            $("#subBtn").text('登录').removeAttr('disabled');
                        });
                    }
                },
                complete:function(){
                    layer.close(loadIndex);
                },
                error: function () {
                    layer.msg('网络请求失败',{shade: [0.5, '#393D49'],time:1500},function () {
                        $("#subBtn").text('登录').removeAttr('disabled');
                    });
                }
            });
        });
    });
    function urlcreate(url,params){
        if (params) {
            if (url.indexOf('?') > 0) {
                url += '&' + params;
            } else {
                url += '?' + params;
            }
        }
        return url;
    }
</script>
</body>
</html>
