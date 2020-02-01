<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:89:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/productAll.html";i:1576488724;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
    <title>商品列表</title>
    <style>
        .img{
            width: 30px;
            height: 30px;
        }
        .page{
            text-align: center;
        }
        .text-c{
            text-align: center;
        }
        .select{
            width: 330px;
            margin-right:10px;
            margin-left:10px;
        }
    </style>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <div class="text-c"> 分类：
        <select name="cate" class="select" id="category"></select>
        <button class="btn btn-success" onclick="getProducts(1)" name=""><i class="Hui-iconfont">&#xe665;</i> 查看商品</button>
    </div>
    <div class="cl pd-5 bg-1 bk-gray mt-20"><span class="r">共有数据：<strong></strong> 条</span> </div>
    <div class="mt-20">
        <table class="table table-border table-bordered table-bg table-hover table-responsive">
            <thead>
            <tr class="text-c">
                <th width="80">ID</th>
                <th width="80">商品名</th>
                <th width="80">成本</th>
                <th width="80">价格</th>
                <th width="80">库存</th>
                <th width="80">分类</th>
                <th width="80">简要描述</th>
                <th width="120">创建时间</th>
                <th width="120">更新时间</th>
                <th  colspan="2">操作</th>
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
    //获得分类商品
    function getProducts(page){
        //默认第一页
        //读取令牌
        // var token = window.base.getLocalStorage('storehouseToken');
        // alert(token);
        cate = $("#category").val();
        var params={
            url:'/product/storehouseGetCategoryProduct',
            data:{'page':page,'cate':cate},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                if(res == 0){
                    layer.msg('无数据');
                }else{
                    //拼接字符串
                    var str = getOrderHtmlStr(res);
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
    function getOrderHtmlStr(res){
        var data = res;
        if (data){
            var len = data.length,str = '', item;
            if(len>0) {
                for (var i = 0; i < len; i++) {
                    item = data[i];
                    str += '<tr class="text-c">' +
                            '<td>' + item.id + '</td>' +
                            '<td>' + item.name + '</td>' +
                            '<td>' + item.cost + '</td>' +
                            '<td>￥' + item.price + '</td>';
                    // if(item.main_imgs == ""){
                    //     str+='<td></td>';
                    // }else{
                    //
                    //     str+='<td><image class="img" src="' + item.main_imgs[0].img_url.url + '"></image></td>';
                    // }
                          str+= '<td>' + item.stock + '</td>' +
                            '<td>' + item.category.name+ '</td>' +
                            '<td>' + item.summary + '</td>' +
                            '<td>' + item.create_time + '</td>' +
                            '<td>' + item.update_time + '</td>' +
                            '<td><button class="btn btn-success" onclick="update(' + item.id +')">编辑</button></td>' +
                            '<td><button class="btn btn-danger" onclick="del(this,' + item.id +')">删除</button></td>' +
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
        str += '<a class="btn btn-default" onclick="getProducts('+last+')">上一页</a>';
        str += '<span class="btn btn-primary radius">'+nowPage+'</span>';
        str += '<a class="btn btn-default" onclick="getProducts('+next+')">下一页</a>';

        $('.page').html(str);
    }
    //获得商品总数
    function getCount(nowPage){
        cate = $("#category").val();
        var params={
            url:'/product/getCategoryProCount',
            data:{'cate':cate},
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                $('strong').html(res);
                setPage(res,nowPage);
            },
            eCallback:function(res){
                alert('获得分类商品数量失败');
            }
        };
        window.base.getStorehouseData(params);
    }
    //修改
    function update(id){
        window.location.href = 'productUpdate?id='+id;
    }
    //删除
    function del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            var params={
                url:'/product/del',
                data:{'ids':id},
                tokenFlag:true,
                type:'post',
                sCallback:function(res) {
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                },
                eCallback:function(res){
                    layer.msg('删除失败!',{icon:1,time:1000});
                }
            };
            window.base.getStorehouseData(params);
        });
    }
    // function upload(id){
    //     window.location.href = 'productUpload?id='+id;
    // }
</script>
</body>
</html>