<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:90:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/orderRemind.html";i:1578542199;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
    <title>提醒订单</title>
    <style>

        .page{
            text-align: center;
        }

    </style>

</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 提醒订单 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th width="30">ID</th>
                <th>订单号</th>
                <th>数量</th>
                <th>总金额</th>
                <th>详细信息</th>
                <th>名字</th>
                <th>电话</th>
                <th>地点</th>
                <th>详细地址</th>
                <th>下单时间</th>
                <th>送货时间</th>
                <th>备注</th>
                <th width="80">订单状态</th>
                <th colspan="2">操作</th>
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
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }
    //alert(window.base.getLocalStorage('storehouseToken'));
    getOrders(1);
    //获得数据
    function getOrders(page){
        //默认第一页
        //读取令牌
        //var token = window.base.getLocalStorage('storehouseToken');
        //alert(token);
        var params={
            url:'/order/getOrderRemind',
            data:{'page':page},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                //拼接字符串
                var str = getOrderHtmlStr(res);
                $('tbody').html(str);
                getCount(page);

            },
            eCallback:function(res){
                alert("请求错误");
            }
        };
        window.base.getStorehouseData(params);
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
                        '<td>' + item.id + '</td>' +
                        '<td>' + item.order_no + '</td>' +
                        '<td>' + item.total_count + '</td>' +
                        '<td>' + item.total_price + '</td>';
                    //拼接订单详细信息
                    var pro=item.snap_items,le = pro.length,prostr='';
                    for(var i=0;i<le;i++){
                        prostr+='商品名：'+pro[i].name+'; 数量:'+pro[i].counts+'<br>';
                    }

                    str+= '<td>' + prostr + '</td>';
                    //拼接地址信息
                    var add=item.snap_address;
                    str+='<td>'+add.name+'</td><td>'+add.phone+'</td><td>'+item.store.truename+'</td><td>'+add.address+'</td>';


                    str+=  '<td>' + item.create_time + '</td>'+
                            '<td>' + item.send_time + '</td>'+
                            '<td>' + item.remarks + '</td>';
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
                        case 5:
                        	status='已接单';
                            cal = 'btn btn-warning';
                            break;

                    }
                    str+=   '<td><button class="'+cal+'">'+status+'</button></td>' +
                    	'<td><button class="btn btn-warning" onclick="orderTaking(' + item.id +','+item.status+')">接单</button></td>' +
                        '<td><button class="btn btn-primary" onclick="send(' + item.id +','+item.status+')">发货</button></td>' +
                        '</tr>';
                }
            }
            return str;
        }
        return '';
    }
    //分页
    function setPage(count,nowPage){
        if(parseInt(count%15) == 0){
            var sum = parseInt(count/15);
        }else{
            var sum = parseInt(count/15)+1;
        }

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
    //接单
    function orderTaking(id,status){
        if(status == 1){
            layer.msg('订单未支付，不能接单',{icon:1,time:2000});
            return false;
        }else if(status == 3){
            layer.msg('订单已发货，不能重复接单',{icon:1,time:2000});
            return false;
        }else if(status == 4){
            layer.msg('订单缺货，不能接单',{icon:1,time:2000});
            return false;
        }else if(status == 5){
        	layer.msg('订单已接单，不能重复接单',{icon:1,time:2000});
            return false;
        }
        layer.confirm('确认接单吗？',function(index){
            var params={
                url:'/order/orderTaking',
                data:{'id':id},
                tokenFlag:true,
                type:'post',
                sCallback:function(res) {
                	if(res){
                		 layer.msg('成功接单',{icon:1,time:1000});
                    	window.location.href="javascript:location.replace(location.href)";
                	}else{
                		layer.msg('接单失败',{icon:1,time:1000});
                	}
                   
                },
                eCallback:function(res){
                    layer.msg('发货失败',{icon:1,time:1000});
                }
            };
            window.base.getStorehouseData(params);
        });
    }
    //发货
    function send(id,status){
        if(status == 1){
            layer.msg('订单未支付，不能发货',{icon:1,time:2000});
            return false;
        }else if(status == 3){
            layer.msg('订单已发货，不能重复发货',{icon:1,time:2000});
            return false;
        }else if(status == 4){
            layer.msg('订单缺货，不能发货',{icon:1,time:2000});
            return false;
        }
        layer.confirm('确认发货吗？',function(index){
            var params={
                url:'/order/send',
                data:{'id':id},
                tokenFlag:true,
                type:'post',
                sCallback:function(res) {
                    layer.msg('成功发货',{icon:1,time:1000});
                    window.location.href="javascript:location.replace(location.href)";
                },
                eCallback:function(res){
                    layer.msg('发货失败',{icon:1,time:1000});
                }
            };
            window.base.getStorehouseData(params);
        });
    }
    //获得订单总数
    function getCount(nowPage){
        var params={
            url:'/order/getOrderRemindCount',
            data:{},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                if(!res.status){
                    layer.alert("没有订单");
                }else{
                    setPage(res.count,nowPage);
                }

            },
            eCallback:function(res){
                alert("请求订单数错误");
            }
        };
        window.base.getStorehouseData(params);
    }
</script>
</body>
</html>