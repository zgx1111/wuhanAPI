<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//version是等待传入的版本号

//微信端获得门店信息
Route::post('api/:version/store/wxGetStoreName','api/:version.Store/wxGetStoreName');

//获得轮播图列表
Route::get('api/:version/banner/:id','api/:version.Banner/getBanner');

//Route::get('api/:version/theme','api/:version.Theme/getSimpleList');
//Route::get('api/:version/theme/:id','api/:version.Theme/getComplexOne');
//查看是否在营业时间
Route::get('api/:version/storehouse/isTime','api/:version.Storehouse/isTime');

//获得产品详细信息
Route::get('api/:version/product/:id','api/:version.Product/getOne',[],['id'=>'\d+']);
//获得最近新品
Route::get('api/:version/product/recent','api/:version.Product/getRecent');
//获得分类商品，价格正序getCateProPriceAsc
Route::get('api/:version/product/getCateProPriceAsc','api/:version.Product/getCateProPriceAsc');
//微信获得热点商品
Route::get('api/:version/product/WxGetHotPro','api/:version.Product/WxGetHotPro');
//获得分类商品
Route::get('api/:version/product/byCategory','api/:version.Product/getAllCategory');
//获得分类商品
Route::get('api/:version/product/search','api/:version.Product/search');

//获得分类商品，价格正序
Route::get('api/:version/product/getCateProPriceAsc','api/:version.Product/getCateProPriceAsc');
//获得分类商品，价格倒序
Route::get('api/:version/product/getCateProPriceDesc','api/:version.Product/getCateProPriceDesc');
//获得分类商品，销量正序
Route::get('api/:version/product/getCateProSalesAsc','api/:version.Product/getCateProSalesAsc');
//获得分类商品，销量倒序
Route::get('api/:version/product/getCateProSalesDesc','api/:version.Product/getCateProSalesDesc');

Route::get('api/:version/category/all','api/:version.Category/getAllCategories');
//获得首页8个分类
Route::get('api/:version/category/home','api/:version.Category/getHomeCategories');
Route::get('api/:version/category/one','api/:version.Category/getCategories');

//微信端获得token
Route::post('api/:version/token/user','api/:version.Token/getToken');
//检验token令牌是否过期
Route::post('api/:version/token/verify','api/:version.Token/verifyToken');
//管理员获得token令牌
Route::post('api/:version/token/app','api/:version.Token/getAppToken');

//关于地址的管理
//创建或者更新地址
Route::post('api/:version/address','api/:version.Address/createOrUpdateAddress');
//获得用户地址
Route::get('api/:version/address','api/:version.Address/getUserAddress');

//获得所有城市和门店
Route::get('api/:version/shop','api/:version.Address/getCity');

//微信端订单处理
Route::post('api/:version/order','api/:version.Order/placeOrder');
Route::get('api/:version/order/:id','api/:version.Order/getDetail',[],['id'=>'\d+']);
Route::get('api/:version/order/by_user','api/:version.Order/getSummaryByUser');

Route::put('api/:version/order/delivery','api/:version.Order/delivery');

//支付订单
//用户支付接口
Route::post('api/:version/pay/pre_order','api/:version.Pay/getProOrder');
Route::post('api/:version/pay/notify','api/:version.Pay/receiveNotify');
Route::post('api/:version/pay/re_notify','api/:version.Pay/receiveNotify');


//门店登陆地址
Route::get('/','admin/Login/store');
//供货仓登陆地址
Route::get('yxstorehouse','admin/Login/storehouse');
//推广员登陆地址
Route::get('yxworker','admin/Login/eworker');
//管理员登陆地址
Route::get('yxadmin','admin/Login/admin');
//推广员登陆地址
Route::get('yxeworker','admin/Login/eworker');
//超级管理员登陆地址
Route::get("yxsuper","admin/Login/super");

//超级管理页面路由
Route::get('super/index','admin/Super/index');
//超级管理员查看所有管理员
Route::get('super/superSelAdmin','admin/Super/superSelAdmin');
//超级管理员添加管理员
Route::get('super/superAddAdmin','admin/Super/superAddAdmin');
//超级管理员修改管理员
Route::get('super/superUpdateAdmin','admin/Super/superUpdateAdmin');



//门店页面路由
Route::get('store/index','admin/Store/index');
Route::get('store/productAll','admin/Store/productAll');
Route::get('store/info','admin/Store/info');
Route::get('store/payOrder','admin/Store/payOrder');

//推广员页面路由
Route::get('eworker/index','admin/Eworker/index');
Route::get('eworker/eworkerStoreAll','admin/Eworker/eworkerStoreAll');
Route::get('eworker/info','admin/Eworker/info');
Route::get('eworker/eworkerGetStoreOrder','admin/Eworker/eworkerGetStoreOrder');
Route::get('eworker/payOrder','admin/Eworker/payOrder');


//管理员页面路由
Route::get('admin/index','admin/Admin/index');
Route::get('admin/cateAll','admin/Admin/cateAll');
Route::get('admin/addCate','admin/Admin/addCate');
Route::get('admin/productAll','admin/Admin/productAll');
Route::get('admin/info','admin/Admin/info');
Route::get('admin/banner','admin/Admin/banner');
Route::get('admin/adminGetWorkerAll','admin/Admin/adminGetWorkerAll');
Route::get('admin/selStore','admin/Admin/selStore');
Route::get('admin/adminGetEworkerOrder','admin/Admin/adminGetEworkerOrder');
Route::get('admin/addEworker','admin/Admin/addEworker');
Route::get('admin/adminGetStoreAll','admin/Admin/adminGetStoreAll');
Route::get('admin/adminGetStoreOrder','admin/Admin/adminGetStoreOrder');
Route::get('admin/adminUpdateStore','admin/Admin/adminUpdateStore');
Route::get('admin/adminAddStore','admin/Admin/adminAddStore');
Route::get('admin/adminGetStorehouseAll','admin/Admin/adminGetStorehouseAll');
Route::get('admin/adminGetStorehouseAll','admin/Admin/adminGetStorehouseAll');
Route::get('admin/adminGetStorehouseOrder','admin/Admin/adminGetStorehouseOrder');
Route::get('admin/adminUpdateStorehouse','admin/Admin/adminUpdateStorehouse');
Route::get('admin/adminAddStorehouse','admin/Admin/adminAddStorehouse');
Route::get('admin/info','admin/Admin/info');
Route::get('admin/getCityAll','admin/Admin/getCityAll');
Route::get('admin/addCity','admin/Admin/addCity');
Route::get('admin/payOrder','admin/Admin/payOrder');
Route::get('admin/cityOrder','admin/Admin/cityOrder');
Route::get('admin/storehouseOrder','admin/Admin/storehouseOrder');
Route::get('admin/eworkerOrder','admin/Admin/eworkerOrder');
Route::get('admin/storeOrder','admin/Admin/storeOrder');

//供货仓页面路由
Route::get('welcome','admin/Index/welcome');
Route::get('storehouse/index','admin/Storehouse/index');
Route::get('storehouse/productAll','admin/Storehouse/productAll');
Route::get('storehouse/productUpdate','admin/Storehouse/productUpdate');
Route::get('storehouse/productAdd','admin/Storehouse/productAdd');
Route::get('storehouse/productUpload','admin/Storehouse/productUpload');
Route::get('storehouse/orderAll','admin/Storehouse/orderAll');
Route::get('storehouse/orderRemind','admin/Storehouse/orderRemind');
Route::get('storehouse/storeAll','admin/Storehouse/storeAll');
Route::get('storehouse/storehouseGetStoreOrder','admin/Storehouse/storehouseGetStoreOrder');
Route::get('storehouse/payOrder','admin/Storehouse/payOrder');
Route::get('storehouse/productNo','admin/Storehouse/productNo');
Route::get('storehouse/productHot','admin/Storehouse/productHot');
Route::get('storehouse/productDead','admin/Storehouse/productDead');
Route::get('storehouse/info','admin/Storehouse/info');
Route::get('storehouse/storeOpenOrClose','admin/Storehouse/storeOpenOrClose');
Route::get('storehouse/updateTime','admin/Storehouse/updateTime');
Route::get('storehouse/articleAdd','admin/Storehouse/articleAdd');
Route::get('storehouse/articleAll','admin/Storehouse/articleAll');
Route::get('storehouse/artUpdate','admin/Storehouse/artUpdate');
// Route::get('storehouse/getExcel','admin/Storehouse/getExcel');

//超级管理员登陆
Route::post('api/:version/super','api/:version.Super/login');
Route::post('api/:version/super/info','api/:version.Super/info');
Route::post('api/:version/admin/addOrUpdateAdmin','api/:version.Admin/addOrUpdateAdmin');
Route::post('api/:version/admin/superSelAdmin','api/:version.Admin/superSelAdmin');
Route::post('api/:version/admin/superSelAdminCount','api/:version.Admin/superSelAdminCount');
Route::post('api/:version/admin/superDelAdmin','api/:version.Admin/superDelAdmin');
Route::post('api/:version/admin/superGetAdminOne','api/:version.Admin/superGetAdminOne');


//供货仓登陆
Route::post('api/:version/storehouse','api/:version.Storehouse/login');
//供货仓获得自己的信息
Route::post('api/:version/storehouse/storehouseGetName','api/:version.Storehouse/storehouseGetName');
//供货仓设置自己的营业时间
Route::post('api/:version/storehouse/storehouseUpdateTime','api/:version.Storehouse/storehouseUpdateTime');

//供货仓关于商品的处理
Route::post('api/:version/product/storehouseGetCategoryProduct','api/:version.Product/getCategoryProductByStorehouseID');
Route::post('api/:version/product/getCategoryProCount','api/:version.Product/getCategoryProCount');
Route::post('api/:version/product/storehouseGetProductNo','api/:version.Product/storehouseGetProductNo');
Route::post('api/:version/product/storehousegetProNoCount','api/:version.Product/storehousegetProNoCount');
Route::post('api/:version/product/storehouseGetProductHot','api/:version.Product/storehouseGetProductHot');
Route::post('api/:version/product/storehousegetProHotCount','api/:version.Product/storehousegetProHotCount');
Route::post('api/:version/product/del','api/:version.Product/delProduct');
Route::post('api/:version/product/update','api/:version.Product/updateProduct');
Route::post('api/:version/product/add','api/:version.Product/addProduct');
Route::post('api/:version/product/addImgs','api/:version.Product/addImgs');
Route::post('api/:version/product/getImgIdUrl','api/:version.Product/getImgIdUrl');
Route::post('api/:version/product/delMainImg','api/:version.Product/delMainImg');
//修改时删除副图片，删除image和 product_img表数据
Route::post('api/:version/product/delSImg','api/:version.Product/delSImg');
//修改时增加主图片，因为这时已经知道了商品id，所以增加图片的时候就要村image和product_main_img表数据
Route::post('api/:version/product/uploadMainImg','api/:version.Product/uploadMainImg');
//修改时增加副图片，因为知道了商品id，所以增加图片的时候就要存image和product_img表数据
Route::post('api/:version/product/uploadSImg','api/:version.Product/uploadSImg');
//在增加商品时删除图片，只需要删除image一个表
Route::post('api/:version/product/delMainImgA','api/:version.Product/delMainImgA');


//供货仓关于订单的处理
Route::post('api/:version/order/getOrder','api/:version.Order/getOrderAllByStorehouseID');
Route::post('api/:version/order/getOrderCount','api/:version.Order/getOrderAllCount');
Route::post('api/:version/order/getOrderRemind','api/:version.Order/getOrderRemind');
Route::post('api/:version/order/getOrderRemindCount','api/:version.Order/getOrderRemindCount');
Route::post('api/:version/order/send','api/:version.Order/send');
Route::post('api/:version/order/remind','api/:version.Order/remind'); //供货仓订单提醒
Route::post('api/:version/order/getOrderByStorehouseID','api/:version.Order/getOrderByStorehouseID');
Route::post('api/:version/order/getOrderCountByStorehouseID','api/:version.Order/getOrderCountByStorehouseID');
Route::post('api/:version/order/orderTaking','api/:version.Order/orderTaking');//接单
Route::post('api/:version/order/getExcel','api/:version.Order/getExcel');//导出Excel表格


//供货仓对于门店的管理
Route::post('api/:version/store/storehouseGetStore','api/:version.Store/getStoreByStorehouseID'); //供货仓查看门店
Route::post('api/:version/store/getCount','api/:version.Store/getStoreCount'); //供货仓查看门店数量
Route::post('api/:version/store/amount','api/:version.Store/amount'); //设置门店起送金额
Route::post('api/:version/store/getAmount','api/:version.Store/getAmount'); //微信端获得门店起送金额
Route::post('api/:version/store/state','api/:version.Store/state');//供货仓开关店面
Route::post('api/:version/store/storeTime','api/:version.Store/storeTime');//供货仓设置门店营业时间


//供货仓关于文章的处理
Route::post('api/:version/article/artAdd','api/:version.Article/artAdd');//供货仓添加文章
Route::get('api/:version/article/artGetAll','api/:version.Article/artGetAll');//获得全部文章
Route::get('api/:version/article/:id','api/:version.Article/artGetOne',[],['id'=>'\d+']);//获得文章详情
Route::get('api/:version/article/artGetCount','api/:version.Article/artGetCount');//获得文章总数artDelete
Route::post('api/:version/article/artDelete','api/:version.Article/artDelete');//删除文章
Route::post('api/:version/article/artUpdate','api/:version.Article/artUpdate');//修改文章commentAdd
Route::post('api/:version/comment/commentAdd','api/:version.Comment/commentAdd');//增加文章评论




//store登陆
Route::post('api/:version/store','api/:version.Store/login');
//store获得自己名字
Route::post('api/:version/store/storeGetName','api/:version.Store/storeGetName');
//store查看全部商品的路由
Route::post('api/:version/product/getproductsByStoreID','api/:version.Product/getProductsByStoreID');
//store获得商品数量的路由
Route::post('api/:version/product/getProductCountByStoreID','api/:version.Product/getProductCountByStoreID');
//store获得订单
Route::post('api/:version/order/getOrderByStoreID','api/:version.Order/getOrderByStoreID');
//store获得订单总数
Route::post('api/:version/order/getOrderCountByStoreID','api/:version.Order/getOrderCountByStoreID');
//store获得自己信息
Route::post('api/:version/store/info','api/:version.Store/info');

//推广员登陆
Route::post('api/:version/eworker','api/:version.Eworker/login');
//推广员查看门店
Route::post('api/:version/store/getEworkerStore','api/:version.Store/getEworkerStore');
//推广员查看门店数量
Route::post('api/:version/store/getEworkerStoreCount','api/:version.Store/getEworkerStoreCount');
//推广员获得个人信息
Route::post('api/:version/eworker/info','api/:version.Eworker/info');
//推广员,供货仓获得门店订单order
Route::post('api/:version/order/GetStoreOrder','api/:version.Order/GetStoreOrder');
//推广员，供货仓获得门店订单总数
Route::post('api/:version/order/GetStoreOrderCount','api/:version.Order/GetStoreOrderCount');
//推广员获得自己的业绩
Route::post('api/:version/order/getOrderByEworkerID','api/:version.Order/getOrderByEworkerID');
//推广员获得自己的订单数和金额
Route::post('api/:version/order/getOrderCountByEworkerID','api/:version.Order/getOrderCountByEworkerID');
//推广员获得自己的名字
Route::post('api/:version/eworker/eworkerGetName','api/:version.Eworker/eworkerGetName');

//管理员登陆
Route::post('api/:version/admin','api/:version.Admin/login');
//管理员获得自己名字
Route::post('api/:version/admin/adminGetName','api/:version.Admin/adminGetName');
//管理员获得所有商品
Route::post('api/:version/product/adminGetProducts','api/:version.Product/adminGetProducts');
//admin获得商品总数
Route::post('api/:version/product/adminGetCount','api/:version.Product/adminGetCount');
//admin获得商品分类
Route::post('api/:version/category/adminGetCate','api/:version.Category/adminGetCate');
//admin修改商品分类
Route::post('api/:version/category/adminUpdateCategory','api/:version.Category/adminUpdateCategory');
//admin删除商品分类
Route::post('api/:version/category/adminDeleteCategory','api/:version.Category/adminDeleteCategory');
//admin修改分类图片
Route::post('api/:version/category/updateImg','api/:version.Category/updateImg');
//admin添加分类
Route::post('api/:version/category/addCate','api/:version.Category/addCate');
//admin获得全部订单
Route::post('api/:version/order/adminGetOrderAll','api/:version.Order/adminGetOrderAll');
//admin获得订单总数
Route::post('api/:version/order/adminGetOrderCount','api/:version.Order/adminGetOrderCount');
//admin获得幻灯片
Route::post('api/:version/banner/adminGetBanner','api/:version.Banner/adminGetBanner');
//admin修改幻灯片
Route::post('api/:version/banner/updateImg','api/:version.Banner/updateImg');

//admin查看城市city/adminGetCityAll
Route::post('api/:version/city/adminGetCityAll','api/:version.City/adminGetCityAll');
//admin查看城市总数
Route::post('api/:version/city/adminGetCityCount','api/:version.City/adminGetCityCount');
//admin添加城市
Route::post('api/:version/city/adminAddCity','api/:version.City/adminAddCity');
//admin删除城市
Route::post('api/:version/city/adminDelCity','api/:version.City/adminDelCity');
//admin获得所有城市（不分页）
Route::post('api/:version/city/adminGetCity','api/:version.City/adminGetCity');
//admin获得城市数据adminGetCityOrder
Route::post('api/:version/order/adminGetCityOrder','api/:version.Order/adminGetCityOrder');
//admin获得城市订单count
Route::post('api/:version/order/adminGetCityOrderCount','api/:version.Order/adminGetCityOrderCount');
//admin查看推广员（分页）
Route::post('api/:version/eworker/adminGetEworkerAll','api/:version.Eworker/adminGetEworkerAll');
//admin获得所有推广员（不分页）
Route::post('api/:version/eworker/adminGetEworker','api/:version.Eworker/adminGetEworker');
//admin查看推广员总数
Route::post('api/:version/eworker/adminGetEworkerCount','api/:version.Eworker/adminGetEworkerCount');
//admin查看推广员名下的门店
Route::post('api/:version/store/getStoreByEworkerId','api/:version.Store/getStoreByEworkerId');
//admin获得推广员名下门店总数
Route::post('api/:version/store/getCountByEworkerID','api/:version.Store/getCountByEworkerID');
//admin查看推广员销售记录
Route::post('api/:version/order/adminGetEworkerOrder','api/:version.Order/adminGetEworkerOrder');
//admin获得推广员的订单数量和金额
Route::post('api/:version/order/adminGetEworkerOrderCount','api/:version.Order/adminGetEworkerOrderCount');
//admin添加推广员
Route::post('api/:version/eworker/adminAddEworker','api/:version.Eworker/adminAddEworker');
//admin删除推广员
Route::post('api/:version/eworker/adminDelEworker','api/:version.Eworker/adminDelEworker');
//admimn查看门店
Route::post('api/:version/store/adminGetStoreAll','api/:version.Store/adminGetStoreAll');
//admin获得门店数量
Route::post('api/:version/store/adminGetStoreCount','api/:version.Store/adminGetStoreCount');
//admin获得门店的订单
Route::post('api/:version/order/adminGetStoreOrder','api/:version.Order/adminGetStoreOrder');
//admin获得门店订单数量
Route::post('api/:version/order/adminGetStoreOrderCount','api/:version.Order/adminGetStoreOrderCount');
//admin获得一个门店的信息
Route::post('api/:version/store/adminGetStoreOne','api/:version.Store/adminGetStoreOne');
//admin获得所有供货仓(不分页)
Route::post('api/:version/storehouse/adminGetStorehouse','api/:version.Storehouse/adminGetStorehouse');
//admin根据城市id获得所有供货仓
Route::post('api/:version/storehouse/adminGetStorehouseByCityID','api/:version.Storehouse/adminGetStorehouseByCityID');
//admin根据供货仓id获得门店
Route::post('api/:version/store/adminGetStoreByStorehouseID','api/:version.Store/adminGetStoreByStorehouseID');

//admin修改门店
Route::post('api/:version/store/adminUpdateStore','api/:version.Store/adminUpdateStore');
//admin删除门店
Route::post('api/:version/store/adminDelStore','api/:version.Store/adminDelStore');
//admin添加门店
Route::post('api/:version/store/adminAddStore','api/:version.Store/adminAddStore');
//admin获得所有供货仓
Route::post('api/:version/storehouse/adminGetStorehouseAll','api/:version.Storehouse/adminGetStorehouseAll');
//admin获得供货仓数量
Route::post('api/:version/storehouse/adminGetStorehouseCount','api/:version.Storehouse/adminGetStorehouseCount');
//admin获得供货仓订单
Route::post('api/:version/order/adminGetStorehouseOrder','api/:version.Order/adminGetStorehouseOrder');
//admin获得供货仓订单数
Route::post('api/:version/order/adminGetStorehouseOrderCount','api/:version.Order/adminGetStorehouseOrderCount');
//admin获得供货仓详情
Route::post('api/:version/storehouse/adminGetStorehouseOne','api/:version.Storehouse/adminGetStorehouseOne');
//admin修改供货仓详情
Route::post('api/:version/storehouse/adminUpdateStorehouse','api/:version.Storehouse/adminUpdateStorehouse');
//admin删除门店
Route::post('api/:version/storehouse/adminDelStorehouse','api/:version.Storehouse/adminDelStorehouse');
//admin添加供货仓
Route::post('api/:version/storehouse/adminAddStorehouse','api/:version.Storehouse/adminAddStorehouse');
//admin个人信息
Route::post('api/:version/admin/info','api/:version.Admin/info');
//admin获得城市所属门店
Route::post('api/:version/store/adminGetStoreByCityID','api/:version.Store/adminGetStoreByCityID');





