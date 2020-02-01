<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 13:20
 */

namespace app\api\controller;


use app\admin\controller\Eworker;
use app\api\model\Store as StoreModel;
use app\api\model\Storehouse;
use app\api\service\AdminToken;
use app\api\service\EworkerToken;
use app\api\service\StoreHouseToken;
use app\api\service\StoreToken;
use app\api\service\SuperToken;
use app\api\validate\AppTokenGet;
use app\lib\enum\ScopeEnum;
use think\Controller;
use app\api\service\Token as TokenService;
class BaseController extends Controller
{
    //用户和管理员都可以的权限
    protected function checkPrimaryScope(){
        TokenService::needPrimayScope();
    }
    //只有用户才能访问的权限
    protected function checkExclusiveScope(){
        TokenService::needExclusiveScope();
    }
    //根据权限管理后台获得登陆令牌
    public function getAppToken($username='',$password='',$scope=''){
        (new AppTokenGet())->goCheck();
        //供货仓权限
        if($scope == ScopeEnum::storehouse){
            $sh = new StoreHouseToken();
            $token = $sh->get($username,$password);
        }else if($scope == ScopeEnum::store){
            //门店权限
            $store = new StoreToken();
            $token = $store->get($username,$password);
        }else if($scope == ScopeEnum::admin){
            $store = new AdminToken();
            $token = $store->get($username,$password);
        }else if($scope == ScopeEnum::eworker){
            //推广员权限
            $eworker = new EworkerToken();
            $token = $eworker->get($username,$password);
        }else if($scope == ScopeEnum::super){
            //超级管理员权限
            $super = new SuperToken();
            $token = $super->get($username,$password);
        }
        return $token;
    }
    //根据门店id信息获得供货仓id
    public function getHouseID(){
        //获得门店id
        $id = input('store');
        //检验门店是否开启
        $store = StoreModel::get($id);
        //门店是否存在
        if($store){
            //门店是否开门
            if($store->state == 0){
                throw new StoreShutDoorException();
            }
            $house_id = StoreModel::where('id','=',$id)
                ->value('storehouse_id');
            return $house_id;
        }else{
            throw new StoreMissException();
        }
    }
    //验证供货仓是否在营业时间
    public function time($id){
        $house = Storehouse::get($id);
        //获得现在时间整点
        $h = date('H');
        if($h>=$house->begin_at && $h <$house->end_at){
            return [
                'status'=>true
            ];
        }
        return [
            'status'=>false,
            'begin'=>$house->begin_at,
            'end'=>$house->end_at
        ];
    }
//导出表格
    public function daochu_excel($data=array(),$title=array(),$filename='报表',$amount,$count){//导出excel表格

        //处理中文文件名

        ob_end_clean();

        Header('content-Type:application/vnd.ms-excel;charset=utf-8');
        header("Content-Disposition:attachment;filename=export_data.xls");

        //处理中文文件名

        $ua = $_SERVER["HTTP_USER_AGENT"];



        $encoded_filename = urlencode($filename);

        $encoded_filename = str_replace("+", "%20", $encoded_filename);

        if (preg_match("/MSIE/", $ua) || preg_match("/LCTE/", $ua) || $ua == 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko') {

            header('Content-Disposition: attachment; filename="' . $encoded_filename . '.xls"');

        }else {

            header('Content-Disposition: attachment; filename="' . $filename . '.xls"');

        }
        header ( "Content-type:application/vnd.ms-excel" );
        $html = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

            <html xmlns='http://www.w3.org/1999/xhtml'>

            <meta http-equiv='Content-type' content='text/html;charset=UTF-8' />
            <head>
            <title>".$filename."</title>
            <style>
            td{

                text-align:center;

                font-size:12px;

                font-family:Arial, Helvetica, sans-serif;

                border:#1C7A80 1px solid;

                color:#152122;

                width:auto;
            }
            table,tr{
                border-style:none;
            }
            .title{
                background:#CCCCCC;

                color:#FFFFFF;

                font-weight:bold;
            }
            </style>
            </head>
            <body>
            <table width='100%' border='1'>
             <tr>";
        foreach($title as $k=>$v){
            $html .= " <td class='title' style='text-align:center;'>".$v."</td>";
        }
        $html .= "</tr>";
        foreach ($data as $key => $value) {
            $html .= "<tr>";
            foreach($value as $aa){
                $html .= "<td>".$aa."</td>";
            }
            $html .= "</tr>";
        }
       $html.="<tr><td colspan='4' text-align='left'>总金额:".$amount."</td><td colspan='5'>总定单数量:".$count."</td></tr>";
       
        $html .= "</table></body></html>";
        echo $html;
        exit;

    }


}