<?php
namespace app\api\model;

class Article extends BaseModel
{
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    protected $hidden = ['update_time','delete_time'];
    public function comment(){
        return $this->hasMany('comment','article_id','id');
    }
}