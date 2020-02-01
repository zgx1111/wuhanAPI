<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/11/10
 * Time: 22:33
 */

namespace app\admin\controller;

use think\Controller;
class Admin extends Controller
{
    public function index(){
        return view();
    }
    //获得商品
    public function productAll(){
        return view();
    }
    //获得商品全部分类
    public function cateAll(){
        return view();
    }
    //获得主页轮播图
    public function banner(){
        return view();
    }
    //获得所有推广员’
    public function adminGetWorkerAll(){
        return view();
    }
    //查看推广员名下门店
    public function selStore(){
        $id = input('get.id');
        $this->assign("id", $id);
        return view();
    }
    //查看推广员销售记录
    public function adminGetEworkerOrder(){
        $id = input('get.id');
        $this->assign("id", $id);
        return view();
    }
    //添加推广员
    public function addEworker(){
        return  view();
    }
    //查看所有门店
    public function adminGetStoreAll(){
        return view();
    }
    //获得门店的订单
    public function adminGetStoreOrder(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //修改门店信息
    public function adminUpdateStore(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //添加门店
    public function adminAddStore(){
        return view();
    }
    //查看所有供货仓
    public function adminGetStorehouseAll(){
        return view();
    }
    //查看供货仓订单
    public function adminGetStorehouseOrder(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //修改供货仓
    public function adminUpdateStorehouse(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //添加供货仓
    public function adminAddStorehouse(){
        return view();
    }
    //查看管理员信息
    public function info(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //获得城市
    public function getCityAll(){
        return view();
    }
    //添加城市
    public function addCity(){
        return view();
    }
    //添加分类
    public function addCate(){
        return view();
    }
    //查看所有销售记录
    public function payOrder(){
        return view();
    }

    //获得热销商品
    public function productHot(){
        return view();
    }
    //获得城市数据
    public function cityOrder(){
        return view();
    }
    //获得供货仓数据
    public function storehouseOrder(){
        return view();
    }
    //获得推广员数据
    public function eworkerOrder(){
        return view();
    }
    //获得门店数据
    public function storeOrder(){
        return view();
    }
}