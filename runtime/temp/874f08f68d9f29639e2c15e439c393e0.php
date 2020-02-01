<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/productAdd.html";i:1577436254;s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/_meta.html";i:1571821518;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 添加商品 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add">
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
                <input type="text" name="" id="cost" placeholder="必须是整数" value="" class="input-text">
                </div>
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
                <input type="text" class="input-text" value="" placeholder="必须是整数" id="sprice" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">限购数量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="必须是整数" id="limit_counts" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">折扣：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="0.01到1.00" id="discount" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">销量：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="必须是整数" id="sales" name="">
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
    getCatetory();
    //获得商品全部分类
    function getCatetory(){
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
                            str += '<option value="' + item.id + '">' + item.name + '</option>';
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
    //提交增加信息
    $('.sub').click(function(){
        var formdata = new FormData();
        //因为不是整个表单数据，所以用append模拟表单信息
        //以下两种方式都可以
        //formdata.append("img", document.getElementById("img").files[0]);
        //formdata.append("img", $("#img")[0].files[0]);
        formdata.append("mainImgIds",mainImgIds);
        formdata.append("sImgIds",sImgIds);
        formdata.append("name", $("#name").val());
        formdata.append("price", $("#price").val());
        formdata.append("category", $("#category").val());
        formdata.append("summary", $("#summary").val());
        formdata.append("stock", $("#stock").val());
        formdata.append("cost", $("#cost").val());
        formdata.append("discount", $("#discount").val());
        formdata.append("sales", $("#sales").val());
        formdata.append("sprice", $("#sprice").val());
        formdata.append("limit_counts", $("#limit_counts").val());
        $.ajax({
            type:"post",
            dataType:"json",
            data:formdata,
            beforeSend: function (request) {
                request.setRequestHeader("token",window.base.getLocalStorage('storehouseToken'));
            },
            contentType: false,
            processData: false,
            url:"/api/v1/product/add",
            success:function (data) {
               // alert(data);
                if(data){
                    layer.confirm('添加成功', {
                        btn: ['确定'] //按钮
                    }, function(){
                        window.location.reload();
                    });
                    // layer.msg('添加成功!',{icon:1,time:2000});
                }
            }
        });


    })
    //取消
    $('.out').click(function () {
        window.location.href='productAll';
    })
    //上传主图片
    function upload_fun() {
//假设我上传了一张图片，触发change事件后
        var $this = $('#upload');
        var file = $this[0];        //获得dom对象
        var imgSum = file.files.length;     //图片数量，就是你选择了的图片数量。
        var uploadSum = $this.data('id'); //上传了的图片数量 也代表函数执行了几次，之前有提到，默认为0。
        var formFile = new FormData();    //FormData是异步上传的前提，不懂请百度。
        formFile.append('image', file.files[0]);//这里是把文件存到FormData中，uploadSum是0，也就是第一张图片，1就是第二张，依次类推。
        $.ajax({
            url: "/api/v1/product/getImgIdUrl",    //请求路径没什么可说的
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
                $('.title').html('');
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
    //上传副图片
    function upload_fun1() {
//假设我上传了一张图片，触发change事件后
        var $this = $('#upload1');
        var file = $this[0];        //获得dom对象
        var formFile = new FormData();    //FormData是异步上传的前提，不懂请百度。
        formFile.append('image', file.files[0]);//这里是把文件存到FormData中，uploadSum是0，也就是第一张图片，1就是第二张，依次类推。
        $.ajax({
            url: "/api/v1/product/getImgIdUrl",    //请求路径没什么可说的
            type: "POST",
            data: formFile,                        //注意参数
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                sImgIds.push(data.imgId);
                layer.alert('上传成功');
//获取到后端地址后，赋给img标签并插入dom上传成功
                $('.s').children('.list').removeClass('hide')
                    .append('<li id="n'+data.imgId+'"><img src="/' + data.path + '"><button class="t" onclick="delSImg('+data.imgId+')">×<button></li>');
            },
            error: function (error) {
                layer.alert('上传失败');
            }
        })
    }
    //删除主图片,只需要删除image里的表
    function delMainImg(imgId){
        //alert(imgId);

        var params={
            url:'/product/delMainImgA',
            data:{'imgId':imgId},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //alert(res);
                for (var i = 0; i < mainImgIds.length; i++) {
                    if (mainImgIds[i] == imgId){
                        //删除
                        mainImgIds.splice(i,1);
                        //alert(mainImgIds);
                    };
                }
                layer.alert("删除成功");
                $("#m"+imgId).remove();


            },
            eCallback:function(res){
                layer.alert('删除失败');
            }
        };
        window.base.getStorehouseData(params);
    }
    //删除副图片,只需要删除image里的表
    function delSImg(imgId){
        //alert(sImgIds);
        var params={
            url:'/product/delMainImgA',
            data:{'imgId':imgId},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //alert(res);
                for (var i = 0; i < sImgIds.length; i++) {
                    if (sImgIds[i] == imgId){
                        //删除
                        sImgIds.splice(i,1);
                        //alert(sImgIds);
                    };
                }
                layer.alert("删除成功");
                $("#n"+imgId).remove();
            },
            eCallback:function(res){
                layer.alert('删除失败');
            }
        };
        window.base.getStorehouseData(params);
    }
</script>
</body>
</html>