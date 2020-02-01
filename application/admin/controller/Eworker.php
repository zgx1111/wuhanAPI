<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/9
 * Time: 23:57
 */

namespace app\admin\controller;

use think\Controller;
class Eworker extends Controller
{
    //到主页面
    public function index(){
        return view();
    }
    //获得门店
    public function eworkerStoreAll(){
        return view();
    }
    //获得门店信息
    public function info(){
        return view();
    }
    //获得门店订单
    public function eworkerGetStoreOrder(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //获得销售数据
    public function payOrder(){
        return view();
    }
}