<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/index.html";i:1575621454;s:80:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_meta.html";i:1571404302;s:86:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/_header.html";i:1575807879;s:84:"/www/server/apache/htdocs/api/public/../application/admin/view/storehouse/_menu.html";i:1579416513;s:82:"/www/server/apache/htdocs/api/public/../application/admin/view/public/_footer.html";i:1571402714;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
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
</head>
<body>
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">雅性商城管理后台</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs"></span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<li>仓库:</li>
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A name">admin <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a class="out">退出</a></li>
						</ul>
					</li>
					
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<script src="__STATIC__/js/common.js"></script>
<script src="__STATIC__/js/jquery-3.4.1.min.js"></script>
<script>
	//alert(window.base.getLocalStorage('storehouseToken'));
    var params={
        url:'/storehouse/storehouseGetName',
        data:{},
		type:"POST",
        tokenFlag:true,
        sCallback:function(res) {
            //alert(res.truename);
			$(".name").html(res.truename);
        },
        eCallback:function(res){
            alert('获得失败');
        }
    };
    window.base.getStorehouseData(params);
</script>

<aside class="Hui-aside">
	<div class="menu_dropdown bk_2">
		<dl>
					<dt><i class="Hui-iconfont">&#xe616;</i> 文章管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
							<li><a data-href="/storehouse/articleAdd" data-title="添加文章" href="javascript:void(0)">添加文章</a></li>
						</ul>
						<ul>
							<li><a data-href="/storehouse/articleAll" data-title="全部文章" href="javascript:void(0)">全部文章</a></li>
						</ul>
					</dd>
				</dl>
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="/storehouse/productAdd" data-title="添加商品" href="javascript:void(0)">添加商品</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/productAll" data-title="全部商品" href="javascript:void(0)">全部商品</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/productNo" data-title="售罄商品" href="javascript:void(0)">售罄商品</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/productHot" data-title="热销商品" href="javascript:void(0)">热销商品</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/productDead" data-title="滞销商品" href="javascript:void(0)">滞销商品</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> 订单管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="/storehouse/orderAll" data-title="查看订单" href="javascript:void(0)">查看订单</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/orderRemind" data-title="提醒订单" href="javascript:void(0)">提醒订单</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> 门店管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="/storehouse/storeAll" data-title="查看门店" href="javascript:void(0)">查看门店</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/storeOpenOrClose" data-title="开关店铺" href="javascript:void(0)">开关店铺</a></li>
				</ul>
			</dd>
		</dl>
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> 销售记录<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="/storehouse/payOrder" data-title="查看门店" href="javascript:void(0)">查看销售记录</a></li>
				</ul>
			
			</dd>
		</dl>
		<dl>
			<dt><i class="Hui-iconfont">&#xe616;</i> 仓库设置<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a data-href="/storehouse/info" data-title="查看信息" href="javascript:void(0)">查看信息</a></li>
				</ul>
				<ul>
					<li><a data-href="/storehouse/updateTime" data-title="营业时间" href="javascript:void(0)">修改营业时间</a></li>
				</ul>
			</dd>
		</dl>

	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<audio id="mp3" src="__STATIC__/mp3/remind.mp3"> </audio>
<script src="__STATIC__/js/common.js"></script>
<script src="__STATIC__/js/jquery-3.4.1.min.js"></script>
<script>
    //setInterval("order()",10000000);//每59秒刷新查询一次
    setInterval(function () {
        var params={
            url:'/order/remind',
            data:{},
            tokenFlag:true,
            type:'post',
            sCallback:function(data) {
                if(data){
                    var mp3 = $("#mp3")[0]; //播放提示音
                    mp3.play();
                    layer.alert('有新订单!!!');
                    // setTimeout(function(){
                    //     window.location.reload();
                    // }, 3000);
                }
            },
            eCallback:function(res){
                alert(res);
            }
        };
        window.base.getStorehouseData(params);
    },60000)
</script>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active">
                    <span title="我的桌面" data-href="welcome.html">我的桌面</span>
                    <em></em>
                </li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="/welcome"></iframe>
        </div>
    </div>
</section>

<div class="contextMenu" id="Huiadminmenu">
    <ul>
        <li id="closethis">关闭当前 </li>
        <li id="closeall">关闭全部 </li>
    </ul>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/hadmin/static/h-ui.admin/js/H-ui.admin.js"></script>
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/hadmin/lib/jquery.contextmenu/jquery.contextmenu.r2.js"></script>
<script src="__STATIC__/js/common.js"></script>
<script type="text/javascript">
    //是否获取token令牌，如果没有获取，就要返回登陆界面
    if(!window.base.getLocalStorage('storehouseToken')){
        window.location.href = '/yxstorehouse';
    }

    /*退出,删除token缓存*/
    $('.out').click(function(){
        alert("退出");
        window.base.deleteLocalStorage('storehouseToken');
        window.location.href = '/yxstorehouse';
    });
</script>
</body>
</html>