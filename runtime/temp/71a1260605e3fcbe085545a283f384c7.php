<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/updateTime.html";i:1575879749;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/hadmin/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="__STATIC__/hadmin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>门店</title>
    <style>
        .page{
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 营业时间 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">开店时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" placeholder="请输入0-24的整点时间" id="begin_at" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">关店时间：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" placeholder="请输入0-24的整点时间" id="end_at" name="">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
                <button class="btn btn-primary radius sub" onclick="updateTime()"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
            </div>
        </div>
    </form>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/laypage/1.2/laypage.js"></script>
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">

    //alert(window.base.getLocalStorage('token'));
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }
    //getinfo();
    function getinfo(){
        var params={
            url:'/storehouse/storehouseGetName',
            type:'post',
            data:{},
            tokenFlag:true,
            sCallback:function(res) {
                //填充商品信息
                $('#begin_at').val(res.begin_at);
                $('#end_at').val(res.end_at);

            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getStorehouseData(params);
    }
    function updateTime() {
        begin = $('#begin_at').val();
        end = $('#end_at').val();
        var reg = /^(?:0|[1-9]|1[0-9]|2[0-4])$/;
        if(!reg.test(begin)) {
            layer.alert("开店时间：请输入0-24的整数！");
            return;
        }
        if(!reg.test(end)) {
            layer.alert("关店时间：请输入0-24的整数！");
            return;
        }
        var params={
            url:'/storehouse/storehouseUpdateTime',
            type:'post',
            data:{beginAt:begin,endAt:end},
            tokenFlag:true,
            sCallback:function(res) {
                if(true){
                    layer.alert("修改成功");
                }
            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getStorehouseData(params);

    }
</script>
</body>
</html>