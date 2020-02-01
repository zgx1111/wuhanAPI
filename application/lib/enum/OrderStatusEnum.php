<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/25
 * Time: 19:41
 */

namespace app\lib\enum;


class OrderStatusEnum
{
    //待支付
    const UNPAID = 1;
    //已经支付
    const PAID = 2;
    //已经发货
    const DELIVERED = 3;
    //已经支付但是库存不足
    const PAID_BUT_OUT_OF = 4;
}