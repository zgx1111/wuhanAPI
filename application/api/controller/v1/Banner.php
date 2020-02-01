<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/10
 * Time: 19:35
 */

namespace app\api\controller\v1;
use app\api\controller\BaseController;
use app\api\validate\IDMustBePostivelnt;
use app\lib\exception\BannerMissException;
use think\Exception;
use app\api\model\Banner as BannerModel;
use app\api\model\BannerItem as BannerItemModel;
use app\api\model\Image as ImageModel;
class Banner extends BaseController
{
    /*
     * id:是轮播图banner的id，代表第几个
     * url:/banner/:id
     * http:get
     * */
    public function getBanner($id){
        //验证id是正整数
        (new IDMustBePostivelnt())->goCheck();
        //调用模型函数查询结果
        $banner = (new BannerModel())->getBannerByID($id);
        //判断是否为空抛出异常
        if(!$banner){
            throw new BannerMissException();
        }
        //返回结果
        return $banner;
    }
    //管理员获得幻灯片
    public function adminGetBanner(){
       return BannerItemModel::with('img')->select();
    }
    //管理员修改幻灯片
    public function updateImg(){
        $file = request()->file('img');
        $id = request()->post('id');

        if (empty($file)) {
            return 3;
        }

        // 移动到框架应用根目录/public/images/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
        if ($info) {
            $getSaveName=str_replace("\\","/",$info->getSaveName());
            $main_img_url = '/'.$getSaveName;

            $img= new ImageModel();
            $img->save(['url'=>$main_img_url]);
            $re = new BannerItemModel();
            $result =$re->save(['img_id'=>$img->id],['id'=>$id]);
            return $result;
        } else {
            //上传失败获取错误信息
            echo  $file->getError();
        }

    }

}