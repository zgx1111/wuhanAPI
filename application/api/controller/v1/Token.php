<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 19:48
 */

namespace app\api\controller\v1;


use app\api\service\AppToken;
use app\api\service\UserToken;
use app\api\validate\TokenGet;
use app\lib\exception\ParameterException;
use app\api\service\Token as TokenService;

class Token
{
    //微信端获得Token令牌
    //@url = api/:version/Token/user
    public function getToken($code = ''){
        //验证存在且不为空
        (new TokenGet())->goCheck();
        $token = new UserToken($code);
        $re = $token->get();
        //返回数组形式,默认返回json形式
        return [
            'token'=>$re
        ];

    }
    //检验Token令牌是否过期
    public function verifyToken($token=''){
        if(!$token){
            throw new ParameterException([
                'token不存在'
            ]);
        }
        $valid = TokenService::verifyToken($token);
        return [
            'isValid' => $valid
        ];
    }

}