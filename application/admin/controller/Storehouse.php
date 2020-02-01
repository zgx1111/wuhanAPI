<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/22
 * Time: 16:51
 */

namespace app\admin\controller;

use think\Controller;

class Storehouse extends Controller
{
    public function index()
    {
        return view();
    }
    //获得自己信息
    public function info(){
        return view();
    }

    //获得全部商品
    public function productAll()
    {
        return view();
    }

    //更新商品
    public function productUpdate()
    {
        $id = input('get.id');
        $this->assign("id", $id);
        return view();
    }

    //添加产品
    public function productAdd()
    {
        return view();
    }

    //上传图片
    public function productUpload()
    {
        $id = input('get.id');
        $this->assign("id", $id);
        return view();
    }

    //获得供货仓的全部订单
    public function orderAll()
    {
        return view();
    }
    //获得供货仓提醒订单
    public function orderRemind(){
        return view();
    }
    //获得供货仓的全部门店
    public function storeAll()
    {
        return view();
    }
    //获得门店全部订单
    public function storehouseGetStoreOrder(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //获得自己的销售记录
    public function payOrder(){
        return view();
    }
    //获得没货的商品
    public function productNo(){
        return view();
    }
    //获得热销商品
    public function productHot(){
        return view();
    }
    //获得滞销商品
    public function productDead(){
        return view();
    }
    //开关店
    public function storeOpenOrClose(){
        return view();
    }
    //设置营业时间
    public function updateTime(){
        return view();
    }
    //添加文章
    public function articleAdd(){
        return view();
    }
    //全部文章
    public function articleAll(){
        return view();
    }
    //修改文章
    public function artUpdate(){
        $id = input('get.id');
        $this->assign("id",$id);
        return view();
    }
    //   //导出表格
    // public function getExcel(){
    //     return view();
    // }
}