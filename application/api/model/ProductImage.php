<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/20
 * Time: 21:59
 */

namespace app\api\model;


class ProductImage extends BaseModel
{
//    use SoftDelete;
//    //开启自动写入时间戳
//    protected $autoWriteTimestamp = true;
    //protected $hidden = ['img_id','delete_time','product_id'];
    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }

}