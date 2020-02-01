<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/12/16
 * Time: 11:34
 */

namespace app\api\model;


class ProductMainImage extends BaseModel
{
    public function imgUrl(){
        return $this->belongsTo('Image','img_id','id');
    }

}