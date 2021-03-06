<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/cityOrder.html";i:1575620526;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
        .page{
            text-align: center;
        }
        .select{
            width: 200px;
            margin-right:10px;
            margin-left:10px;
        }
        #sel{
            margin-left:30px;
        }
        .cl{
            text-align: center;
        }
        .span{
            margin-right: 200px;
        }
        .city{
            margin-top:30px;
        }
        .text-c{
            text-align: left;
           padding-left:400px;
        }
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 销售数据 <span class="c-gray en">&gt;</span> 城市数据 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

<div class="page-container">
    <div class="text-c"> 日期范围：
        <select name="year" class="select" id="year">
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
        </select>年
        -
        <select name="month" class="select" id="month">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>月
    </div>
    <div class="text-c city"> 城市：
        <select name="city" class="select" id="city">
        </select>
        订单状态：
        <select name="status" class="select" id="status">
            <option value="0">全部</option>
            <option value="1">未支付</option>
            <option value="2">已支付</option>
            <option value="3">已发货</option>
        </select>
        <button class="btn btn-success" id="sel" name=""><i class="Hui-iconfont">&#xe665;</i> 查看数据</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="span"><strong id="str1"></strong></span><span><strong id="str2"></strong></span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th width="160">订单号</th>
                <th>详细信息</th>
                <th width="80">数量</th>
                <th width="80">总金额</th>
                <th>下单时间</th>
                <th>门店</th>
                <th>供货仓</th>
                <th width="80">订单状态</th>
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
    $("#sel").click(function () {
        getOrders(1);
    });

    //获得数据
    function getOrders(page){
        var year = $("#year").val();
        var month = $("#month").val();
        var cityID = $("#city").val();
        var status = $("#status").val();
        //alert(year+"@"+month);
        //默认第一页
        //读取令牌
        //var token = window.base.getLocalStorage('token');
        //alert(token);
            var params={
                url:'/order/adminGetCityOrder',
                data:{'cityID':cityID,'page':page,'year':year,'month':month,'status':status},
                tokenFlag:true,
                type:'post',
                sCallback:function(res) {
                    //alert(res);
                    //拼接字符串
                    if(res){
                        var str = getOrderHtmlStr(res);
                        $('tbody').html(str);
                        getCount(page,year,month,cityID,status);
                    }
                },
                eCallback:function(res){
                    alert("获得全部订单错误");
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
                    str += '<tr class="text-c">' +
                        '<td>' + item.order_no + '</td>';
                    //拼接订单详细信息
                    var pro=item.snap_items,le = pro.length,prostr='';
                    for(var i=0;i<le;i++){
                        prostr+='商品名：'+pro[i].name+'<br> 数量:'+pro[i].counts+'<br>';
                    }
                    str+= '<td>' + prostr + '</td>'+
                        '<td>' + item.total_count + '</td>' +
                        '<td>' + item.total_price + '</td>'+
                        '<td>' + item.create_time + '</td>';
                    if(item.store==null){
                        str+='<td></td>';
                    }else{
                        str+='<td>' + item.store.truename + '</td>';
                    }
                    if(! item.storehouse==null){
                        str+='<td></td>';
                    }else{
                        str+= '<td>' + item.storehouse.truename + '</td>';
                    }


                    //查看订单状态
                    var status,cal;
                    switch (item.status) {
                        case 1:
                            status='未支付';
                            cal = 'btn btn-info';
                            break;
                        case 2:
                            status='已支付';
                            cal = 'btn btn-warning';
                            break;
                        case 3:
                            status='已发货';
                            cal = 'btn btn-success';
                            break;
                        case 4:
                            status='库存不足';
                            cal = 'btn btn-danger';
                            break;

                    }
                    str+=   '<td><button class="'+cal+'">'+status+'</button></td>' +
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
        str += '<a class="btn btn-default" onclick="getOrders('+last+')">上一页</a>';
        str += '<span class="btn btn-primary radius">'+nowPage+'</span>';
        str += '<a class="btn btn-default" onclick="getOrders('+next+')">下一页</a>';

        $('.page').html(str);
    }

    //获得订单总数
    function getCount(nowPage,year,month,cityID,status){
        var params={
            url:'/order/adminGetCityOrderCount',
            data:{'cityID':cityID,'status':status,'year':year,'month':month},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                if(res.amount){
                    $('#str1').html("共有订单："+res.count+"单");
                    $('#str2').html("总计金额："+res.amount+"元");
                    setPage(res.count,nowPage);
                }else if(res.count){
                    $('#str1').html("共有订单："+res.count+"单");
                    $('#str2').html("");
                    setPage(res.count,nowPage);
                }else{
                    layer.alert("没有订单");
                    $('#str1').html("共有订单："+res.count+"单");
                    $('#str2').html("");
                    setPage(res.count,nowPage);
                }

            },
            eCallback:function(res){
                alert("获得订单总数错误");
            }
        };
        window.base.getAdminData(params);
    }
    getCity();
    //获得所有城市种类
    function getCity(){
        var params={
            url:'/city/adminGetCity',
            data:{},
            type:'post',
            tokenFlag:true,
            sCallback:function(res) {
                if(res){
                    var data = res;
                    if (data){
                        var len = data.length,str = '', item;
                        if(len>0) {
                            for (var i = 0; i < len; i++) {
                                item = data[i];
                                str += '<option value="' + item.id + '">' + item.name + '</option>';
                            }
                        }
                        $('#city').html(str);
                    }
                }else{
                    layer.alert("没有城市");
                }

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