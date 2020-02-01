<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/productUpdate.html";i:1577435895;s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/_meta.html";i:1571821518;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="__STATIC__/hadmin//favicon.ico" >
    <link rel="Shortcut Icon" href="__STATIC__/hadmin//favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/respond.min.js"></script>

    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/lib/Hui-iconfont/1.0.8/iconfont.css" />

    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
<!--/meta 作为公共模版分离出去-->

<link href="__STATIC__/hadmin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
</head>
<style>
    .img-list{
        border: 1px solid #cccccc;
        width: 70%;
        margin-left: 15px;
    }

    .img-list,.img-list{
        display: flex;
        justify-content: center;
        align-items: center
    }
    .img-list ,.img-list .list{
        min-height: 150px;
        max-height: 600px;
    }
    .img-list .list li{
        display: inline-block;
        position:relative;
    }
    .img-list .list li img{
        width: 100px;
        height: 100px;
        margin: 20px;
    }
    .a-upload {
        padding: 4px 10px;
        height: 20px;
        line-height: 20px;
        position: relative;
        cursor: pointer;
        color: #888;
        background: #fafafa;
        border: 1px solid #ddd;
        border-radius: 4px;
        overflow: hidden;
        display: inline-block;
        *display: inline;
        *zoom: 1
    }

    .a-upload  input {
        position: absolute;
        font-size: 100px;
        right: 0;
        top: 0;
        opacity: 0;
        filter: alpha(opacity=0);
        cursor: pointer
    }

    .a-upload:hover {
        color: #444;
        background: #eee;
        border-color: #ccc;
        text-decoration: none
    }
    .t{
        display: inline-block;
        width: 22px;
        height: 22px;
        text-align: center;
        font-size: 16px;
        border-radius: 20px;
        border: 1px #0f9ae0 solid;
        background: #fff;
        cursor: pointer;
        margin-right:10px;
    }
    .t:hover{
        background: #2D93CA;
        color:#fff;
    }
</style>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 修改商品 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>ID：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="id" name="" readonly>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商品名字：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="name" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商品库存：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="" id="stock" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">成本价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="cost" placeholder="必须是整数" value="" class="input-text" style="width:90%">
                元</div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">商品价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="必须是整数" id="price" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">特殊价格：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="sprice" placeholder="必须是整数" value="" class="input-text" style="width:90%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">限购数量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="limit_counts" placeholder="必须是整数" value="" class="input-text" style="width:90%">
            </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">折扣：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="discount" placeholder="必须是整数" value="" class="input-text" style="width:90%">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">销量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="sales" placeholder="必须是整数" value="" class="input-text" style="width:90%">
            </div>
        </div>
        
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select  class="form-control" id="category">

                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <!--上传主图片-->
            <div class="upload">
                <label class="form-label col-xs-4 col-sm-2">主图片上传：</label>
                <div class="img-list formControls col-xs-8 col-sm-9 main">
                    <ul class="list">
                    </ul>
                    <a href="javascript:;" class="a-upload">
                        <input type="file" name="image" id="upload" onchange="upload_fun()">点击这里上传图片
                    </a>
                </div>
            </div>
        </div>
        <div class="row cl">
            <!--上传副图片-->
            <div class="upload">
                <label class="form-label col-xs-4 col-sm-2">副图片上传：</label>
                <div class="img-list formControls col-xs-8 col-sm-9 s">
                    <ul class="list">
                    </ul>
                    <a href="javascript:;" class="a-upload">
                        <input type="file" name="image" id="upload1" onchange="upload_fun1()">点击这里上传图片
                    </a>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">简要描述：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea id="summary" name="" cols="" rows="" class="textarea"  placeholder="说点什么" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！"></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius sub"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
                <button class="btn btn-default radius out" >&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }
    //主图片数组
    mainImgIds = new Array();
    //副图片数组
    sImgIds = new Array();
    id=<?php echo $id; ?>;
    $('#id').val(id);
    //获得id的商品详情
    getOne();
    function getOne(){
        var params={
            url:'/product/'+id,
            data:{},
            tokenFlag:true,
            sCallback:function(res) {
                //填充商品信息
                $('#name').val(res.name);
                $('#price').val(res.price);
                $('#stock').val(res.stock);
                $('#cost').val(res.cost);
                $('#discount').val(res.discount);
                $('#sales').val(res.sales);
                $('#discount').val(res.discount);
                $('#sprice').val(res.sprice);
                $('#limit_counts').val(res.limit_counts);
                getCatetory(res.category_id);
                length = res.main_imgs.length;
                var str='';
                for(var i=0; i<length; i++){
                    //alert(res.main_imgs[i].img_url.url);
                    str+='<li><img src="'+res.main_imgs[i].img_url.url+'"><button class="t" onclick="delMainImg('+res.main_imgs[i].img_id+')">×<button></li>';
                    mainImgIds.push(res.main_imgs[i].img_id);//添加主图片数组
                }
                $('.main').children('.list').append(str);
                length1 = res.imgs.length;
                var str1='';
                for(var j=0; j<length1; j++){
                    //alert(res.imgs[j].img_url.url);
                    str1+='<li><img src="'+res.imgs[j].img_url.url+'"><button class="t" onclick="delSImg('+res.imgs[j].img_id+')">×<button></li>';
                    sImgIds.push(res.imgs[j].img_id);//添加副图片数组
                }
                $('.s').children('.list').append(str1);
                $('#summary').val(res.summary);
            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getStorehouseData(params);
    }
    //获得商品全部分类
    function getCatetory(id){
        var params={
            url:'/category/all',
            data:{},
            tokenFlag:true,
            sCallback:function(res) {
                var data = res;
                if (data){
                    var len = data.length,str = '', item;
                    if(len>0) {
                        for (var i = 0; i < len; i++) {
                            item = data[i];
                            if(id == item.id){
                                str += '<option value="' + item.id + '" selected>' + item.name + '</option>';
                            }else{
                                str += '<option value="' + item.id + '">' + item.name + '</option>';
                            }

                        }
                    }
                    $('#category').html(str);
                }
            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getStorehouseData(params);
    }

    //提交修改信息
    $('.sub').click(function(){
        var params={
            url:'/product/update',
            data:{
            	ids:$('#id').val(),
            	name:$('#name').val(),
            	price:$('#price').val(),
                category:$('#category').val(),
                summary:$('#summary').val(),
                stock:$('#stock').val(),
                cost:$('#cost').val(),
                sales:$('#sales').val(),
            	discount:$('#discount').val(),
            	limit_counts:$('#limit_counts').val(),
            	sprice:$('#sprice').val()
            },
                
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
            	//alert(res);
            	layer.confirm('修改成功', {
                        btn: ['确定'] //按钮
                    }, function(){
                        window.location.href="productAll";
                    });
                
            },
            eCallback:function(res){
                alert('修改失败');
            }
        };
        window.base.getStorehouseData(params);
    })
    $('.out').click(function () {
        window.location.href='productAll';
    })
    //删除主图片
    function delMainImg(imgId){
        //alert(imgId+"#"+id);
        var params={
            url:'/product/delMainImg',
            data:{'imgId':imgId,'proId':id},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //alert(res);
                layer.confirm('删除成功', {
                    btn: ['确定'] //按钮
                }, function(){
                    for (var i = 0; i < mainImgIds.length; i++) {
                        if (mainImgIds[i] == imgId){
                            //删除
                            mainImgIds.splice(i,1);
                            //alert(mainImgIds);
                        };
                    }
                    layer.alert("删除成功");
                    window.location.reload();
                });
            },
            eCallback:function(res){
                layer.alert('删除失败');
            }
        };
        window.base.getStorehouseData(params);

    }
    //删除副图片
    function delSImg(imgId){
        //alert(imgId+"#"+id);
        var params={
            url:'/product/delSImg',
            data:{'imgId':imgId,'proId':id},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //alert(res);
                layer.confirm('删除成功', {
                    btn: ['确定'] //按钮
                }, function(){
                    for (var i = 0; i < sImgIds.length; i++) {
                        if (sImgIds[i] == imgId){
                            //删除
                            sImgIds.splice(i,1);
                            //alert(mainImgIds);
                        };
                    }
                    layer.alert("删除成功");
                    window.location.reload();
                });
            },
            eCallback:function(res){
                layer.alert('删除失败');
            }
        };
        window.base.getStorehouseData(params);
    }
    //修改时上传主图片
        function upload_fun() {
//假设我上传了一张图片，触发change事件后
            var $this = $('#upload');
            var file = $this[0];        //获得dom对象
            var imgSum = file.files.length;     //图片数量，就是你选择了的图片数量。
            var uploadSum = $this.data('id'); //上传了的图片数量 也代表函数执行了几次，之前有提到，默认为0。
            var formFile = new FormData();    //FormData是异步上传的前提，不懂请百度。
            formFile.append('image', file.files[0]);//这里是把文件存到FormData中，uploadSum是0，也就是第一张图片，1就是第二张，依次类推。
            formFile.append('proId',id);//增加商品id
            $.ajax({
                url: "/api/v1/product/uploadMainImg",    //请求路径没什么可说的
                type: "POST",
                data: formFile,                        //注意参数
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    //alert(data);
                    mainImgIds.push(data.imgId);
                    layer.alert('上传成功');
                    //alert(mainImgIds);
                    uploadSum++;             //如果上传成功，上传了的数量就+1
                    $this.data('id', uploadSum); //将缓存更新
//获取到后端地址后，赋给img标签并插入dom上传成功
                    $('.main').children('.list').removeClass('hide')
                        .append('<li id="m'+data.imgId+'"><img src="/' + data.path + '"><button class="t" onclick="delMainImg('+data.imgId+')">×<button></li>');
//判断上传了的图片数量 是否小于 选择了的图片数量
                    if (uploadSum < imgSum) {
//如果小于就递归调用该方法，这下你知道我在change中为什么不用匿名函数了吧。
                        upload_fun();//这里调用后upload_fun函数中formFile.append('image', file.files[uploadSum])中的uploadSum就会变为1，也就是第二张图片。相信到这里你已经明白了，我是把你选择的一组图片，一张一张上传到服务器，这样可以减轻服务器并发的压力，也不降低了出错的几率。当然如果你上传一张就执行一次。
                    } else {
//当图片都上传完成后，上传了的图片数量归0，input值也清空。
                        $this.data('id', 0).val('');
                    }
                },
                error: function (error) {
//错误你来处理吧。
                    layer.alert('上传失败');
                }
            })
    }
            //修改时上传副图片
    function upload_fun1() {
//假设我上传了一张图片，触发change事件后
        var $this = $('#upload1');
        var file = $this[0];        //获得dom对象
        var formFile = new FormData();    //FormData是异步上传的前提，不懂请百度。
        formFile.append('image', file.files[0]);//这里是把文件存到FormData中，uploadSum是0，也就是第一张图片，1就是第二张，依次类推。
        formFile.append('proId',id);//增加商品id
        $.ajax({
                    url: "/api/v1/product/uploadSImg",    //请求路径没什么可说的
                    type: "POST",
                    data: formFile,                        //注意参数
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (data) {
                        //alert(data);
                        if(data.status){
                            sImgIds.push(data.imgId);
                            layer.alert('上传成功');
                            //alert(sImgIds);
                            $('.s').children('.list').removeClass('hide')
                                .append('<li id="n'+data.imgId+'"><img src="/' + data.path + '"><button class="t" onclick="delSImg('+data.imgId+')">×<button></li>');
                        }else{
                            layer.alert("上传失败！");
                        }
                    },
                    error: function (error) {
                        layer.alert('上传失败');
                    }
                })
    }
</script>
</body>
</html>