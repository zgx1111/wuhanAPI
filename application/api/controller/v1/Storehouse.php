<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/6
 * Time: 15:04
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\Image;
use app\lib\enum\ScopeEnum;
use app\api\model\Storehouse as StorehouseModel;
use app\api\service\Token as TokenService;

class Storehouse extends BaseController
{
    //查看是否在营业时间
    public function isTime(){
        $house_id = self::getHouseID();
        $re = self::time($house_id);
        return $re;
    }

    //登陆
    public function login($username,$password){

        $token = $this->getAppToken($username,$password,ScopeEnum::storehouse);
        if(!$token){
            return [
                'status'=>0,
                'token'=>$token
            ];
        }
        return [
            'status'=>1,
            'token'=>$token
        ];
    }
    //获得自己的信息
    public function storehouseGetName(){
        $uid = TokenService::getCurrentUid();

        $re = StorehouseModel::with('city')->find($uid);
        return $re;
    }
    //供货仓修改自己的营业时间
    public function storehouseUpdateTime($beginAt,$endAt){
        //获得自己的uid
        $uid = TokenService::getCurrentUid();
        $storehouse = StorehouseModel::get($uid);
        $storehouse->save([
            'begin_at'=>$beginAt,
            'end_at'=>$endAt
        ]);
        return true;
    }
    //管理员获得所有供货仓
    public function adminGetStorehouse(){
        $re = (new \app\api\model\Storehouse())->select();
        return $re;

    }
    //管理员获得所有供货仓（分页）
    public function adminGetStorehouseAll($page){
        $page=($page-1) * 15;
        $re = StorehouseModel::with('city')
            ->limit($page,15)
            ->select();
        return $re;
    }
    //管理员获得所有供货仓数量
    public function adminGetStorehouseCount(){
        $list = StorehouseModel::select();
        return count($list);
    }
    //管理员获得供货仓详情
    public function adminGetStorehouseOne($id){
        $re = StorehouseModel::get($id);
        return $re;
    }
    //管理员修改供货仓
    public function adminUpdateStorehouse($id,$username,$password,$truename,$city,$adminname,$phone){
        $store = new StorehouseModel();
        $re = $store->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'city_id'=>$city,
            'adminname'=>$adminname,
            'phone'=>$phone,
        ],['id'=>$id]);
        return $re;
    }
    //管理员删除供货仓
    public function adminDelStorehouse($id){
        $storehouse = new StorehouseModel();
        return $storehouse->destroy($id);
    }
    //管理员添加供货仓
    public function adminAddStorehouse($username,$password,$truename,$city,$adminname,$phone){
        $storehouse = new StorehouseModel();
        $re = $storehouse->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'city_id'=>$city,
            'adminname'=>$adminname,
            'phone'=>$phone,
        ]);
        return $re;
    }
    //管理员根据城市id获得所有供货仓
    public function adminGetStorehouseByCityID($cityID){
        $storehouse = new StorehouseModel();
        $re = $storehouse->where('city_id',$cityID)
            ->select();
        return $re;
    }
}