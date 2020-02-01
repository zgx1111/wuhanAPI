<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/11/11
 * Time: 16:53
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\model\Eworker as EworkerModel;
use app\lib\enum\ScopeEnum;
use app\api\service\Token as TokenService;
class Eworker extends BaseController
{
    //登陆
    public function login($username,$password){
        $token = self::getAppToken($username,$password,ScopeEnum::eworker);
        return [
            'status'=>1,
            'token'=>$token
        ];
    }
    //获得自家的名字
    //获得自己的管理者信息
    public function eworkerGetName(){
        $uid = TokenService::getCurrentUid();
        $re = EworkerModel::get($uid);
        return $re;
    }
    //管理员查看推广员
    public function adminGetEworkerAll($page){
            $page = ($page-1)*15;
            $re = EworkerModel::limit($page,15)
                ->select();
            return $re;
    }
    //管理员查看推广员（不分页）
    public function adminGetEworker(){
        $re =  EworkerModel::select();
        if($re->isEmpty()){
            return false;
        }
        return $re;
    }
    //管理员获得推广员总数
    public function adminGetEworkerCount(){
        $re = EworkerModel::select();
        return count($re);
    }
    //管理员添加推广员
    public function adminAddEworker($username,$password,$truename,$phone){
        $worker = new EworkerModel();
        $re = $worker->save([
            'username'=>$username,
            'password'=>$password,
            'truename'=>$truename,
            'phone'=>$phone
        ]);
        return $re;
    }
    //管理员删除推广员
    public function adminDelEworker($id){
        $worker = new EworkerModel();
        return $worker->where('id',$id)->delete();
    }
    //获得个人信息
    public function info(){
        //获得推广员id
        $uid = TokenService::getCurrentUid();
        $re = EworkerModel::where('id',$uid)
            ->find();
        return $re;
    }

}