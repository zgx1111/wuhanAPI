<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/28
 * Time: 13:34
 */
namespace app\api\service;
use app\api\model\Order as OrderModel;
use app\api\model\Product;
use app\api\model\Remind;
use app\api\model\UserProducts;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');
//对微信订单付款成功的处理
class WxNotify extends \WxPayNotify
{
    //继承WxNotify里面的方法，$data返回的是xml，但是SDK将$data转换为数组形式
    public function NotifyProcess($data, &$msg)
    {
        //Log::save($msg);
        //如果微信返回成功的信息
        if($data['result_code'] == 'SUCCESS'){
            //返回订单编号
            $orderNO = $data['out_trade_no'];
            //使用事务机制，防止多次修改数据库内容
            Db::startTrans();
            try{
                //检查数据库中订单
                $order = OrderModel::where('order_no','=',$orderNO)
                    ->lock(true) //加锁
                    ->find();
                //如果订单未支付
                if($order['status'] == 1){
                    $service = new OrderService();
                    $house_id = $order['storehouse_id'];
                    //存货状态
                    $status = $service->checkOrderStock($order->id,$house_id);
                    //有存货
                    if($status['pass']){
                        //更改订单状态
                        $this->updateOrderStatus($order->id,true);
                        //更改存货信息
                        $this->reduceStock($status,$order->user_id);
                    }else{
                        //订单支付但是没有存货
                        $this->updateOrderStatus($order->id,false);
                    }
                }
                //存入订单提醒
                $re = new Remind();
                $re->save(['order_id'=>$order['id'],'storehouse_id'=>$order['storehouse_id']]);
                Db::commit();
                return true;

            }catch(Exception $e){
                Db::rollback();
                //异常记录到日志
                Log::error($e);
                //返回错误，让微信继续发消息
                return false;
            }
        }
        else{
            //微信返回支付失败信息，返回给微信false，让微信不再发消息
            return true;
        }
    }
    //减少库存量,增加销量,增加销售记录
    private function reduceStock($stockStatus,$uid){
        foreach($stockStatus['pStatusArray'] as $singlePStatus){
            //订单商品数量
            // $singlePStatus['counts'];
            Product::where('id','=',$singlePStatus['id'])
                ->setDec('stock',$singlePStatus['counts']);
            Product::where('id','=',$singlePStatus['id'])
                ->setInc('sales',$singlePStatus['counts']);
        
            $up = UserProducts::where('product_id',$singlePStatus['id'])
            	->where('user_id',$uid)
            	->find();
            if($up){
            	UserProducts::where('product_id',$singlePStatus['id'])
            	->where('user_id',$uid)
            	->setInc('count',$singlePStatus['counts']);
            }else{
            	$up = new UserProducts();
	            $up->data([
	                'product_id'=>$singlePStatus['id'],
	                'user_id'=>$uid,
	                'count'=>$singlePStatus['counts'],
	            ]);
        		$re = $up->save();
	        }
            
        }
    }
    //更改订单状态
    private function updateOrderStatus($orderID,$success){
        //订单状态
        $status = $success?OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id','=',$orderID)
            ->update(['status' => $status]);
    }
}