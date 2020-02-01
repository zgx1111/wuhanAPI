<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/9
 * Time: 0:16
 */

namespace app\api\service;


use app\api\model\Store;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;

class StoreToken extends Token
{
    //门店获得token
    public function get($name,$pass){
        $app = Store::check($name,$pass);
        if(!$app){
            return false;
        }else{
            //供货仓等级
            $scope = ScopeEnum::store;
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