<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17
 * Time: 0:19
 */

namespace app\api\model;


class Theme extends BaseModel
{
    protected $hidden=['delete_time','update_time','topic_img_id','head_img_id'];
    public function topicImg(){
        return $this->belongsTo('Image','topic_img_id','id');
    }
    public function headImg(){
        return $this->belongsTo('Image','head_img_id','id');
    }
    //多对多，有中间表theme_product
    public function products(){
        return $this->belongsToMany('product','theme_product','product_id','theme_id');
    }
    //获得list
    public function getSimpleByID($ids){
        return self::with(['topicImg','headImg'])->select($ids);
    }
    //获得详细的一个主题列表
    public static function getThemeWithProduct($id){
        return self::with(['products','topicImg','headImg'])->find($id);
    }

}