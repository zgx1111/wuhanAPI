<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/25
 * Time: 13:06
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\service\WxNotify;
use app\api\validate\IDMustBePostivelnt;
use app\api\service\Pay as PayService;

class Pay extends BaseController
{
    //检查权限，只有用户能支付
//    protected $beforeActionList = [
//        'checkExclusiveScope'=>['only' => 'placeOrder']
//    ];
    //用户支付接口
    //url：'api/:version/pay/pro_order','api/:version.Pay/getProOrder'
    public function getProOrder($id=''){
        //检测ID是否是正整数
        (new IDMustBePostivelnt())->goCheck();
        $pay = new PayService($id);
        //获得供货仓id
        $house_id = self::getHouseID();
        $re = self::time($house_id);
        if(!$re['status']){
            return $re;
        }
        return $pay->pay($house_id);
    }
    //接受微信返回信息
    public function receiveNotify(){
        //第三次检查库存，超卖
        //更新订单Status状态
        //减库存
        //成功处理，向微信返回成功消息，微信停止返回通知。失败，返回失败消息

        //特点：post; xml格式 ，不会携带参数
        $notify = new WxNotify();
        //调用Handle函数，会再调用接受微信返回的函数
        $notify->Handle();

    }

}