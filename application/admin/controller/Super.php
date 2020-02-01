<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/10
 * Time: 11:13
 */

namespace app\admin\controller;


use think\Controller;

class Super extends Controller
{
    //登陆主页
    public function index(){
        return view();
    }
    //获得所有管理员
    public function superSelAdmin(){
        return view();
    }
    //添加管理员
    public function superAddAdmin(){
        return view();
    }
    //修改管理员
    public function superUpdateAdmin(){
        $id = input('get.id');
        $this->assign("id", $id);
        return view();
    }
}