<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/10
 * Time: 22:46
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\lib\enum\ScopeEnum;
use app\api\model\Admin as AdminModel;
use app\api\service\Token as TokenService;

class Admin extends BaseController
{
    //管理员登陆
    public function login($username,$password){
        $token = self::getAppToken($username,$password,ScopeEnum::admin);
        return [
            'status'=>1,
            'token'=>$token
        ];
    }

    //获得个人信息
    public function info(){
        //获得管理员id
        $uid = TokenService::getCurrentUid();
        $admin = AdminModel::where('id',$uid)
            ->find();
        return $admin;
    }
    //超级管理员添加或者更新管理员
    public function addOrUpdateAdmin(){
        $id = input('post.id');
        $username = input('post.username');
        $password = input('post.password');
        $truename = input('post.truename');
        $phone = input('post.phone');
        $admin = new AdminModel();
        //更新
        if($id){
            $re = $admin->save([
                'username'=>$username,
                'password'=>$password,
                'truename'=>$truename,
                'phone'=>$phone
            ],['id'=>$id]);
            return $re;
        }
        //添加
        $re = $admin->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'phone'=>$phone,
        ]);
        return $re;
    }
    //获得所有管理员
    public function superSelAdmin(){
        $re = AdminModel::select();
        return $re;
    }
    //获得所有管理员数量
    public function superSelAdminCount(){
        $re = AdminModel::select();
        return count($re);
    }
    //删除管理员
    public function superDelAdmin($id){
        $re = AdminModel::where('id',$id)
            ->delete();
        return $re;
    }
    //获得一个管理员
    public function superGetAdminOne($id){
        $re = AdminModel::get($id);
        return $re;
    }
}