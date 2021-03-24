<div class="wy_head">
    <div class="con_container">
        <div class="wy_logo"><img src="<?= yii\helpers\Url::to('@appweb/public/static/pc/site/default/images/logo.png') ?>" /></div>
        <div class="" id="header">
            <ul id="nav">
                <li>
                    <a href="<?=\yii\helpers\Url::toRoute('index')?>" class="<?=(isset($activeMenu) && $activeMenu=='home')?'on':''?>"><span>首页</span><span class="bkg"></span></a>
                </li>
                <?php
                    if(isset($this->params['menuList']) && $this->params['menuList']){
                        foreach ($this->params['menuList'] as $val){
                ?>
                            <li>
                                <a href="<?=$val['url']?:'javascript:;'?>"  class="<?=(isset($activeMenu) && $activeMenu==$val['checkcode'])?'on':''?>"><span><?=$val['name']?></span><span class="bkg"></span></a>
                                <?php if($val['childArr']){?>
                                <div class="menuchlist">
                                    <?php foreach($val['childArr'] as $chval){?>
                                    <a href="<?=$chval['url']?:'javascript:;'?>"><?=$chval['name']?></a>
                                    <?php } ?>
                                </div>
                                <?php } ?>
                            </li>
                <?php
                        }
                    }
                ?>
            </ul>
        </div>
        <form class="wy_search" method="get" action="">
            <input type="text" class="wy_text01"  name="keyword"/><input type="submit" value=" " class="wy_but01" />
        </form>
    </div>
</div>
