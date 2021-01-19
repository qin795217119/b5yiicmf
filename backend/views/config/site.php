<style>
    .nav-tabs>li>a {
        color: #999;
        font-weight: 500;
        padding: 6px 18px 6px 20px;
    }
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus{
        color: #000;
    }
</style>
<div class="mt10" style="background-color: #fff;padding: 10px">
    <?php if(!empty($lists)): ?>
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                    $listindex=0;
                ?>
                <?php foreach($lists as $groupkey=>$groups): ?>
                    <?php
                        $listindex++;
                    ?>
                    <li role="presentation" class="<?=$listindex==1?'active':''?>"><a href="#<?=$groupkey?>" id="<?=$groupkey?>-tab" role="tab" data-toggle="tab" aria-controls="<?=$groupkey?>" aria-expanded="true"><?=$groups['title']?></a></li>
                <?php endforeach; ?>
            </ul>
            <div class="tab-content mt20">
                <?php
                    $listindex=0;
                ?>
                <?php foreach($lists as $groupkey=>$groups): ?>
                    <?php
                        $listindex++;
                    ?>
                    <div role="tabpanel" class="tab-pane fade <?=$listindex==1?'active in':''?>" id="<?=$groupkey?>" aria-labelledby="<?=$groupkey?>-tab">
                        <?php if($groups['chlist']): ?>
                            <form class="form-horizontal" id="form-config-site-<?=$groupkey?>">
                                <?php foreach($groups['chlist'] as $input): ?>
                                    <?php if($input['style']=='text'): ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?=$input['title']?>：</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="<?=$input['id']?>" value="<?=$input['value']?>" class="form-control" autocomplete="off">
                                                <?php if(!empty($input['note'])): ?>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$input['note']?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($input['style']=='textarea'): ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?=$input['title']?>：</label>
                                            <div class="col-sm-9">
                                                <textarea rows="3" name="<?=$input['id']?>" class="form-control" ><?=$input['value']?></textarea>
                                                <?php if(!empty($input['note'])): ?>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$input['note']?></span>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                                    <?php if($input['style']=='select'): ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?=$input['title']?>：</label>
                                            <div class="col-sm-9">
                                                <select name="<?=$input['id']?>" class="form-control">
                                                    <?php foreach($input['extra'] as $ikey=>$ival): ?>
                                                        <option value="<?=$ikey?>" <?=($ikey==$input['value'])?'selected':''?>><?=$ival?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if(!empty($input['note'])): ?>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$input['note']?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($input['style']=='array'): ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label"><?=$input['title']?>：</label>
                                            <div class="col-sm-9">
                                                <textarea rows="3" name="<?=$input['id']?>" class="form-control" ><?=$input['value']?></textarea>
                                                <?php if(!empty($input['note'])): ?>
                                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> <?=$input['note']?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <div class="form-group text-center mt20">
                                    <a href="javascript:;" class="btn btn-success btn-mid b5submit_btn" data-target="form-config-site-<?=$groupkey?>" data-title="确定提交网站配置信息">保存</a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
