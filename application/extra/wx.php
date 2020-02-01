<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 20:06
 */
return[
    //小程序IDwxebd0e8f24dde2c38
    'app_id'=>'wxd0eb1627548a8ca8',
    //小程序密钥
    'app_secret'=>'50a89ee9519a73ff53ba082e5311e865',
    //微信使用code换取用户openid及session_key的url地址
    'login_url'=>'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',

    // 微信获取access_token的url地址
    'access_token_url' => "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s"
];