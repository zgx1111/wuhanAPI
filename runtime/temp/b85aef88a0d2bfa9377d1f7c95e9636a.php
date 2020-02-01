<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:95:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/storeOpenOrClose.html";i:1575872213;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 店铺管理 <span class="c-gray en">&gt;</span> 查看门店 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th>ID</th>
                <th>账号</th>
                <th>名字</th>
                <th>状态</th>
                <th width="250">操作</th>
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

    //alert(window.base.getLocalStorage('token'));
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }
    getStores(1);
    //获得数据
    function getStores(page){
        //默认第一页
        //读取令牌
        //var token = window.base.getLocalStorage('token');
        //alert(token);
        var params={
            url:'/store/storehouseGetStore',
            data:{'page':page},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                if(res == 0){
                    $('tbody').html('无数据');
                }else{
                    //拼接字符串
                    var str = getStoreHtmlStr(res);
                    $('tbody').html(str);
                    getCount(page);
                }

            },
            eCallback:function(res){
                alert('请求错误');
            }
        };
        window.base.getStorehouseData(params);
    }
    //拼接字符串
    function getStoreHtmlStr(res){
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
                        str+='<td>已开启</td>'+
                            '<td><button class="btn btn-warning" onclick="updateState(' + item.id +','+item.state+')">关闭</button></td></tr>';
                    }else{
                        str+='<td>已关闭</td>'+
                            '<td><button class="btn btn-success" onclick="updateState(' + item.id +','+item.state+')">开启</button></td></tr>';
                    }

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
            url:'/store/getCount',
            data:{},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                setPage(res,nowPage);
            },
            eCallback:function(res){
                layer.alert('请重新登陆');
            }
        };
        window.base.getStorehouseData(params);
    }
    //修改门店状态
    function updateState(id,state){
        if(state == 1){
            state = 0;
        }else{
            state =1;
        }
        var params={
            url:'/store/state',
            data:{'id':id,'state':state},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //alert(res);
                if(res){
                    layer.alert('成功！！！');
                   setTimeout(function(){
                       window.location.reload();//刷新当前页面.
                   },1000)
                }else{
                    layer.alert('失败！！！');
                }
            },
            eCallback:function(res){
                layer.alert('操作错误，请刷新');
            }

        };
        window.base.getStorehouseData(params);

    }
</script>
</body>
</html>