<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/19
 * Time: 13:17
 */

namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\model\Category as CategoryModel;
use app\api\model\Image;
use app\lib\exception\CategoryException;

class Category extends BaseController
{
    //获取所有产品分类
    //@url:z.cn/api/v1/category/all
    public function getAllCategories(){
        $re=CategoryModel::all([],'img');
        if($re->isEmpty()){
            throw new CategoryException();
        }
        return $re;
    }
    
    //获得首页10个分类
    public function getHomeCategories(){
        $re = CategoryModel::with('img')
            ->limit(12)
            ->select();
        return $re;
    }
    //@url:z.cn/api/v1/category/one
    public function getCategories($category_id){
    	$re=CategoryModel::where('id','=',$category_id)
            ->find();
        if(!$re){
            throw new CategoryException();
        }
        return $re;
    }
    //管理员获得商品分类
    public function adminGetCate(){
        $cate = CategoryModel::with('img')->select();
        return $cate;
    }
    //管理员修改商品分类
    public function adminUpdateCategory($id,$name){
        $cate = new CategoryModel();
        $re = $cate->save([
            'name'=>$name
        ],['id'=>$id]);
        return $re;
    }
    //管理员删除商品分类
    public function adminDeleteCategory($id){
        $cate = new CategoryModel();
        $re = $cate->where("id",$id)->delete();
        return $re;
    }
    //管理员修改分类图片
    public function updateImg()
    {
        $file = request()->file('img');
        $id = request()->post('id');
        if (empty($file)) {
            return 3;
        }

        // 移动到框架应用根目录/public/images/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
        if ($info) {
            $getSaveName = str_replace("\\", "/", $info->getSaveName());
            $main_img_url = '/' . $getSaveName;

            $img = new Image();
            $img->save(['url' => $main_img_url]);
            $re = new CategoryModel();
            $result = $re->save(['topic_img_id' => $img->id], ['id' => $id]);
            return $result;
        } else {
            //上传失败获取错误信息
            echo $file->getError();
        }
    }
    //管理员添加分类
    public function addCate(){
        //接受图片数据
        $file = request()->file('img');
        if (empty($file)) {
            return 12;
        }
        // 移动到框架应用根目录/public/images/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
        if ($info) {
            //category增加数据
            $name = request()->post('name');
            $getSaveName=str_replace("\\","/",$info->getSaveName());
            $main_img_url = '/'.$getSaveName;
            $img = new Image();
            $img->save(['url' => $main_img_url]);
            $cate = new CategoryModel();
            $result = $cate->save(['topic_img_id' => $img->id,'name'=>$name]);
            return $result;
        } else {
            //上传失败获取错误信息
            echo  $file->getError();
        }
    }
}