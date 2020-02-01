<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/10
 * Time: 11:24
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\lib\enum\ScopeEnum;
use app\api\service\Token as TokenService;
class Super extends BaseController
{
    //超级管理员登陆
    public function login($username,$password){
        $token = self::getAppToken($username,$password,ScopeEnum::super);
        if($token){
            return [
                'status'=>1,
                'token'=>$token
            ];
        }
        return [
            'status'=>0,
            'token'=>0
        ];
    }
    //获得个人信息
    public function info(){
        $uid = TokenService::getCurrentUid();
        $super = \app\api\model\Super::get($uid);
        return $super;
    }

}