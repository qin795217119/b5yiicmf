<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" name="viewport" />
    <meta content="yes" name="apple-mobile-web-app-capable" />
    <meta content="black" name="apple-mobile-web-app-status-bar-style"  />
    <meta content="telephone=no" name="format-detection" />
    <title><?=$scratchInfo['title']?></title>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/flexible.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/jquery/jquery-1.12.4.min.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/jquery.eraser.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/plugins/mlayer/mlayer.js') ?>"></script>
    <script src="<?= yii\helpers\Url::to('@appweb/public/static/common/js/common.js') ?>"></script>
    <link rel="stylesheet" href="<?= yii\helpers\Url::to('@appweb/public/static/h5/scratch/css/style.css') ?>">

</head>
<body>
<div class="box1 ">
    <div id="bg"></div>
    <?php
        if($getprizelist){
        $count=count($getprizelist);
        $ht=$count*0.35;
        $times=$count*1.2;
    ?>
        <style>
            .getuser{  position: absolute;width: 100%;padding: .1rem .9rem}
            .getuserlist{overflow: hidden;position: relative;}
            .getuserul{overflow: hidden;padding:.08rem 0;position: relative}
            .getuserulmaian{height: .7rem;overflow: hidden}
            .getuser ul{list-style-type: none;-webkit-animation: <?=$times?>s rowup linear infinite normal;animation: <?=$times?>s rowup linear infinite normal;}
            .getuserbg{position: absolute;width: 100%;height: 100%;background-color: #000;filter:alpha(opacity=20);-moz-opacity:0.2;-khtml-opacity:0.2;opacity: 0.2;}
            .getuser ul li{font-size: .28rem;color: #FFF;text-align: center;line-height: .35rem;height: .35rem;overflow: hidden}
            @-webkit-keyframes rowup {
                0% {
                    -webkit-transform: translate3d(0, 0, 0);
                    transform: translate3d(0, 0, 0);
                }
                100% {
                    -webkit-transform: translate3d(0, -<?=$ht?>rem, 0);
                    transform: translate3d(0, -<?=$ht?>rem, 0);
                }
            }
        </style>
        <div class="getuser">
            <div class="getuserlist">
                <div class="getuserbg"></div>
                <div class="getuserul">
                    <div class="getuserulmaian">
                        <ul class="rowup">
                            <?php foreach ($getprizelist as $getinfo){?>
                                <li>恭喜<?=$getinfo['nickname']?>,<?=$getinfo['prize_name']?></li>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div id="audio_btn" class="" onclick="mp3click()">
        <div class="audio_bg"></div>
        <img src="<?= yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/video.png') ?>">
        <audio loop src="<?= yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/test.mp3') ?>" id="media" autoplay="" preload=""></audio>
    </div>
    <div class="rulesbtn"></div>
    <div class="mybtn"></div>
    <div class="guabox">
        <div class="guamain">
            <img src="<?= yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/over.png') ?>" id="result">
            <img src="<?= yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/hui.jpg') ?>" id="redux">
        </div>
    </div>

    <?php if($leftnum>-1){?>
        <div class="showinfo">
            剩余<span><?=$leftnum?></span>次刮奖机会
        </div>
    <?php }else{ ?>
        <div class="showinfo">
            不限制刮奖次数
        </div>
    <?php }?>
</div>
<div id="shader" class="showtip"></div>
<!--未获得奖品-->
<div class="noget showtip">
    <div class="getclose"></div>
    <div class="noget_bg"></div>
</div>
<!--获得奖品-->
<div class="getprize showtip">
    <div class="getclose"></div>
    <div class="gethas_bg">
        <div class="hasget_infobox">
        <div class="get_title"></div>
        <div class="get_prize_img"></div>
        </div>
    </div>
</div>
<!--错误提示-->
<div class="errorbox showtip">
    <div class="errorinfo">
        <div class="errortitle"></div>
        <div class="errorbtn">我知道了</div>
    </div>
</div>
<!--活动规则-->
<div class="box2 mbox">
    <div class="boxbg"></div>
    <div class="mynavbox">
        <div class="mynavitem">
            <a href="javasript:;" class="mynavbtn current" data-type="rule">活动规则</a>
        </div>
        <div class="mynavitem">
            <a href="javasript:;" class="mynavbtn" data-type="my">我的奖品</a>
        </div>
        <div class="btnclose"></div>
    </div>
    <div class="rulebox">
        <div class="rule_item">
            <div class="rule_item_title">活动奖品</div>
            <div class="rule_item_info">
                <?php foreach ($prizeList as $prizeinfo){?>
                    <p><?=$prizeinfo['title'].'：'.$prizeinfo['name']?></p>
                <?php }?>
            </div>
        </div>
        <div class="rule_item">
            <div class="rule_item_title">活动时间</div>
            <div class="rule_item_info">
                <p><?=$scratchInfo['start_time']?>&nbsp;至&nbsp;<?=$scratchInfo['end_time']?></p>
            </div>
        </div>
        <div class="rule_item">
            <div class="rule_item_title">活动规则</div>
            <div class="rule_item_info">
                <p style="white-space: pre-wrap"><?=$scratchInfo['contents']?></p>
            </div>
        </div>
        <?php if($scratchInfo['company']){?>
        <div class="rule_item">
            <div class="rule_item_title">主办单位</div>
            <div class="rule_item_info">
                <p><?=$scratchInfo['company']?></p>
            </div>
        </div>
        <?php }?>
        <?php if($scratchInfo['support']){?>
        <div class="rule_item">
            <div class="rule_item_title">技术支持</div>
            <div class="rule_item_info">
                <p><?=$scratchInfo['support']?></p>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<!--我的奖品-->
<div class="box3 mbox">
    <div class="mybox">
        <div class="boxbg"></div>
        <div class="mynavbox">
            <div class="mynavitem">
                <a href="javasript:;" class="mynavbtn" data-type="rule">活动规则</a>
            </div>
            <div class="mynavitem">
                <a href="javasript:;" class="mynavbtn current" data-type="my">我的奖品</a>
            </div>
            <div class="btnclose"></div>
        </div>
        <div class="myprizelist"></div>
    </div>
</div>
<script src="http://res.wx.qq.com/open/js/jweixin-1.4.0.js"></script>
    <script>
        // wx.config({
        //     debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        //     appId: '{$signPackage.appId}', // 必填，公众号的唯一标识
        //     timestamp:{$signPackage.timestamp} , // 必填，生成签名的时间戳
        //     nonceStr: '{$signPackage.nonceStr}', // 必填，生成签名的随机串
        //     signature: '{$signPackage.signature}',// 必填，签名
        //     jsApiList: ['hideOptionMenu'] // 必填，需要使用的JS接口列表
        // });

        var hassub=false;
        var noprize="<?=\yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/noprize.png')?>";
        var getprize="<?=\yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/getprize.png')?>";
        var deprize="<?=\yii\helpers\Url::to('@appweb/public/static/h5/scratch/images/over.png')?>";
        var state=1;
        var x = document.getElementById("media");
        window.onload=function(){
            $('#redux').eraser({
                completeRatio: .2,
                completeFunction: getPrize
            });
            resize();
        }
        $(function(){
            wx.ready(function(){
                wx.hideOptionMenu();
            });
            if (typeof WeixinJSBridge == "object" && typeof WeixinJSBridge.invoke == "function") {
                mp3click();
            } else {
                //監聽客户端抛出事件"WeixinJSBridgeReady"
                if (document.addEventListener) {
                    document.addEventListener("WeixinJSBridgeReady", function(){
                        mp3click();
                    }, false);
                } else if (document.attachEvent) {
                    document.attachEvent("WeixinJSBridgeReady", function(){
                        mp3click();
                    });
                    document.attachEvent("onWeixinJSBridgeReady", function(){
                        mp3click();
                    });
                }
            }

            $(window).resize(function () {
                resize();
            });

            //规则和我的奖品菜单切换 监听
            $(".mynavbtn").click(function () {
                if($(this).hasClass('current')){
                    return false;
                }
                var thistype=$(this).attr("data-type");
                if(thistype=='rule'){
                    showRuel();
                }else{
                    showMylist();
                }
            });

            //首页规则按钮
            $(".rulesbtn").click(function () {
                showRuel();
            });
            //我的奖品
            $(".mybtn").click(function () {
                showMylist();
            });
            $(".gethas_bg").click(function () {
                closePrize();
                showMylist();
            });
            $(".btnclose").click(function () {
                $(".mbox").hide();
                if(state==4){
                    state=3;
                    $(".box3").show();
                }else{
                    state=1;
                    $(".box1").show();
                }
            });


            $(".noget_bg,.getclose").click(function () {
                closePrize();
            })
            $(".errorbtn").click(function () {
                if(state==1){
                    closePrize();
                }else{
                    $(".errorbox").hide();
                    $("#shader").hide();
                }
            })
        });
        //显示错误信息
        function showError(title) {
            $(".errortitle").html(title);
            $("#shader").show();
            $(".errorbox").show();
        }
        //关闭无奖或获奖信息  重置刮奖
        function closePrize() {
            hassub=false;
            $(".showtip").hide();
            $("#shader").hide();
            $("#result").attr('src',deprize);
            $('#redux').eraser('reset');
        }
        //展示规则
        function showRuel() {
            state=2;
            $(".mbox").hide();
            $(".box2").show();
        }

        //展示我的奖品列表
        function showMylist() {
            state=3;
            $(".mbox").hide();
            $(".box3").show();
            b5ajax("<?=\yii\helpers\Url::toRoute(['myprize','act_id'=>$scratchInfo['id']])?>",{},false,function (result) {
                if(result.code==0){
                    var list=result.data.list;
                    var html='';
                    for (var i=0;i<list.length;i++){
                        var status='';
                        if(list[i].status=='1'){
                            status='已核销';
                        }else{
                            status='<span>未核销：'+list[i].getcode+'</span>';
                        }
                        html+='<div class="myprize_cell">' +
                            '                <div class="myprice_img" style="background-image: url('+list[i].prize_img+')"></div>' +
                            '                <div class="myprize_info">' +
                            '                    <p class="myprize_title">'+list[i].prize_name+'</p>' +
                            '                    <p class="myprize_time">'+list[i].create_time+'</p>' +
                            '                    <p class="myprize_status">'+status+'</p>' +
                            '                </div>' +
                            '            </div>'
                    }
                    $(".myprizelist").html(html)
                }else{
                    showError(result.msg);
                }
            })
        }
        function decNum() {
            var num=parseInt($(".showinfo span").text());
            if(!isNaN(num) && num>0){
                $(".showinfo span").text(num-1)
            }
        }

        function getPrize() {
            if(hassub) return false;
            hassub=true;
            b5ajax("<?=\yii\helpers\Url::toRoute(['getprize','act_id'=>$scratchInfo['id']])?>",{},false,function (result) {
                if (result.code==0) {
                    $('#redux').eraser('clear');
                    var data=result.data.info;
                    if(data.id>0){
                        $("#result").attr('src',getprize);
                        $(".getprize .get_title").html(data.title);
                        $(".get_prize_img").css('background-image','url('+data.img+')');
                        $("#shader").show();
                        $(".getprize").show();
                    }else{
                        $("#result").attr('src',noprize);
                        $("#shader").show();
                        $(".noget").show();
                    }
                    decNum();
                }else{
                    b5alert(result.msg,function () {
                        closePrize()
                    });
                }
            })
        }
        function mp3click() {
            $("#audio_btn").toggleClass("rotate"); //控制音乐图标 自转或暂停
            //控制背景音乐 播放或暂停
            if($("#audio_btn").hasClass("rotate")){
                x.play();
            }else{
                x.pause();
            }
        }
        function resize() {
            var min_h=11.8;
            $(".box1").css('min-height',min_h+'rem');
        }
    </script>
</body>
</html>