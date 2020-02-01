<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/6
 * Time: 15:09
 */

namespace app\api\service;

use app\api\model\Storehouse;
use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;

class StoreHouseToken extends Token
{
    //供货仓获得token
    public function get($name,$pass){
        $app = Storehouse::check($name,$pass);

        if(!$app){
            // throw new TokenException([
            //     'msg' => '授权失败',
            //     'errorCode' => 10004
            // ]);
            return 0;
        }else{
            //供货仓等级
            $scope = ScopeEnum::storehouse;
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