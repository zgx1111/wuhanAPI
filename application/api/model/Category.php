<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 13:17
 */

namespace app\api\model;


class Category extends BaseModel
{
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    //产品分类
    protected $hidden = ['create_time','delete_time'];
    //关联image表,查找图片，一对一
    public function img(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
}