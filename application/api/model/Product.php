<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/17
 * Time: 0:18
 */

namespace app\api\model;

use think\Request;
use traits\model\SoftDelete;
use app\api\service\Token as TokenService;
class Product extends BaseModel
{
    use SoftDelete;
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    protected $hidden = [
       'main_img_id','pivot','from'
    ];
    //获取图片地址
    public function getMainImgUrlAttr($value,$data){
        return $this->getUrl($value,$data);
    }
    //查找最近新品
    public static function getMostRecent($count,$house_id){
        $product = self::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->limit($count)
            ->where('storehouse_id',$house_id)
            ->where('category_id','<>',11)
            ->order('create_time desc')
            ->select()
            ->toArray();
        return $product;
    }
    //分类商品
    public static function getProductByCategoryID($id,$house_id){
        return self::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('category_id','=',$id)
            ->where('storehouse_id',$house_id)
            ->select()
            ->toArray();
    }
    //查找供货仓分类商品
    public static function getProductByStorehouseID($id,$page,$cate){
        $page=($page-1) * 15;
        return self::with('category')
            ->with([
                'imgs'=>function($query){
                    $query->with('imgUrl');
                },'mainImgs'=>function($query){
                    $query->with('imgUrl');
                }])
            ->where('storehouse_id','=',$id)
            ->where('category_id',$cate)
            ->limit($page,15)
            ->select();
    }
    //获得供货仓分类商品总数
    public static function getProCountByStorehouseID($id,$cate){
        $list = self::where('storehouse_id','=',$id)
            ->where('category_id',$cate)
            ->select();
        return count($list);
    }

    //关联主图片表
    public function mainImgs(){
        return $this->hasMany('ProductMainImage','product_id','id');
    }
    //关联副图片表
    public function imgs(){
        return $this->hasMany('ProductImage','product_id','id');
    }
    //关联供货仓表
    public function storehouse(){
        return $this->belongsTo('storehouse','storehouse_id','id');
    }
    //关联分类表
    public function category(){
        return $this->belongsTo('category','category_id','id');
    }
    //查找商品详细信息
    public static function getProductDetail($id){
        //闭包函数构建查询器
        return self::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }
        ])
        ->find($id)
        ->toArray();

    }
    //查找admin商品
    public static function adminGetProduct($page){
        $page=($page-1) * 15;
        return self::with(['category','storehouse'])
            ->limit($page,15)
            ->select();
    }
    //admin获得商品数量
    public function adminGetCount(){
        $list = self::select();
        return count($list);
    }

}