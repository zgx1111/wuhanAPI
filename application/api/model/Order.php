<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/24
 * Time: 17:38
 */

namespace app\api\model;


class Order extends BaseModel
{
    protected $hidden = ['user_id','delete_time','update_time'];
    //开启自动写入时间
    protected $autoWriteTimestamp = true;
    //自定义自动写入时间的字段
    //protected $createTime = 'createtimesnap';

    //关联供货仓表
    public function storehouse(){
        return $this->belongsTo('storehouse','storehouse_id','id');
    }
    //关联门店表
    public function store(){
        return $this->belongsTo('store','store_id','id');
    }

    //获取器，转换为json对象格式
    public function getSnapItemsAttr($value){
        if(!$value){
            return null;
        }
        return json_decode($value);
    }
    public function getSnapAddressAttr($value){
        if(empty($value)){
            return null;
        }
        return json_decode($value);
    }
    //分页查询
    public static function getSummaryByUser($uid,$page=1,$size=15){

        $page = self::where('user_id','=',$uid)
            ->order('create_time desc')
            ->paginate($size,true,['page'=>$page]);
        //paginate返回是对象
        return $page;

    }
    //查找供货仓订单
    public static function getOrderByStorehouseID($id,$page){
        $page=($page-1) * 15;
        $whereArr['storehouse_id'] = array('eq',$id); // 等于条件
        //$whereArr['status'] = array('eq',2);
        //$whereArr['status'] = array('neq',1); // 不等于条件
        return self::with('store')
            ->where($whereArr)
            ->limit($page,15)
            ->order('create_time desc')
            ->select();
    }

    //获得供货仓订单数量
    public static function getOrderCountByStorehouseID($id){
        $list = self::where('storehouse_id','=',$id)
            ->select();
        return count($list);
    }
    //查找供货仓提醒订单
    public static function getOrderRemindByStorehouseID($id,$page){
        $page=($page-1) * 15;
        $whereArr['storehouse_id'] = array('eq',$id); // 等于条件
        $whereArr['status'] = array('eq',2);
        //$whereArr['status'] = array('neq',1); // 不等于条件
        return self::with('store')
            ->where($whereArr)
            ->limit($page,15)
            ->order('create_time desc')
            ->select();
    }
    //获得供货仓订单提醒数量
    public static function getOrderRemindCountByStorehouseID($id){
        $list = self::where('storehouse_id','=',$id)
            ->where('status',2)
            ->select();
        return count($list);
    }
}