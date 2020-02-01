<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:89:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/articleAdd.html";i:1579244700;s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/_meta.html";i:1571821518;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
            <label class="form-label col-xs-4 col-sm-2">文章题目：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="文章题目" id="title" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">文章内容：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <textarea id="content" name="content"></textarea>
            </div>
        </div>
         <div class="row cl">
            <!--上传主图片-->
            <div class="upload">
                <label class="form-label col-xs-4 col-sm-2">文章图片：</label>
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
                <label class="form-label col-xs-4 col-sm-2">点赞量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="点赞量" id="like_num" name="">
                </div>
        </div>
        <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">阅读量：</label>
                <div class="formControls col-xs-8 col-sm-9">
                        <input type="text" class="input-text" value="" placeholder="阅读量" id="read_num" name="">
                </div>
        </div>
        <div class="row cl">
                <label class="form-label col-xs-4 col-sm-2">状态：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="radio" name="status" checked="checked" value="0">正常
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="status" value="1">禁止
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
<!--富文本编辑引入-->
<script type="text/javascript" src="__STATIC__/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="__STATIC__/ueditor/ueditor.all.js"></script>
<script type="text/javascript" src="__STATIC__/ueditor/lang/zh-cn/zh-cn.js"></script>
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }
    var ue = UE.getEditor('content', {
        initialFrameWidth: 1000,    //初始化宽度
        initialFrameHeight: 400,   //初始化高度
        maximumWords:65535,         //最大长度限制
        autoHeightEnabled: false,  //禁止自动长高
        autoFloatEnabled:false,    //禁止工具条漂浮
        zIndex:"0"
    });
    $(".sub").click(function(){
            var formData = new FormData();
            var content = ue.getContent();
            formData.append("title",$('#title').val());
            formData.append("read_num",$('#read_num').val());
            formData.append("like_num",$('#like_num').val());
            formData.append("status",$("input[name='status']:checked").val());
            formData.append("imgUrl",$("img").attr("src"));
            formData.append("content",content);
            //alert("123");
            $.ajax({
                type:"post",
                dataType:"json",
                data:formData,
                beforeSend: function (request) {
                    request.setRequestHeader("token",window.base.getLocalStorage('storehouseToken'));
                },
                contentType: false,
                processData: false,
                url:"/api/v1/article/artAdd",
                success:function (data) {
                    //alert(data);
                    if(data){
                        layer.confirm('添加成功', {
                            btn: ['确定'] //按钮
                        }, function(){
                            window.location.reload();
                        });
                    }
                }
            });
    });
    //上传图片
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
                layer.alert('上传成功');
                $this.data('id', uploadSum); //将缓存更新
//获取到后端地址后，赋给img标签并插入dom上传成功
                $('.main').children('.list').removeClass('hide')
                    .html('<li><img src="/' + data.path + '"></li>');
            },
            error: function (error) {
                layer.alert('上传失败');
            }
        })
    }
          
           

</script>
</body>
</html>