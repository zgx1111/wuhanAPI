<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/4
 * Time: 21:19
 */

namespace app\api\model;


class ThirdApp extends BaseModel
{
    public static function check($name,$pass){
        $app = self::where('app_id','=',$name)
            ->where('app_secret','=',$pass)
            ->find();
        return $app;
    }

}