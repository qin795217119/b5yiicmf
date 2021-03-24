<div class="web_headebg">
    <div class="con_container">
        <p class="web_headebg_title"><?=$parentCat?$parentCat['name']:$catInfo['name']?></p>
    </div>
</div>
<div class="news_list_catbox">
    <div class="con_container">
        <div class="news_list_catcell">
            <?php foreach($catList as $cat){ ?>
                <a href="<?=$cat['url']?:'javascript:;'?>" class="<?=$cat['id']==$catInfo['id']?'current':''?>"><?=$cat['name']?></a>
            <?php } ?>
        </div>
        <div class="news_posbox">
            <img src="<?=\yii\helpers\Url::to('@appweb/public/static/pc/site/default/images/icon06.png')?>" />
            <a href="<?=$home_url?>">首页</a>&gt;
            <?php if($parentCat){ ?>
                <a href="<?=$parentCat['url']?:'javascript:;'?>"><?=$parentCat['name']?></a>&gt;
            <?php } ?>
            <a href="<?=$catInfo['url']?>"><?=$catInfo['name']?></a>
        </div>
    </div>
</div>
<div class="con_container news_list_conbox">
    <div class="news_list_left">
        <div class="news_list_list">
            <?php foreach($list as $item){ ?>
                <dl>
                    <dt><a href="<?=$item['linkurl']?>" target="_blank"><img src="<?=$item['thumbimg']?>" /></a></dt>
                    <dd class="news_list_title"><a href="<?=$item['linkurl']?>" target="_blank"><?=$item['title']?></a><span><?=substr($item['subtime'],0,10)?></span></dd>
                    <dd class="news_list_remark"> <?=\common\helpers\commonApi::sub_str($item['remark'],0,120)?><a href="<?=$item['linkurl']?>" target="_blank">查看详情>></a></dd>
                </dl>
            <?php } ?>
        </div>
        <div class="b5_pagebox">
            <?=$_page?>
        </div>
    </div>
    <div class="news_list_right">
        <a href="javascript:;"><img src="<?=\yii\helpers\Url::to('@appweb/public/static/pc/site/default/images/pic02.jpg')?>"></a>
        <a href="javascript:;"><img src="<?=\yii\helpers\Url::to('@appweb/public/static/pc/site/default/images/map.jpg')?>"></a>
        <a href="javascript:;"><img src="<?=\yii\helpers\Url::to('@appweb/public/static/pc/site/default/images/pic03.jpg')?>"></a>
    </div>
</div>
