<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/11/14
 * Time: 14:56
 */

namespace app\api\service;
use app\api\model\Eworker;
use app\lib\enum\ScopeEnum;

class EworkerToken extends Token
{
    //推广员获得token
    public function get($name,$pass){
        $app = Eworker::check($name,$pass);
        if(!$app){
            return false;
        }else{
            //供货仓等级
            $scope = ScopeEnum::eworker;
            $uid = $app->id;
            $value = [
                'scope' => $scope,
                'uid' => $uid
            ];
            //缓存token
            $token = $this->saveToken($value);
            return $token;
        }
    }

}