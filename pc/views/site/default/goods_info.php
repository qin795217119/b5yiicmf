<div class="web_headebg">
    <div class="con_container">
        <p class="web_headebg_title"><?=$catInfo['name']?></p>
    </div>
</div>
<div class="con_container">
    <div class="list_info_title"><?=$info['title']?></div>
    <div class="list_info_retitle"><?php if($info['froms']){ ?><span>来源：<?=$info['froms']?></span><?php } ?><span>时间 : <?=\common\helpers\commonApi::sub_str($info['subtime'],0,10)?></span></div>
    <div class="info_page_content">
        <?php if(isset($infoExt['imglist']) && $infoExt['imglist']){?>
            <p style="text-align: center">
                <?php foreach($infoExt['imglist'] as $img){?>
                    <img src="<?=$img?>" style="max-width: 100%;">
                <?php } ?>
            </p>
        <?php } ?>
        <?=($infoExt['content']??'')?>
    </div>
</div>
