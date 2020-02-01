<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/10
 * Time: 22:52
 */

namespace app\api\service;


use app\api\model\Admin as AdminModel;
use app\lib\enum\ScopeEnum;

class AdminToken extends Token
{
    //管理员获得token
    public function get($name,$pass){
        $app = AdminModel::check($name,$pass);
        if(!$app){
            return false;
        }else{
            //供货仓等级
            $scope = ScopeEnum::admin;
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