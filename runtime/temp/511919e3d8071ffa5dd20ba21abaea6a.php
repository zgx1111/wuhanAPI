<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/login/storehouse.html";i:1575621454;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/html5shiv.js"></script>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/respond.min.js"></script>
    <![endif]-->
    <link href="__STATIC__/hadmin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/hadmin/static/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/hadmin/static/h-ui.admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="__STATIC__/hadmin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>后台登录</title>
</head>
<style>
    html{
        width: 100%;
        height: 100%;
        overflow: hidden;

    }
    body{
        width: 100%;
        height: 100%;
        font-family: 'Open Sans',sans-serif;
        margin: 0;
        background-color:#5A495C;
    }
    #login{
        position: absolute;
        top: 50%;
        left:50%;
        margin: -150px 0 0 -150px;
        width: 300px;
        height: 300px;
    }
    #login h1{
        color: #fff;
        text-shadow:0 0 10px;
        letter-spacing: 1px;
        text-align: center;
    }
    h1{
        font-size: 2em;
        margin: 0.67em 0;
    }
    input{
        width: 278px;
        height: 18px;
        margin-bottom: 10px;
        outline: none;
        padding: 10px;
        font-size: 13px;
        color: #fff;
        text-shadow:1px 1px 1px;
        border-top: 1px solid #312E3D;
        border-left: 1px solid #312E3D;
        border-right: 1px solid #312E3D;
        border-bottom: 1px solid #56536A;
        border-radius: 4px;
        background-color: #2D2D3F;
    }
    .but{
        width: 300px;
        min-height: 20px;
        display: block;
        background-color: #4a77d4;
        border: 1px solid #3762bc;
        color: #fff;
        padding: 9px 14px;
        font-size: 15px;
        line-height: normal;
        border-radius: 5px;
        margin: 0;
    }
</style>
<body>
<div id="login">
    <h1>雅性商城后台<br>供货仓登陆</h1>
    <form action="javascript:;">
        <input type="text" id="username" required="required" placeholder="用户名" name="u"></input>
        <input type="password" id="password" required="required" placeholder="密码" name="p"></input>
        <button class="but" type="submit">登录</button>
    </form>
</div>
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script src="__STATIC__/js/common.js" type="application/javascript"></script>

<script>
    $(".but").click(function() {
        var userName = $('#username'),
                pwd = $('#password');
        var params = {
            url: '/storehouse',
            type: 'post',
            data: {username: userName.val(), password: pwd.val()},
            sCallback: function (res) {
                    if(!res.token){
                        layer.alert('用户名或者密码错误');
                    }else{
                        //缓存token
                        window.base.setLocalStorage('storehouseToken', res.token);
                        layer.msg('登陆成功',{icon:1,time:1000});
                        window.location.href = 'storehouse/index';
                    }

            },
            eCallback: function (e) {
                if (e.status == 401) {
                    alert("用户名或密码错误");
                }
            }
        };

        window.base.getStorehouseData(params);
    });
</script>
</body>
</html>
