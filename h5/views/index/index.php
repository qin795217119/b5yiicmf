<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style"  />
    <meta content="telephone=no" name="format-detection" />
    <meta name="<?=Yii::$app->request->csrfParam?>" content="<?=Yii::$app->request->csrfToken?>">
    <title>意见反馈</title>

    <link rel="stylesheet" href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= yii\helpers\Url::to('@appweb/public/static/plugins/swiper/css/swiper.min.css') ?>">
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/flexible.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/jquery/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/swiper/js/swiper.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/mlayer/mlayer.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/common/js/common.js') ?>"></script>
    <style>
        html{ min-height: 100%;width: 100%}
        body{font-family: "微软雅黑", Helvetica, Tahoma, Arial, sans-serif;  min-height: 100%;font-size: 14px;width: 100%;overflow-x: hidden;background-color: #fafafa}
        *{margin: 0;padding: 0}
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        *:before,
        *:after {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        ul{list-style: none}
        .formbox{padding-top: 20px;}
        .subbtn{padding: 10px 15px;font-size: 16px}
        .showlist{height: 240px;}
        .showli{font-size: 15px;color: #666;line-height: 30px;height: 30px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap}

        .stitle{font-size: 16px;color: #000;padding: 20px 0 }
    </style>
</head>
<body>
<div class="container-fluid formbox">
    <div class="stitle" style="padding: 0 0 10px 0">反馈内容</div>
    <form class="form-horizontal" id="subform">
        <div class="form-group">
            <div class="col-xs-12">
                <textarea class="form-control" placeholder="请输入意见反馈" name="content" id="content" rows="6" style="font-size: 15px"></textarea>
            </div>
        </div>
        <div class="btn btn-primary btn-block subbtn" onclick="subform()">确认提交</div>
    </form>

    <div class="stitle">反馈记录</div>
    <div class="showlist swiper-container" id="echart_tzjd">
        <ul class="swiper-wrapper">
            <?php
                foreach ($list as $item):
            ?>
            <li class="showli swiper-slide">· &nbsp;<?=$item['content']?></li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script>
        wx.config({
            debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
            appId: '<?=$signPackage["appId"]?>', // 必填，公众号的唯一标识
            timestamp:<?=$signPackage["timestamp"]?> , // 必填，生成签名的时间戳
            nonceStr: '<?=$signPackage["nonceStr"]?>', // 必填，生成签名的随机串
            signature: '<?=$signPackage["signature"]?>',// 必填，签名
            jsApiList: ['hideOptionMenu'] // 必填，需要使用的JS接口列表
        });


        $(function() {
            wx.ready(function () {
                wx.hideOptionMenu();
            });

            new Swiper('.swiper-container', {
                direction: 'vertical', // 垂直切换选项
                loop: true, // 循环模式选项
                autoplay: {
                    delay: 2000,
                    stopOnLastSlide: false,
                    disableOnInteraction: false,
                },
                preventClicks:true,
                speed: 1500,
                height:30
            });
        });
        
        function subform() {
            var content = $("#content").val();
            if(!content){
                b5tips('请输入意见反馈内容');
                return false;
            }
            b5ajax("<?=\yii\helpers\Url::toRoute(['subform'])?>",{content:content},false,function (result) {
                if (result.code==0) {
                    b5tips(result.msg,function () {
                        window.location.reload()
                    })
                }else{
                    b5tips(result.msg)
                }
            })
        }
    </script>
</body>
</html>