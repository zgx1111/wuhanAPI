<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:80:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/banner.html";i:1575620526;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
    <title>订单列表</title>
    <style>
        .img{
            width: 30px;
            height: 30px;
        }
        .page{
            text-align: center;
        }
        .status{
            color: #ACCD3C;
            font-size: 16px;
        }
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 微信管理 <span class="c-gray en">&gt;</span> 轮播图 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="cl pd-5 bg-1 bk-gray mt-20"><span class="r">共有数据：<strong></strong> 条</span> </div>
<div class="page-container">
    <div class="mt-20">

        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th width="160">id</th>
                <th width="560">图片</th>
                <th>更新图片</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <!--分页部分-->
        <div class="page"></div>

    </div>
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
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('adminToken')){
        window.location.href = '/yxadmin';
    }
    getBanners();
    //获得数据
    function getBanners(){
        //默认第一页
        //读取令牌
        //var token = window.base.getLocalStorage('token');
        //alert(token);
        var params={
            url:'/banner/adminGetBanner',
            data:{},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //拼接字符串
                var str = getOrderHtmlStr(res);
                $('tbody').html(str);
            },
            eCallback:function(res){
                alert("获得幻灯片错误");
            }
        };
        window.base.getAdminData(params);
    }
    //拼接字符串
    function getOrderHtmlStr(res){
        var data = res;
        if (data){
            var len = data.length,str = '', item;
            if(len>0) {
                for (var j = 0; j < len; j++) {
                    item = data[j];
                    str +='<tr class="text-c">' +
                        '<td>' + item.id + '</td>';
                    if(item.img!=null){
                        str+= '<td><img class="img" src="' + item.img.url + '"</td>';
                    }else{
                        str+='<td>' + item.img + '</td>';
                    }
                      str+= '<td><form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add"><input type="file" class="form-control" id="'+item.id+'"><button class="btn btn-success" onclick="updateImg(' + item.id +')">确定</button></form></td></tr>'
                }
            }
            return str;
        }
        return '';
    }
    //修改图片
    function updateImg(id){
        var formdata = new FormData();
        //因为不是整个表单数据，所以用append模拟表单信息
        //以下两种方式都可以
        //formdata.append("img", document.getElementById("img").files[0]);
        formdata.append("img", $("#"+id)[0].files[0]);
        formdata.append("id", id);
        $.ajax({
            type:"post",
            dataType:"json",
            data:formdata,
            beforeSend: function (request) {
                request.setRequestHeader("token",window.base.getLocalStorage('adminToken'));
            },
            contentType: false,
            processData: false,
            url:"/api/v1/banner/updateImg",
            success:function (data) {
                if(data == 3){
                    layer.msg('图片不能为空!',{icon:1,time:2000});
                }else{
                    layer.msg('上传成功!',{icon:1,time:2000});
                    setTimeout(function(){
                       window.location.reload();//刷新当前页面.
                   },2000);
                }
            },
            error:function(err){
                alert('上传错误'+err.error);
            }
        });

    }

</script>
</body>
</html>