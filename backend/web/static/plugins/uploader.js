//删除上传图片
function b5uploadImgRemove(obj) {
    $(obj).parents(".b5uploadmainbox").find(".btn-b5upload").removeAttr("disabled");
    $(obj).parents(".b5upload_li").remove();
}
//获取最大上传数量
function b5uploadMaxNum(id){
    var obj=$("#"+id);
    var maxnum=obj.data('multi');
    if(!maxnum) maxnum =1;
    if(!$.common.numValid(maxnum)){
        $.modal.msgError('上传参数：数量格式错误');
        return false;
    }
    return parseInt(maxnum)<1?1:parseInt(maxnum);
}

//上传文件成功后的展示的html
function b5uploadfilehtml(path,name,url,filename){
    var inputname = $("#"+name).data('inputname');
    inputname = inputname?true:false;
    url = url?url:path;
    if(!filename){
        filename = getFileName(path);
    }
    var classname = getExtClass(path);
    var html='<div class="b5upload_li">' +
        '           <input type="hidden" name="'+name+'[]" value="'+path+'">' +
        '           <div class="b5upload_filetype '+classname+'"></div>' +
        '           <div class="b5upload_filename">';
    if(inputname){
        html+= '        <input type="text" name="'+name+'_name[]" value="'+filename+'" class="form-control">';
    }else{
        html+= filename;
    }

    html+= '        </div>' +
        '               <div class="b5upload_fileop">' +
        '                   <a href="javascript:;" onclick="b5uploadImgRemove(this)"><i class="fa fa-trash-o"></i>删除</a>' +
        '                  <a href="'+url+'" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>' +
        '               </div>' +
        '      </div>';
    return html;
}

//上传图片成功后的展示的html
function b5uploadimghtml(path,name,url){
    url = url?url:path;
    var html='<div class="b5upload_li">' +
        '           <input type="hidden" name="'+name+'[]" value="'+path+'">' +
        '           <div class="b5uploadimg_con">' +
        '                <div class="b5uploadimg_cell">' +
        '                     <img src="'+url+'" alt="">' +
        '                </div>' +
        '            </div>' +
        '            <div class="b5uploadimg_footer">' +
        '                 <a href="javascript:;" onclick="b5uploadImgRemove(this)"><i class="fa fa-trash-o"></i>删除</a>' +
        '                  <a href="'+url+'" target="_blank"><i class="fa fa-hand-o-right"></i>查看</a>' +
        '            </div>' +
        '      </div>';
    return html;
}


//将上传图片后的html渲染到页面
function b5uploadhtmlshow(id,html) {
    var obj=$("#"+id);
    var maxnum = b5uploadMaxNum(id);
    var listbox =obj.parents(".b5uploadmainbox").find(".b5uploadlistbox");

    if(maxnum>1){
        var hasNum = listbox.find(".b5upload_li").length;
        if(hasNum+1>=maxnum){
            obj.parents(".b5uploadmainbox").find(".btn-b5upload").attr("disabled","disabled");
        }
        if(hasNum>=maxnum){
            $.modal.alertError('最多上传数量为'+maxnum+'个');
            return false;
        }
        listbox.append(html);
    }else{
        listbox.html(html);
    }
    return true;
}
//上传链接按钮
function b5uploadimglink(id) {
    var type = $("#"+id).parents('.b5uploadmainbox').data('type');
    type = type?type:'file';
    $("#"+id+"_linkbtn").click(function () {
        var linkval=$("#"+id+"_link").val();
        if($.common.isEmpty(linkval)){
            $.modal.msgWarning("请输入链接");
        }else{
            var html = '';
            if(type =='img'){
                html=b5uploadimghtml(linkval,id);
            }else{
                html=b5uploadfilehtml(linkval,id);
            }
            if(!html) return false;
            if(b5uploadhtmlshow(id,html)){
                $("#"+id+"_link").val('');
            }
        }
    });
}

//上传图片文件按钮初始化
function b5uploadimginit(id,maxSize,callback) {
    var maxnum = b5uploadMaxNum(id);
    var multi = maxnum > 1 ? true : false;
    maxSize = maxSize?parseInt(maxSize):0;
    layui.use('upload', function(){
        layui.upload.render({
            elem: '#'+id //绑定元素
            ,url: upImgUrl //上传接口
            ,field:'file'
            ,multiple:multi
            ,number:maxnum
            ,auto: maxSize>0?false:true
            ,data:{
                width:function(){
                    return $.common.isEmpty($("#"+id).attr('data-width'))?0:$("#"+id).attr('data-width');
                },
                height:function () {
                    return $.common.isEmpty($("#"+id).attr('data-height'))?0:$("#"+id).attr('data-height');
                },
                cat:function () {
                    return $.common.isEmpty($("#"+id).attr('data-cat'))?'':$("#"+id).attr('data-cat');
                }
            }
            ,accept:'images'
            ,acceptMime:'image/*'
            ,choose: function(obj){
                if(maxSize>0){
                    obj.preview(function(index, file, imgBas64){
                        //大于500k压缩图片
                        if(file.size > 1024*maxSize){
                            console.log(file)
                            var maxWidth = parseInt($.common.isEmpty($("#"+id).attr('data-width'))?0:$("#"+id).attr('data-width'));
                            if(maxWidth<10) maxWidth = 1000;
                            compressImg(imgBas64,maxWidth).then(data=>{
                                var newFile = base64ToFile(data,file.name,file.type);
                                obj.upload(index,newFile)
                            })
                        }else{
                            obj.upload(index,file)
                        }
                    });
                }

            }
            ,done: function(res){
                if(res.success && res.code===0){
                    if(callback && $.common.isFunction(callback)){
                        callback(id,res.data);
                    }else{
                        var html=b5uploadimghtml(res.data.path,id,res.data.url);
                        b5uploadhtmlshow(id,html);
                    }
                }else{
                    $.modal.msgError(res.msg);
                }
            }
            ,error: function(){
                $.modal.msgWarning('网络连接错误');
            }
        });
    });
}


function b5uploadfileinit(id,callback) {
    var maxnum = b5uploadMaxNum(id);
    var multi = maxnum > 1 ? true : false;
    layui.use('upload', function(){
        layui.upload.render({
            elem: '#'+id //绑定元素
            ,url: upFileUrl //上传接口
            ,field:'file'
            ,multiple:multi
            ,number:maxnum
            ,data:{
                cat:function () {
                    return $.common.isEmpty($("#"+id).attr('data-cat'))?'':$("#"+id).attr('data-cat');
                }
            }
            ,accept:'file'
            ,before:function () {}
            ,done: function(res){
                if(res.success && res.code===0){
                    if($.common.isFunction(callback)){
                        callback(id,res.data);
                    }else{
                        var html=b5uploadfilehtml(res.data.path,id,res.data.url,res.data.originName);
                        b5uploadhtmlshow(id,html);
                    }
                }else{
                    $.modal.msgError(res.msg);
                }
            }
            ,error: function(){
                $.modal.msgWarning('网络连接错误');
            }
        });
    });
}

//File 转 Base64
function fileToBase64(file){
    return new Promise((resolve) => {
        var reader = new FileReader()
        reader.readAsDataURL(file)
        //读取后，result属性中将包含一个data:URL格式的Base64字符串用来表示所读取的文件
        reader.onload = function(e){
            resolve(e.target.result)
        }
    })
}
//将base64转换为Blob文件
function base64ToBlob(data, mime) {
    data = data.split(',')[1];
    data = window.atob(data);
    var ia = new Uint8Array(data.length);
    for (var i = 0; i < data.length; i++) {
        ia[i] = data.charCodeAt(i);
    }
    return new Blob([ia], {type: mime});
}

//base64转file
function base64ToFile(base64, filename, mime){
    var arr = base64.split(',')  //去掉base64格式图片的头部
    var bstr = atob(arr[1])   //atob()方法将数据解码
    var leng = bstr.length
    var u8arr = new Uint8Array(leng)
    while(leng--){
        u8arr[leng] =  bstr.charCodeAt(leng) //返回指定位置的字符的 Unicode 编码
    }
    return new File([u8arr], filename, {type:mime})
}
// 压缩图片
function compressImg(file64,maxWidth) {
    return new Promise(resolve => {
        if (!file64) {
            resolve(file64);
        }else{
            var image = new Image();
            image.onload=function (){
                var width = image.width;
                var height = image.height;
                if(width>0 && height>0){
                    maxWidth = maxWidth?maxWidth:1024;
                    maxWidth = width>maxWidth?maxWidth:width;
                    var maxHeight = height*maxWidth/width;
                    // 使用canvas压缩图片
                    var canvas = document.createElement("canvas");
                    var ctx = canvas.getContext("2d");

                    canvas.setAttribute("id", "canvas");
                    canvas.width = maxWidth;
                    canvas.height = maxHeight;

                    ctx.clearRect(0, 0, maxWidth, maxHeight); // 清除画布内所有像素
                    ctx.drawImage(image, 0, 0, maxWidth, maxHeight); // canvas绘制当前图片
                    const compressImage = canvas.toDataURL("image/jpeg", 0.5); // 设置压缩类型和压缩比例获取压缩后的文件
                    resolve(compressImage);
                }else{
                    resolve(file64);
                }
            }
            image.onerror=function (){
                resolve(file64);
            }
            image.src = file64;
        }
    })
}


