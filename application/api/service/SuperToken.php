<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/10
 * Time: 11:32
 */

namespace app\api\service;

use app\api\model\Super as SuperModel;
use app\lib\enum\ScopeEnum;

class SuperToken extends Token
{
    //超级管理员获得token
    public function get($name,$pass){
        $app = SuperModel::check($name,$pass);
        if(!$app){
            return false;
        }else{
            //供货仓等级
            $scope = ScopeEnum::super;
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