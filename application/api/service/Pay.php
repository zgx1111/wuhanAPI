<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/25
 * Time: 14:59
 */

namespace app\api\service;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;

use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;
//extends/WxPay/WxPay.Api.php
//不修改EXTEND_PATH默认路径的话，在extends下的带有命名空间的文件会自动加载,微信sdk的这些文件没有命名空间
Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');
class Pay
{
    private $orderID;
    private $orderNO;

    public function __construct($orderID)
    {
        if(!$orderID){
            throw new Exception('订单号不能为空');
        }
        $this->orderID = $orderID;


    }
    //支付主方法
    public function pay($house_id){
        //订单号可能根本不存在
        //订单号存在，但是和用户ID不匹配
        //订单有可能已经被支付过
        //进行库存量检测
        $this->checkOrderValid();
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderID,$house_id);
        if(!$status['pass']){
            return $status;
        }
        //return $status['orderPrice'];
        //return $this->orderNO;
        return $this->makeWxPreOrder($status['orderPrice']);

    }

    //生成微信的预订单
    public function makeWxPreOrder($totalPrice)
    {
        //openid
        $openid = Token::getCurrentTokenVar('openid');
        if (!$openid) {
            throw new TokenException();
        }
        //创建微信支付对象,没有引用进来的类需要在前面加'\'
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNO);
        //交易类型
        $wxOrderData->SetTrade_type('JSAPI');
        //订单的总价格，微信单位是分，传入的金额需要乘100
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        //商品的简要描述
        $wxOrderData->SetBody('test');
        //用户的openid
        $wxOrderData->SetOpenid($openid);
        //接受微信回调通知的地址
        $wxOrderData->SetNotify_url(config('secure.pay_back_url'));
        //统一下单
        return $this->getPaySignature($wxOrderData);
    }
    ////向微信请求订单号并生成签名
    private function getPaySignature($wxOrderData){
    	//var_dump($wxOrderData);
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        //var_dump($wxOrder);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
            return [
        		'pass' => 'false',
        		'error'  => '订单金额发生变化，重新下单'
        		];
//            throw new Exception('获取预支付订单失败');
        }
        //prepay_id 向用户推送模板消息需要用到的
        //存储prepay_id
        $this->recordPreOrder($wxOrder);
        //生成签名
        $signature = $this->sign($wxOrder);
        return $signature;
    }
    //生成签名
    private function sign($wxOrder){
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time().mt_rand(0,1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id='.$wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        //获得abc值的数组
        $rawValues = $jsApiPayData->GetValues();
        //将签名加入数组
        $rawValues['paySign'] = $sign;
        //将数组中app_id删除
        unset($rawValues['appID']);

        return $rawValues;


    }
    //存储prepay_id,更新order表
    private function recordPreOrder($wxOrder){
        OrderModel::where('id','=',$this->orderID)
            ->update(['prepay_id'=>$wxOrder['prepay_id']]);
    }

    //验证订单号
    private function checkOrderValid(){
        //检验数据库中订单号是否存在
        $order = OrderModel::where('id','=',$this->orderID)
            ->find();
        if(!$order){
            throw new OrderException();
        }
        //检验uid和缓存中的uid是否一致
        if(!Token::isValidOperate($order->user_id)){
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errorCode' => 10003,
            ]);
        }
        //检验订单是否已经被支付
        if($order->status != OrderStatusEnum::UNPAID){
            throw new OrderException([
                'msg' => '订单已经被支付',
                'errorCode' => 80003,
                'code' => 400
            ]);
        }
        //
        $this->orderNO = $order->order_no;
    }

}