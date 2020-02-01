<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/10/25
 * Time: 17:56
 */

namespace app\api\model;
use traits\model\SoftDelete;

class Store extends BaseModel
{
    //开启软删除
    use SoftDelete;
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    //关联eworker
    public function eworker(){
        return $this->belongsTo('eworker','eworker_id','id');
    }
    //关联城市
    public function city(){
        return $this->belongsTo('city','city_id','id');
    }
    //获得供货仓门店数量
    public static function getStoreCountByStorehouseID($id){
        $list = self::where('storehouse_id','=',$id)
            ->select();
        return count($list);
    }
    //查找供货仓门店
    public static function getOrderByStorehouseID($id,$page){
        $page=($page-1) * 15;
        return self::with(['eworker','city'])
            ->where('storehouse_id','=',$id)
            ->limit($page,15)
            ->select()
            ->hidden(['update_time','password','delete_time']);

    }
    //关联供货仓表
    public function storehouse(){
        return $this->belongsTo('storehouse','storehouse_id','id');
    }



}