<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/16
 * Time: 16:39
 */

//自定义的配置文件
return [
    //图片url的前缀地址
    //'img_prefix' => 'https://yxadult.xyz/images',
    'img_prefix' => 'http://yxadult.xyz/images',
    //'img_prefix' => 'http://z.cn/images',
    //缓存时间七天
    'token_expire_in' => 3600*24*7
    //订单状态
    //1.未支付、2.已支付、3.已发货 、4.已支付但是库存不足

];