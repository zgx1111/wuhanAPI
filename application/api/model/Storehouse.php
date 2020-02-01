<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/6
 * Time: 15:11
 */

namespace app\api\model;


use traits\model\SoftDelete;

class Storehouse extends BaseModel
{
    //开启软删除
    use SoftDelete;
    //自动写入时间
    protected $autoWriteTimestamp = true;
    public function city(){
        return $this->belongsTo('city','city_id','id');
    }
}