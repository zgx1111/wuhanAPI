<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/10/21
 * Time: 17:29
 */

namespace app\admin\controller;


use think\Controller;

class Login extends Controller
{
    //门店登陆
    public function store(){
        return view();
    }
    //供货仓登陆:urk:yxadult.xyz/storehouse
    public function storehouse(){
        return view();
    }
    //推广员登陆:urk:yxadult.xyz/storehouse
    public function eworler(){
        return view();
    }
    //管理员登陆:urk:yxadult.xyz/storehouse
    public function admin(){
        return view();
    }
    //推广员登陆
    public function eworker(){
        return view();
    }
    //超级管理员登陆
    public function super(){
        return view();
    }

}