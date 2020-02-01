<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/11
 * Time: 20:29
 */

namespace app\api\model;


use think\Db;
use think\Exception;
use think\Model;

class Banner extends BaseModel
{
    protected $hidden = ['delete_time','update_time'];
    public function items(){
        //一对多的关系用hasMany
        return $this->hasMany('BannerItem','banner_id','id');
    }
    public function getBannerByID($id){

        //模型嵌套关联
        $banner = self::with(['items','items.img'])->find($id);
        return $banner;

    }
}