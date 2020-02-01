<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/adminGetStoreAll.html";i:1578490461;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
         #j{
            text-align: center;
            margin-top: 10px;
        }
        #jump{
            width: 80px;
            height: 30px;
            border: 1px solid #ccc;
            text-align: center;
            font-size: 15px;
        }
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>门店 <span class="c-gray en">&gt;</span>查看门店 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="cl pd-5 bg-1 bk-gray mt-20"><span class="r">共有数据：<strong></strong> 条</span> </div>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th width="30">id</th>
                <th>账号</th>
                <th>店名</th>
                <th>状态</th>
                <th>所属供货仓</th>
                <th>所属城市</th>
                <th>所属推广员</th>
                <th>详细地址</th>
                <th>电话</th>
                <th>创建时间</th>
                <th colspan="3">操作</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <!--分页部分-->
        <div class="page"></div>
        <div id="j">
            <input type="text" id="jump">
            <button id="but" class="btn btn-success">跳页</button>
        </div>

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

    //获得所有门店
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('adminToken')){
        window.location.href = '/yxadmin';
    }
    $("#but").click(function () {
        getStores($("#jump").val());
    });
    getStores(1);
    //获得数据
    function getStores(page){
        //默认第一页
        //读取令牌
        var token = window.base.getLocalStorage('token');
        //alert(token);
        var params={
            url:'/store/adminGetStoreAll',
            data:{'page':page},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //拼接字符串
                var str = getProductsHtmlStr(res);
                $('tbody').html(str);
                getCount(page);


            },
            eCallback:function(res){
                alert('请求错误');
            }
        };
        window.base.getAdminData(params);
    }
    //拼接字符串
    function getProductsHtmlStr(res){
        var data = res;
        if (data){
            var len = data.length,str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr class="text-c">' +
                        '<td>' + item.id + '</td>' +
                        '<td>' + item.username + '</td>' +
                        '<td>' + item.truename + '</td>';
                    if(item.state == 1){
                        str+='<td>已开启</td>';
                    }else{
                        str+='<td>已关闭</td>';
                    }

                        if(item.storehouse == null){
                            str+='<td></td>';
                        }else{
                            str+='<td>' + item.storehouse.truename + '</td>';
                        }
                        if(item.city ==null){
                            str+='<td></td>';
                        }else{
                            str+='<td>' + item.city.name + '</td>' ;
                        }

                        if(item.eworker == null){
                            str+='<td></td>';
                        }else{
                            str+='<td>' + item.eworker.truename + '</td>';
                        }

                    str+='<td>' + item.address + '</td>' +
                        '<td>' + item.phone + '</td>' +
                        '<td>' + item.create_time+ '</td>' +
                        '<td width="100px"><button class="btn btn-success" onclick="selStoreOrder('+item.id+')">查看门店订单</button></td>' +
                        '<td width="100px"><button class="btn btn-primary" onclick="updateStore('+item.id+')">修改信息</button></td>' +
                        '<td width="100px"><button class="btn btn-warning" onclick="delStore('+item.id+')">删除</button></td>' +
                        '</tr>';
                }
            }
            return str;
        }
        return '';
    }
    //分页
    function setPage(count,nowPage){
        var sum = parseInt(count/15)+1;
        var str='<p>共 '+sum+' 页</p>'
        last = nowPage-1;
        next = nowPage+1;
        if(last<1){
            last=1;
        }
        if(next>sum){
            next=sum;
        }
        str += '<a class="btn btn-default" onclick="getStores('+last+')">上一页</a>';
        str += '<span class="btn btn-primary radius">'+nowPage+'</span>';
        str += '<a class="btn btn-default" onclick="getStores('+next+')">下一页</a>';

        $('.page').html(str);
    }
    //获得门店总数
    function getCount(nowPage){
        var params={
            url:'/store/adminGetStoreCount',
            data:{},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                $('strong').html(res);
                setPage(res,nowPage);
            },
            eCallback:function(res){
                alert('获取门店总数错误');
            }
        };
        window.base.getAdminData(params);
    }
    //查看门店订单
    function selStoreOrder(id){
        //alert(id);
        window.location.href = 'adminGetStoreOrder?id='+id;
    }
    //修改门店订单
    function updateStore(id){
        window.location.href = 'adminUpdateStore?id='+id;
    }
    //删除门店
    function delStore(id){
        layer.confirm('是否确认删除id为'+id+'的门店', ['确定','取消'], function(){
            var params={
                url:'/store/adminDelStore',
                data:{'id':id},
                tokenFlag:true,
                type:'post',
                sCallback:function(res) {

                    if(res){
                        layer.confirm('删除成功', ['确定'], function(){
                            window.location.reload();
                        })
                    }

                },
                eCallback:function(res){
                    alert('删除失败');
                }
            };
            window.base.getAdminData(params);
        },function(){

        });


    }
</script>
</body>
</html>