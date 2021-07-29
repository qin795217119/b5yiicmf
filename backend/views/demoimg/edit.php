<?php $this->context->layout = 'form';?>
<?= \common\widgets\Asset::widget(['type'=>['dragula']])?>

<form class="form-horizontal m" id="form-edit">
    <?= \common\widgets\FormInput::widget(['name'=>'input','extend'=>['name'=>'id','type'=>'hidden','info'=>$info]])?>
    <?= \common\widgets\FormInput::widget(['name'=>'image|单图片','extend'=>['name'=>'imgarr1','id'=>'uploadimgbtn1','script_after'=>'1','cat'=>'bmimage','water'=>'true','sm'=>2,'data'=>$info['img1']]])?>
    <input type="hidden" name="img1" id="img1" value="">

    <?= \common\widgets\FormInput::widget(['name'=>'image|多图片','extend'=>['name'=>'imgarr2','id'=>'uploadimgbtn2','multi'=>'true','drag'=>'true','cat'=>'bmimage','water'=>'true','required'=>1,'sm'=>2,'script_after'=>'2','tips'=>'可拖动排序','data'=>$info['img2']]])?>
    <input type="hidden" name="img2" id="img2" value="">


    <?= \common\widgets\FormInput::widget(['name'=>'cropper|裁剪图片','extend'=>['name'=>'imgarr3','id'=>'uploadimgbtn3','script_after'=>'3','cat'=>'bmimage','water'=>'true','sm'=>2,'data'=>$info['img3']]])?>
    <input type="hidden" name="img3" id="img3" value="">

    <?= \common\widgets\FormInput::widget(['name'=>'video|视频地址','extend'=>['name'=>'video','cat'=>'cuvideo','tips'=>'视频格式为mp4','required'=>1,'sm'=>2,'script_after'=>'5','info'=>$info]])?>

</form>
<?= $this->render('/iframe',['name'=>'tabfooter'])?>
<?php $this->beginBlock('script'); ?>
<script>

    function submitHandler() {
        if ($.validate.form()) {
            var img1 = '';
            var img2 = [];
            var img3 = '';

            if($("input[name='imgarr1[]']").length>0){
                $("input[name='imgarr1[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        if(img1 === '') {
                            img1 = imgval;
                        }
                    }
                })
            }
            $("#img1").val(img1);

            if($("input[name='imgarr2[]']").length>0){
                $("input[name='imgarr2[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        img2.push(imgval)
                    }
                })
            }
            $("#img2").val(img2.join(','));

            if($("input[name='imgarr3[]']").length>0){
                $("input[name='imgarr3[]']").each(function () {
                    var imgval = $(this).val();
                    if(imgval){
                        if(img3 === '') {
                            img3 = imgval;
                        }
                    }
                })
            }
            $("#img3").val(img3);

            $.operate.save(oesUrl, $('#form-edit').serialize());
        }
    }
</script>
<?php $this->endBlock(); ?>
