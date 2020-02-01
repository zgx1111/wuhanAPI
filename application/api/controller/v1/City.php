<?php
/**
 * Created by PhpStorm.
 * User: zhaoguangxu
 * Date: 2019/11/13
 * Time: 14:49
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\City as CityModel;
class City extends BaseController
{
    //admin获得所有城市，不分页
    public function adminGetCity(){
        $re = CityModel::select();
        return $re;
    }
    //admin获得所有城市
    public function adminGetCityAll($page){
        $page=($page-1) * 15;
        $re = CityModel::limit($page,15)->select();
        if($re->isEmpty()){
            return false;
        }
        return $re;
    }

    //admin获得城市总数
    public function adminGetCityCount(){
        $list = CityModel::select();
        return count($list);
    }
    //admin删除城市
    public function adminDelCity($id){
        $re = CityModel::destroy($id);
        return $re;
    }
    //admin添加城市
    public function adminAddCity($name){
        $city = new CityModel();
        $re = $city->save([
            'name'=>$name
        ]);
        return $re;
    }
}