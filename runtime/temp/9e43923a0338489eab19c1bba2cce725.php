<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:78:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/info.html";i:1575620526;s:79:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/_meta.html";i:1571821518;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 个人信息 <span class="c-gray en">&gt;</span> 查看信息 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text"  class="input-text" readonly id="username" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" readonly id="password" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">姓名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" name="" id="truename" class="input-text">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" id="phone" name="">
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
    if(!window.base.getLocalStorage('adminToken')){
        window.location.href = '/yxadmin';
    }
    //alert(window.base.getLocalStorage('token'));
    //获得id的商品详情
    getinfo();
    function getinfo(){
        var params={
            url:'/admin/info',
            type:'post',
            data:{},
            tokenFlag:true,
            sCallback:function(res) {
                //填充商品信息
                $('#username').val(res.username);
                $('#password').val(res.password);
                $('#truename').val(res.truename);
                $('#phone').val(res.phone);
            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getAdminData(params);
    }
</script>
</body>
</html>