<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:90:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/adminUpdateStore.html";i:1575620526;s:79:"/www/server/apache/htdocs/api/public/../application/admin/view/admin/_meta.html";i:1571821518;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
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
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 门店 <span class="c-gray en">&gt;</span> 修改门店 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
    <form action="javascript:;" method="post" class="form form-horizontal" id="form-article-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">账号：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="门店账号" id="username">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">密码：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="门店密码" id="password" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">名字：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="门店名字" id="truename" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属供货仓：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select  class="form-control" id="storehouse">

                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属城市：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select  class="form-control" id="city">

                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">所属推广员：</label>
            <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
                <select  class="form-control" id="eworker">

                </select>
				</span> </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">详细地址：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="详细地址" id="state" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">起送金额：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="起送金额" id="amount" name="">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-2">电话：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="" placeholder="电话" id="phone">
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
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('adminToken')){
        window.location.href = '/yxadmin';
    }
    id=<?php echo $id; ?>;
    $('#id').val(id);
    //alert(id);
    //获得id的商品详情
    getOne();
    function getOne(){
        var params={
            url:'/store/adminGetStoreOne',
            data:{'id':id},
            type:"post",
            tokenFlag:true,
            sCallback:function(res) {
                //填充商品信息
                $('#username').val(res.username);
                $('#password').val(res.password);
                $('#truename').val(res.truename);
                getStorehouse(res.storehouse_id);
                getCity(res.city_id);
                getEworker(res.eworker_id);
                $('#state').val(res.state);
                $('#amount').val(res.amount);
                $('#phone').val(res.phone);

            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getAdminData(params);
    }
    //获得所有供货仓种类
    function getStorehouse(id){
        var params={
            url:'/storehouse/adminGetStorehouse',
            data:{},
            type:'post',
            tokenFlag:true,
            sCallback:function(res) {
                var data = res;
                if (data){
                    var len = data.length,str = '', item;
                    if(len>0) {
                        for (var i = 0; i < len; i++) {
                            item = data[i];
                            if(id == item.id){
                                str += '<option value="' + item.id + '" selected>' + item.truename + '</option>';
                            }else{
                                str += '<option value="' + item.id + '">' + item.truename + '</option>';
                            }

                        }
                    }
                    $('#storehouse').html(str);
                }
            },
            eCallback:function(res){
                alert('获得失败');
            }
        };
        window.base.getAdminData(params);
    }
    //获得所有城市种类
    function getCity(id){
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
                                if(id == item.id){
                                    str += '<option value="' + item.id + '" selected>' + item.name + '</option>';
                                }else{
                                    str += '<option value="' + item.id + '">' + item.name + '</option>';
                                }

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
    //获得所有推广员
    function getEworker(id){
        var params={
            url:'/eworker/adminGetEworker',
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
                                if(id == item.id){
                                    str += '<option value="' + item.id + '" selected>' + item.truename + '</option>';
                                }else{
                                    str += '<option value="' + item.id + '">' + item.truename + '</option>';
                                }

                            }
                        }
                        $('#eworker').html(str);
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

    //提交修改信息
    $('.sub').click(function(){
        var params={
            url:'/store/adminUpdateStore',
            data:{
                'id':id,
                'username':$('#username').val(),
                'password':$('#password').val(),
                'truename':$('#truename').val(),
                'storehouse':$('#storehouse').val(),
                'city':$('#city').val(),
                'eworker':$('#eworker').val(),
                'state':$('#state').val(),
                'amount':$('#amount').val(),
                'phone':$('#phone').val()
            },
            tokenFlag:true,
            type:'post',
            sCallback:function(res) {
                if(res){
                    layer.alert("修改成功");
                }else {
                    layer.alert("修改失败");
                }
            },
            eCallback:function(res){
                alert('请求错误');
            }
        };
        window.base.getAdminData(params);
    })
</script>
</body>
</html>