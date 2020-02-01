<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/23
 * Time: 10:59
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Remind;
use app\api\validate\IDMustBePostivelnt;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\ProductException;
use app\lib\exception\SuccessMessage;
use app\api\service\Order as OrderService;
use app\api\service\Token as TokenService;
use app\api\model\Order as OrderModel;
use app\lib\exception\TokenException;
use think\Cache;


class Order extends BaseController
{
    //用户在选择商品后，向API提交商品的相关信息
    //API在接受到商品的相关信息后，需要检查商品的库存量
    //有库存，把订单数据存入数据库，下单成功，返回客户端，告诉可以支付了
    //调用我们的支付接口，进行支付
    //再次检查库存量
    //服务器这边就可以调用微信的支付接口进行支付
    //小程序根据服务器返回结果拉起微信支付
    //微信会返回一个支付结果(异步),客户端那头微信会自己显示成功或者失败
    //成功，也需要库存量的检查
    //成功，进行库存量的扣除

    //前置函数，检查用户权限是否符合
    protected $beforeActionList = [
        'checkExclusiveScope'=>['only' => 'placeOrder'],
        'checkPrimaryScope'=>['only'=>'getSummaryByUser']
        ];
        //@api/:version/order
        //检查订单状态
        public function placeOrder(){
            //验证订单数据
            (new OrderPlace())->goCheck();
            //获得供货仓id；
            $house_id = self::getHouseID();
            //检查是否在营业时间
            $re = self::time($house_id);
            if(!$re['status']){
                return $re;
            }
            //获得门店id
            $store_id = input('store');
            //获得用户id
            $uid = TokenService::getCurrentUid();
            //获得送货时间
            $time = input('time');
            //获得备注
            $remarks = input('remarks');
        ///a表示获取一个数组参数
            $oProducts = input('post.products/a');
            $status = (new OrderService())->place($uid,$oProducts,$house_id,$store_id,$time,$remarks);
            return $status;
            //return $uid;
        }
        //根据订单号获取订单详情
        public function getDetail($id){
            (new IDMustBePostivelnt())->goCheck();
            $orderDe =OrderModel::get($id);
            if(!$orderDe){
                throw new OrderException();
            }
            return $orderDe ->hidden(['prepay_id']);

        }
        //根据用户id获取用户订单
        public function getSummaryByUser($page=1,$size=15){
            (new PagingParameter())->goCheck();
            $uid = TokenService::getCurrentUid();
            $page = OrderModel::getSummaryByUser($uid,$page,$size);
            //返回是对象,为空时返回空
            if($page->isEmpty()){
                return [
                    'data' => [],
                    'current_page' => $page->getCurrentPage()
                ];
            }
            //不为空时，返回数据
            $data = $page->hidden(['snap_items','snap_address','prepay_id'])->toArray();
            return [
                'data' => $data,
                'current_page' =>$page->getCurrentPage()
            ];

        }
    //发送模板消息
    public function delivery($id){
        (new IDMustBePostivelnt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if($success){
            return new SuccessMessage();
        }
    }

    //供货仓获得全部订单,包括未发货
    public function getOrderAllByStorehouseID($page){
//        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $re = OrderModel::getOrderByStorehouseID($uid,$page);
//        if($re->isEmpty()){
//            throw new Exception('订单不存在');
//        }
        return $re;

    }
    //供货仓获得订单总数，包括未发货
    public function getOrderAllCount(){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $re = OrderModel::getOrderCountByStorehouseID($uid);
        if($re==0){
           return [
               'count'=>0,
               'status'=>false,
           ];
        }
        return [
            'count'=>$re,
            'status'=>true,
        ];
    }
    //获得供货仓已付款订单
    public function getOrderRemind($page){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $re = OrderModel::getOrderRemindByStorehouseID($uid,$page);
        return $re;
    }
    public function getOrderRemindCount(){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $count = OrderModel::getOrderRemindCountByStorehouseID($uid);
        if($count==0){
            return [
                'count'=>0,
                'status'=>true,
            ];
        }
        return [
            'count'=>$count,
            'status'=>true,
        ];
    }
    //接单
    public function orderTaking(){
        $id = input("post.id");
        $order = new OrderModel();
        //改变订单状态
        $r1=$order->save([
            'status'=>5
        ],['id'=>$id]);
        //删除订单提醒
        $r2=Remind::where('order_id',$id)
            ->delete();
        if($r1 && $r2){
            return true;
        }else{
            return false;
        }
    }
    //发货
    public function send($id){
            $order = new OrderModel();//改变订单状态
        $r1=$order->save([
            'status'=>OrderStatusEnum::DELIVERED
        ],['id'=>$id]);
        if($r1){
            return true;
        }else{
            return false;
        }
            
    }
    //订单提醒
    public function remind(){
//            $re = new Remind();
//            $re->save(['order_id'=>123]);
            //获得供货仓id
            $uid = TokenService::getCurrentUid();
            $remind = Remind::where('storehouse_id',$uid)
                ->select();
            if(count($remind) == 0){
                return false;
            }else{
                return true;
            }

    }
    //门店获得全部订单getOrderByStoreID
    public function getOrderByStoreID($page,$year,$month){
        $page = ($page-1)*15;
        //获得门店id
        $uid = TokenService::getCurrentUid();
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
       return OrderModel::where('store_id',$uid)
           ->where("create_time",">=",$begin)
           ->where("create_time","<",$end)
           ->where('status',3)
           ->limit($page,15)
           ->select();
    }
    //门店获的订单数量和总金额
    public function getOrderCountByStoreID($year,$month){
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        //        //获得门店id
        $uid = TokenService::getCurrentUid();
        $count = OrderModel::where('store_id','=',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->count();
        $amount = OrderModel::where('store_id','=',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->sum('total_price');
        return [
            'count'=>$count,
            'amount'=>$amount
        ];
    }
    //管理员获得全部订单
    public function adminGetOrderAll($page,$year,$month){
        $page = ($page-1)*15;
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        $re = OrderModel::with(['store','storehouse'])
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->limit($page,15)
            ->select();
        return $re;
    }
    //管理员获得订单总数
    public function adminGetOrderCount($year,$month){
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        $count = OrderModel::where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->count();
        $amount = OrderModel::where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->sum('total_price');
        return [
            'count'=>$count,
            'amount'=>$amount
        ];
    }

    //管理员获得供货仓的订单
    public function adminGetStorehouseOrder($id,$page,$year,$month,$status){
        $page = ($page-1)*15;
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        if($status == 0){
            $re = OrderModel::with(['store','storehouse'])
                ->where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->limit($page,15)
                ->select();
            return $re;
        }else{
            $re = OrderModel::with(['store','storehouse'])
                ->where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->limit($page,15)
                ->select();
            return $re;
        }
        return $re;
    }
    //管理员获得供货仓的订单数
    public function adminGetStorehouseOrderCount($id,$year,$month,$status){
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");

        if($status == 3){
            $count = OrderModel::where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->count();
            $amount = OrderModel::where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->sum('total_price');
            return [
                'count'=>$count,
                'amount'=>$amount
            ];
        }else if($status == 0){
            $count = OrderModel::where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }else{
            $count = OrderModel::where('storehouse_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }

    }
    //管理员获得推广员的订单
    public function adminGetEworkerOrder($id,$page,$year,$month,$status){
        $page = ($page-1)*15;
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        //获取推广员名下所有门店id
        $store = \app\api\model\Store::where('eworker_id',$id)->select();
        $ID = Array();
        for($i = 0; $i<count($store);$i++){
            $ID[$i]=$store[$i]['id'];
        }
        if($status == 0){
            $re = OrderModel::with(['store','storehouse'])
                ->where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->limit($page,15)
                ->select();
            return $re;
        }else{
            $re = OrderModel::with(['store','storehouse'])
                ->where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->limit($page,15)
                ->select();
            return $re;
        }
        return $re;
    }
    //管理员获得推广员的订单数量和金额
    public function adminGetEworkerOrderCount($id,$year,$month,$status){
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        //获取推广员名下所有门店id
        $store = \app\api\model\Store::where('eworker_id',$id)->select();
        $ID = Array();
        for($i = 0; $i<count($store);$i++){
            $ID[$i]=$store[$i]['id'];
        }
        if($status == 3){
            $count = OrderModel::where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->count();
            $amount = OrderModel::where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->sum('total_price');
            return [
                'count'=>$count,
                'amount'=>$amount
            ];
        }else if($status == 0){
            $count = OrderModel::where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }else{
            $count = OrderModel::where('store_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }
    }
    //推广员，供货仓,admin获得门店订单
    public function GetStoreOrder($page,$id,$year,$month,$status){
        $page = ($page-1)*15;
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;

        if($month1>12){
            $month1=1;
            $year++;
        }
        //return $year;
        $end = strtotime($year."-".$month1."-1 00:00:00");
        if($status == 0){
            $re = OrderModel::with(['store','storehouse'])
                ->where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->limit($page,15)
                ->select();
            return $re;
        }else{
            $re = OrderModel::with(['store','storehouse'])
                ->where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->limit($page,15)
                ->select();
            return $re;
        }
        return $re;

    }
    //推广员,供货仓,管理员获得门店订单数量和金额
    public function GetStoreOrderCount($id,$year,$month,$status){
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");

        if($status == 3){
            $count = OrderModel::where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->count();
            $amount = OrderModel::where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->sum('total_price');
            return [
                'count'=>$count,
                'amount'=>$amount
            ];
        }else if($status == 0){
            $count = OrderModel::where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }else{
            $count = OrderModel::where('store_id',$id)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }
    }
    //推广员获得自己的订单
    public function getOrderByEworkerID($page,$year,$month){
            //获得推广员id
        $page = ($page-1)*15;
        $uid = TokenService::getCurrentUid();
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");

        //获取推广员名下所有门店id
        $store = \app\api\model\Store::where('eworker_id',$uid)->select();
        $ID = Array();
        for($i = 0; $i<count($store);$i++){
            $ID[$i]=$store[$i]['id'];
        }
        $re = OrderModel::with('store')
            ->where('store_id','in',$ID)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->limit($page,15)
            ->select();
        return $re;
    }
    //推广员获得自己订单数量和金额
    public function getOrderCountByEworkerID($year,$month){
        //获得推广员id
        $uid = TokenService::getCurrentUid();
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");

        //获取推广员名下所有门店id
        $store = \app\api\model\Store::where('eworker_id',$uid)->select();
        $ID = Array();
        for($i = 0; $i<count($store);$i++){
            $ID[$i]=$store[$i]['id'];
        }
        $count = OrderModel::where('store_id','in',$ID)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->count();
        $amount = OrderModel::where('store_id','in',$ID)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->sum('total_price');
        return [
            'count'=>$count,
            'amount'=>$amount
        ];
    }
    //供货仓获得自己的订单
    public function getOrderByStorehouseID($page,$year,$month,$year1,$month1){
        $page = ($page-1)*15;
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1++;
        if($month1>12){
            $month1=1;
            $year1++;
        }
        //return $year.$month.$year1.$month1;
        $end = strtotime($year1."-".$month1."-1 00:00:00");
        $re = OrderModel::with('store')
            ->where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->limit($page,15)
            ->select();
        return $re;
    }
    //供货仓获得自己的订单数量和金额
    public function getOrderCountByStorehouseID($year,$month,$year1,$month1){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1++;
        if($month1>12){
            $month1=1;
            $year1++;
        }
        $end = strtotime($year1."-".$month1."-1 00:00:00");

        $count = OrderModel::where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->count();
        $amount = OrderModel::where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->sum('total_price');
        return [
            'count'=>$count,
            'amount'=>$amount
        ];
    }
    //管理员获得城市数据adminGetCityOrder
    public function adminGetCityOrder($cityID,$page,$year,$month,$status){
        $page = ($page-1)*15;
        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");

        //获取城市下所有供货仓
        $storehouse = \app\api\model\Storehouse::where('city_id',$cityID)->select();
        $ID = Array();
        for($i = 0; $i<count($storehouse);$i++){
            $ID[$i]=$storehouse[$i]['id'];
        }
        if($status == 0){
            $re = OrderModel::with(['store','storehouse'])
                ->where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->limit($page,15)
                ->select();
            return $re;
        }else{
            $re = OrderModel::with(['store','storehouse'])
                ->where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->limit($page,15)
                ->select();
            return $re;
        }

    }
    //管理员获得城市count
    public function adminGetCityOrderCount($cityID,$status,$year,$month){

        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $month1 = $month+1;
        if($month1>12){
            $month1=1;
            $year++;
        }
        $end = strtotime($year."-".$month1."-1 00:00:00");
        //获取城市下所有供货仓
        $storehouse = \app\api\model\Storehouse::where('city_id',$cityID)->select();
        $ID = Array();
        for($i = 0; $i<count($storehouse);$i++){
            $ID[$i]=$storehouse[$i]['id'];
        }
        if($status == 3){
            $count = OrderModel::where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->count();
            $amount = OrderModel::where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',3)
                ->sum('total_price');
            return [
                'count'=>$count,
                'amount'=>$amount
            ];
        }else if($status == 0){
            $count = OrderModel::where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }else{
            $count = OrderModel::where('storehouse_id','in',$ID)
                ->where("create_time",">=",$begin)
                ->where("create_time","<",$end)
                ->where('status',$status)
                ->count();
            return [
                'count'=>$count,
                'amount'=>0
            ];
        }

    }
    //导出表格
    public function getExcel(){
        $token = input("get.token");
        $var = Cache::get($token);
        //判断缓存是否为空
        if(!$var){
            throw new TokenException();
        }else{
            //判断是否为数组，不是就转化为数组，因为使用默认的文件缓存返回字符串，而用redis返回是数组
            if(!is_array($var)){
                $var = json_decode($var,true);
            }
            //判断key是否存在,存在就返回
            if(array_key_exists('uid',$var)){
               $uid = $var['uid'];
            }else{
                throw new Exception('Token不存在');
            }
        }
        //转换时间戳
         $year1 = input("get.year1");
         $year = input("get.year");
         $month = input("get.month");
         $month1 = input("get.month1");
         $month1 = $month1+1;
        if($month1>12){
            $month1=1;
            $year1++;
        }

        //转换时间戳
        $begin = strtotime($year."-".$month."-1 00:00:00");
        $end = strtotime($year1."-".$month1."-1 00:00:00");
        //获得数据
        $daochuData = OrderModel::with(['storehouse','store'])
            ->where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where("status",3)
            ->select();
        //获得总数量
        $count = OrderModel::where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->count();
        //获得总金额
        $amount = OrderModel::where('storehouse_id',$uid)
            ->where("create_time",">=",$begin)
            ->where("create_time","<",$end)
            ->where('status',3)
            ->sum('total_price');
        $title = array('id','订单号','商品','发货时间','订单创建时间','总金额','总数量','供货仓名字','门店名字');
        $arr = [];

        foreach($daochuData as $k=>$v) {

            $arr[] = array(
                $v['id'],
                $v['order_no'],
                $v['snap_name'],
                $v['send_time'],
                $v['create_time'],
                $v['total_price'],
                $v['total_count'],
                $v['storehouse']['truename'],
                $v['store']['truename'],
            );
        }
        $month1--;
        if($month1<1){
            $month1=12;
            $year1--;
        }
        //Helper::generateExcel('推广渠道报表_总后台', $list, $field);
        $this->daochu_excel($arr,$title,'销售记录'.$year."年".$month."月到".$year1."年".$month1."月",$amount,$count);
    }
}