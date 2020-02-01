<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/22
 * Time: 15:50
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\City;
use app\api\model\UserAddress;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use app\api\model\User as UserModel;
use app\lib\exception\UserException;
class Address extends BaseController
{

    //前置方法，在方法前执行函数,检验函数在基类中
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only'=>'createOrUpdateAddress']
    ];
    //获取用户地址
    public function getUserAddress(){
        $uid = TokenService::getCurrentUid();
        $userAddress = UserAddress::where('user_id', $uid)
            ->find();
//        if(!$userAddress){
//            throw new UserException([
//                'msg' => '用户地址不存在',
//                'errorCode' => 60001
//            ]);
//        }
        return $userAddress;

    }

    //添加或者更新地址
    public function createOrUpdateAddress($name,$phone,$store,$address){

        //验证函数
        $validate = new AddressNew();
        $validate->goCheck();

        //通过token令牌来获取uid
        //用uid来查找用户数据，如果不存在抛出异常
        //获取用户从客户端传来的地址信息
        //根据判断用户地址信息是否存在来判断是添加地址还是更新地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new UserException();
        }
//        //过滤获得需要的数据，rule中定义的
//        $dataArray = $validate->getDataByValue(input('post.'));
        //通过关联模型获取地址信息是否存在
        $add = UserAddress::where('user_id',$uid)
            ->find();

        if($add == null){
            //添加地址,返回自增id
            $data = [
                'name'=>$name,
                'phone'=>$phone,
                'store_id'=>$store,
                'address'=>$address,
                'user_id'=>$uid
            ];
            $success = (new UserAddress())->save($data);
            //如果成功，返回地址id
            if($success){
                $id =  UserAddress::where('user_id',$uid)->value('id');
                return [
                    'status'=>true,
                    'addressID'=>$id
                ];
            }
            return [
                'status'=>false,
                'addressID'=>0
            ];
        }else{
            //更新地址,返回条数
            $where = ['user_id'=> $uid];
            $data = [
                'name'=>$name,
                'phone'=>$phone,
                'store_id'=>$store,
                'address'=>$address

            ];
            //用save更新，自动写入时间
            $success = (new UserAddress())->save($data,$where);
            //如果成功，返回地址id
             if($success){
                $id =  UserAddress::where('user_id',$uid)->value('id');
                return [
                    'status'=>true,
                    'addressID'=>$id
                ];
            }
            return [
                'status'=>false,
                'addressID'=>0
            ];
        }
        //return json(new SuccessMessage(),201);
    }

    //获取所有的城市和门店
    public function getCity(){
        $re = City::getCity();
        return $re;
    }

}