<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 16:33
 */

namespace app\api\service;


use app\api\model\OrderProduct;
use app\api\model\Product;
use app\api\model\UserAddress;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use app\api\model\Order as OrderModel;
use think\Db;
use think\Exception;
use app\api\model\UserProducts;

class Order
{
    //下单的处理
    //从客户端传过来的商品信息
    protected $oProducts;
    //从数据库读取的商品信息,包括库存量
    protected $products;
    protected $uid;
    //通过传入uid和商品信息，创建订单并且返回信息
    public function place($uid,$oProducts,$house_id,$store_id,$time,$remarks){
        //将用户传过来的商品信息和数据库的信息进行比对
        //传入的商品信息
        $this->oProducts = $oProducts;
        $this->uid = $uid;
        //数据库的商品信息
        $this->products=$this->getProductsByOrder($oProducts,$house_id);
        //return $this->products;
       //订单状态，检验订单是否能创建
        $status = $this->getOrderStatus();
        if(!$status['pass']){
            $status['order_id']=-1;
            return $status;
        }
        //返回订单快照
        $snap = $this->snapOrder($status);
        //存入数据库
        $order = $this->createOrder($snap,$house_id,$store_id,$time,$remarks);
        //增加pass，证明通过
        $order['pass'] = true;
        //返回结果
        return $order;


    }
    //将订单存入数据库
    public function createOrder($snap,$house_id,$store_id,$time,$remarks){
        //开启事务
        Db::startTrans();
        try{
            //获得随即订单号
            $orderNo = $this->makeOrderNo();
            //创建order订单对象,添加到order中
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNo;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->store_id = $store_id;
            $order->send_time = $time;
            $order->storehouse_id = $house_id;
             $order->remarks = $remarks;
            $order->save();
            //往order_Product中添加信息
            $orderID = $order->id;
            $create_time = $order->create_time;
            foreach($this->oProducts as &$p){
                $p['order_id'] = $orderID;
            }
            $orderProduct = new OrderProduct();
            $orderProduct->insertAll($this->oProducts);
            //提交事务
            Db::commit();
            return [
                'order_no' => $orderNo,
                'order_id' => $orderID,
                'create_time' => $create_time,
                'total_price' => $snap['orderPrice']
            ];
        }catch(Exception $ex){
            //事务回滚
            Db::rollback();
            return [
                '1'=>'error'
            ];
        }


    }
    //创建随机订单号
    private static function makeOrderNo(){
        $yCode = array('A','B','C','D','E','F','G','H','I','J');
        $orderSn = $yCode[intval(date('Y'))-2019].strtoupper(dechex(date('m'))).date('d').substr(time(),-5).
            substr(microtime(),2,5). sprintf('%02d',rand(0,99));
        return $orderSn;
    }
    //创建订单快照
    public function snapOrder($status){
        //订单详情
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => ''
        ];
        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        //返回是字符串，转化为json，容易存储
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_imgs'][0]['img_url']['url'];
        //数量大于一个
        if(count($this->products)>0){
            $snap['snapName'].="等";
        }
        return $snap;
    }
    //获取用户地址
    private function getUserAddress(){
        $address = UserAddress::where('user_id','=',$this->uid)
            ->find();
        if(!$address){
            throw new UserException([
                'msg'=>'用户地址不存在，不能下单',
                'errorCode'=>60001
            ]);
        }
        return $address->toArray();
    }
    //数据对比
    public function getOrderStatus(){
        //记录订单的状态
        $status = [
            //是否通过
            'pass' => true,
            //订单价格
            'orderPrice' => 0,
            //商品总数量
            'totalCount' => 0,
            //订单的详细信息
            'pStatusArray' =>[]

        ];
        //遍历对比是否有库存
        foreach($this->oProducts as $oProduct){
            //获得每一个商品信息
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'],$oProduct['count'],$this->products
            );
            //判断是否有商品库存不够
            if(!$pStatus['haveStock']){
                $status['pass']=false;
            }
            //添加订单状态信息
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['counts'];
            array_push($status['pStatusArray'],$pStatus);

        }
        return $status;
    }

    //对比每一个表单数据的状态
    //$oPID是传入的商品参数
    //#count是传入的商品数量
    public function getProductStatus($oPID,$oCount,$products){
        $pindex = -1;
        //记录商品的状态
        $pStatus = [
            'id' => null,
            //是否有存货
            'haveStock'=>false,
            'counts'=>0,
            'price'=>0,
            'name'=>'',
            'totalPrice'=>0,
            'main_img_url'=>null
        ];
        //遍历寻找商品id是否存在
        for($i=0 ;$i<count($products);$i++){
            if($oPID == $products[$i]['id']){
                $pindex = $i;
            }
        }
        //不存在就抛出不存在的异常
        if($pindex == -1){
            throw new OrderException([
                'msg'=>'id为'.$oPID.'商品不存在，创建订单失败'
            ]);
        }else{
            $product = $products[$pindex];
            $pStatus['id']=$product['id'];
            $pStatus['counts']=$oCount;
            $pStatus['price']=$product['price'];
            $pStatus['name'] = $product['name'];
            $pStatus['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
            
            //判断用哪个价格来计算，limit_counts大于0时，用sprice,小于等于0时，用price
            // if($product['limit_counts']>0){
            //     $pStatus['totalPrice']=($product['sprice'] * $oCount * ($product['discount']*100))/100;
            // }else{
            //     $pStatus['totalPrice']=($product['price'] * $oCount * ($product['discount']*100))/100;
            // }
            //判断用哪个价格来计算，limit_counts大于0时，用sprice,小于等于0时，用price
            if($product['limit_counts'] - $pStatus['counts']>=0){
                $pStatus['totalPrice']=($product['sprice'] * $oCount);
            }else if($product['limit_counts']>0){
                $pStatus['totalPrice']=($product['sprice'] * $product['limit_counts'])+($product['price'] * ($oCount - $product['limit_counts']) * ($product['discount']*100))/100;
            }else{
                $pStatus['totalPrice']=($product['price'] * $oCount * ($product['discount']*100))/100;
            }
            
            //var_dump($pStatus);
            if($product['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    //通过用户传入的信息来找到数据库里的信息
    private function getProductsByOrder($oProducts,$house_id){
        $oPIDs = [];
        //获得商品id数组
        foreach($oProducts as $item){
            array_push($oPIDs,$item['product_id']);
        }
        //返回是数据集，转换为数组,只显示id等几个参数
        $products = Product::with(['mainImgs'=>function($query){
            $query->with('imgUrl');
        }])->where('id',"in",$oPIDs)
            ->where('storehouse_id',$house_id)
            ->select()
            ->visible(['id','price','stock','name','main_img_url','main_imgs','discount','limit_counts','sprice'])
            ->toArray();
        foreach($products as &$p){
             //获得用户购买此商品的记录
            $re = UserProducts::where('user_id',$this->uid)
            ->where('product_id',$p['id'])
            ->find();
            $p['limit_counts'] -= $re['count'];
        }
        return $products;
    }
    //对于支付接口的检验商品库存是否合理
    public function checkOrderStock($orderID,$house_id){
    	//获得用户id
        $order = OrderModel::where('id',$orderID)
        	->find();
        $this->uid = $order->user_id;
        //获取用户下订单的商品种类和数量
        $this->oProducts = OrderProduct::where('order_id','=',$orderID)
            ->select();
        //获取数据库商品的种类和库存
        $this->products = $this->getProductsByOrder($this->oProducts,$house_id);
        //var_dump($this->products);
        //调用函数返回订单状态
        $status = $this->getOrderStatus();
        //订单金额改变，无法支付，重新下订单
        // if(($order->total_price) *100 != ($status['orderPrice']) *100){
        //     $status['pass'] = false;
        //     $status['error'] = '前后金额不对';
        // }
        
        return $status;


    }
    //发送模板消息
    public function delivery($orderID, $jumpPage = '')
    {
        $order = OrderModel::where('id', '=', $orderID)
            ->find();
        if (!$order) {
            throw new OrderException();
        }
        if ($order->status != OrderStatusEnum::PAID) {
            throw new OrderException([
                'msg' => '还没付款呢，想干嘛？或者你已经更新过订单了，不要再刷了',
                'errorCode' => 80002,
                'code' => 403
            ]);
        }
        //更新订单信息
        $order->status = OrderStatusEnum::DELIVERED;
        $order->save();
//            ->update(['status' => OrderStatusEnum::DELIVERED]);
        $message = new DeliveryMessage();
        return $message->sendDeliveryMessage($order, $jumpPage);
    }

}