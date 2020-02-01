<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/10/25
 * Time: 17:32
 */

namespace app\api\model;


use traits\model\SoftDelete;

class City extends BaseModel
{

    use SoftDelete;
    protected $autoWriteTimestamp = true;
    public function shop(){
        return $this->hasMany('store','city_id','id');
    }
    //获取所有的城市和门店
    public static function getCity(){
        return self::with(['shop'])->select();
    }

}