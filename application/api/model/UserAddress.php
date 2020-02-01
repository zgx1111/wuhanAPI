<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/22
 * Time: 21:56
 */

namespace app\api\model;


class UserAddress extends BaseModel
{
    protected $hidden = ['id','delete_time','user_id'];
    //开启自动写入时间
    protected $autoWriteTimestamp = true;
}