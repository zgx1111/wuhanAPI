<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    //函数剪切url值，让子类的读取器调用
    protected function getUrl($value,$data){
        //value就是图片的url值，拼接配置文件里的地址，然后返回
        //读取自定义配置图片url路径
        $finalUrl = config('setting.img_prefix').$value;

        return $finalUrl;
    }
    //登陆验证账号密码
    public static function check($name,$pass){
        $app = self::where('username','=',$name)
            ->where('password','=',$pass)
            ->find();
        return $app;
    }

}
