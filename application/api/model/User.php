<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 19:54
 */

namespace app\api\model;


class User extends BaseModel
{
    //关联UserAddress表
    public function address(){
        return $this->hasOne('UserAddress','user_id','id');
    }
    public static function getByOpenID($openid){
        return self::where('openid','=',$openid)
            ->find();
    }
}