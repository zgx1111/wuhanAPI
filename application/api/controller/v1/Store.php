<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/11/6
 * Time: 15:55
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\Token as TokenServer;
use app\api\model\Store as StoreModel;
use app\api\validate\IDMustBePostivelnt;
use app\lib\enum\ScopeEnum;

class Store extends BaseController
{
	 //微信端门店通过store获得门店名字
    public function wxGetStoreName(){
        (new IDMustBePostivelnt())->goCheck();
        $store_id = input('post.id');
        $re = StoreModel::get($store_id);
        if($re){
            return [
                'status'=>true,
                'name'=>$re->truename
            ];
        }
        return [
            'status'=>false,
            'name'=>null
        ];
    }
    //门店获得自己的名字
    public function storeGetName(){
        $uid = TokenServer::getCurrentUid();
        $re = StoreModel::get($uid);
        return $re;

    }
    //获得所有门店
    public function getStoreByStorehouseID($page){
//      //获得供货仓id
        $uid = TokenServer::getCurrentUid();
        $re = StoreModel::getOrderByStorehouseID($uid,$page);
        if($re->isEmpty()){
            return 0;
        }
        return $re;
    }
    //获得门店数量
    public function getStoreCount(){
        //获得供货仓id
        $uid = TokenServer::getCurrentUid();
        $re = StoreModel::getStoreCountByStorehouseID($uid);
        if($re==0){
            throw new Exception('获取门店错误');
        }
        return $re;
    }
    //供货仓开关门店
    public function state($id,$state){
        (new IDMustBePostivelnt())->goCheck();
        $store = StoreModel::find($id);
        $store->save([
            'state'=>$state
        ]);
        return $store->state;
    }
    //设置门店起送金额
    public function amount($id,$amount){

        $store = new StoreModel();
        $re=$store->save(['amount'=>$amount],['id'=>$id]);
        return $re;
    }

    //微信端获得门店起送金额
    public function getAmount($store){
        //获得门店的id
        if($store){
            $store = StoreModel::where('id',$store)
                ->find();
            return ['store'=>$store->amount];
        }else{
            return '门店信息为空';
        }


    }
    //获得门店详细信息
    public function info(){
        //获得门店id
        $uid = TokenServer::getCurrentUid();
        $store = StoreModel::with(['storehouse','eworker'])
            ->where('id',$uid)
            ->find();
        return $store;
    }
    //获得门店销售数据
    public function payOrder(){

    }
    //登陆
    public function login($username,$password){
        $token = self::getAppToken($username,$password,ScopeEnum::store);
        return [
            'status'=>1,
            'token'=>$token
        ];
    }
    //管理员获得推广员名下的门店
    public function getStoreByEworkerId($page,$id){
        $page=($page-1) * 15;
        $re = StoreModel::with('city')
            ->where('eworker_id',$id)
            ->limit($page,15)
            ->select();
         return $re;
    }
    //管理员获得推广员名下门店总数
    public function getCountByEworkerID($id){
        $list = StoreModel::where('eworker_id',$id)
            ->select();
        return count($list);
    }
    //管理员获得所有门店
    public function adminGetStoreAll($page){
        $page=($page-1) * 15;
        $re = StoreModel::with(['city','storehouse','eworker'])
            ->limit($page,15)
            ->select();
        return $re;
    }
    //管理员获得门店总数
    public function adminGetStoreCount(){
        $list = StoreModel::select();
        return count($list);
    }
    //管理员获得一个门店的信息
    public function adminGetStoreOne($id){
        $re = StoreModel::get($id);
        return $re;
    }
    //管理员修改门店
    public function adminUpdateStore($id,$username,$password,$truename,$storehouse,$city,$eworker,$state,$amount,$phone){
        $store = new StoreModel();
        $re = $store->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'storehouse_id'=>$storehouse,
            'city_id'=>$city,
            'eworker_id'=>$eworker,
            'state'=>$state,
            'amount'=>$amount,
            'phone'=>$phone,
        ],['id'=>$id]);
        return $re;
    }
    //管理员删除门店
    public function adminDelStore($id){
        $store = new StoreModel();
        return $store->destroy($id);
    }
    //管理员添加门店
    public function adminAddStore($username,$password,$truename,$storehouse,$city,$eworker,$address,$amount,$phone){
        $store = new StoreModel();
        $re = $store->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'storehouse_id'=>$storehouse,
            'city_id'=>$city,
            'eworker_id'=>$eworker,
            'address'=>$address,
            'amount'=>$amount,
            'phone'=>$phone,
        ]);
        return $re;
    }
    //推广员查看名下门店
    public function getEworkerStore($page){
        $page=($page-1) * 15;
        //获得推广员id
        $uid = TokenServer::getCurrentUid();
        $re = StoreModel::with(['city','storehouse'])
            ->where('eworker_id',$uid)
            ->limit($page,15)
            ->select();
        if($re->isEmpty()){
            return 0;
        }
        return $re;
    }
    //推广员获得名下门店总数
    public function getEworkerStoreCount(){
        //获得推广员id
        $uid = TokenServer::getCurrentUid();
        $re = StoreModel::where('eworker_id',$uid)
            ->select();
        return count($re);
    }

    //管理员根据供货仓id获得门店
    public function adminGetStoreByStorehouseID($storehouseID){
        $re = StoreModel::where('storehouse_id',$storehouseID)
            ->select();
        return $re;
    }

    //管理员根据城市id获得门店
    public function adminGetStoreByCityID($id){
        (new IDMustBePostivelnt())->goCheck();
        $re = StoreModel::where('city_id',$id)
            ->select();
        return $re;
    }

}