<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/18
 * Time: 20:26
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\model\Image;
use app\api\model\Order;
use app\api\model\OrderProduct;
use app\api\model\ProductImage;
use app\api\model\ProductMainImage;
use app\api\model\Store;
use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\model\UserProducts;
use app\api\validate\IDMustBePostivelnt;
use app\lib\exception\ProductException;
use app\api\service\Token as TokenService;
use app\api\service\Token;
use app\api\model\Image as ImageModel;
use app\api\model\Store as StoreModel;
use think\console\command\make\Model;
use think\db\Query;
use think\Exception;
use think\exception\ErrorException;

class Product extends BaseController
{
    //获得最近新品
    //@url:api/:version/product/recent
    public function getRecent($count=10){
    	
        (new Count())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        if($house_id == 0){
            return "供货仓不存在";
        }
        //返回是数组
        $product = ProductModel::getMostRecent($count,$house_id);
        //获取用户id
         $uid = TokenService::getCurrentUid();
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        //模型暂时隐藏字段
        // $product = $product->hidden(['summary']);
        
        return $product;
    }
    //微信获得热点商品
    public function WxGetHotPro($count=10){
        (new Count())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        if($house_id == 0){
            return [
                'status'=>"失败",
            ];
        }
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('storehouse_id',$house_id)
            ->order('sales Desc')
            ->limit($count)
            ->select()
            ->toArray();
         //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        return $product;
    }
     //搜索商品
    public function search($value){
        //获得供货仓id
        $house_id = self::getHouseID();
        //$pro = new \app\api\model\Product();
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('storehouse_id',$house_id)
            ->where('name','like',"%".$value."%")
        	->where('category_id','<>',11)
            ->select()
            ->toArray();
             //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        return $product;
    }
    //获得分类商品
    //@url:api/:version/product/byCategory
    public function getAllCategory($id){
        (new IDMustBePostivelnt())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        $product = ProductModel::getProductByCategoryID($id,$house_id);
        //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        return $product;
    }
    
    //获得分类商品，价格正序
    public function getCateProPriceAsc($id){
        (new IDMustBePostivelnt())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('category_id','=',$id)
            ->where('storehouse_id',$house_id)
            ->order('price Asc')
            ->select()
            ->toArray();
             //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
      
        return $product;
    }
    //获得分类商品，价格倒序
    public function getCateProPriceDesc($id){
        (new IDMustBePostivelnt())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('category_id','=',$id)
            ->where('storehouse_id',$house_id)
            ->order('price Desc')
            ->select()
            ->toArray();
             //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        
        return $product;
    }
    //获得分类商品，销量正序
    public function getCateProSalesAsc($id){
        (new IDMustBePostivelnt())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('category_id','=',$id)
            ->where('storehouse_id',$house_id)
            ->order('sales Asc')
            ->select()
            ->toArray();
         //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
       
        return $product;
    }
    //获得分类商品，销量倒序
    public function getCateProSalesDesc($id){
        (new IDMustBePostivelnt())->goCheck();
        //获得供货仓id
        $house_id = self::getHouseID();
        $product = ProductModel::with([
            'imgs'=>function($query){
                $query->with('imgUrl');
            },'mainImgs'=>function($query){
                $query->with('imgUrl');
            }])->where('category_id','=',$id)
            ->where('storehouse_id',$house_id)
            ->order('sales Desc')
            ->select()
            ->toArray();
            
        //获取用户id
        $uid = TokenService::getCurrentUid();
        //$product['main_img_url'] = $product['main_imgs'][0]['img_url']['url'];
        //获得用户购买此商品的记录
    	foreach ($product as &$p){
    		$re = UserProducts::where('user_id',$uid)
            ->where('product_id',$p['id'])
            ->find();
        	$p['limit_counts'] -= $re['count'];
    	}
        return $product;
    }
    //获得商品详细信息
    //@url:api/:version/product/:id
    public function getOne($id=''){
        (new IDMustBePostivelnt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if(!$product){
            throw new ProductException();
        }
        if($product['main_imgs']){
        	$product['main_img_url']=$product['main_imgs'][0]['img_url']['url'];
        }
        //获取用户id
        $uid = TokenService::getCurrentUid();
        //获得用户购买此商品的记录
        $re = UserProducts::where('user_id',$uid)
            ->where('product_id',$product['id'])
            ->find();
        $product['limit_counts'] -= $re['count'];
        return $product;
    }

    //获得供货仓分类商品
    public function getCategoryProductByStorehouseID($page,$cate){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $product = new ProductModel();
        $re = $product->getProductByStorehouseID($uid,$page,$cate);
        if($re->isEmpty()){
            return 0;
        }
        return $re;

    }
    //获得供货仓分类商品数量
    public function getCategoryProCount($cate){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $product = new ProductModel();
        $re = $product->getProCountByStorehouseID($uid,$cate);
        if($re==0){
            throw new ProductException();
        }
        return $re;
    }
    //获得供货仓没货商品
    public function storehouseGetProductNo($page){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $page=($page-1) * 15;
        $re = ProductModel::with('category')
            ->where('storehouse_id','=',$uid)
            ->where('stock','<=',0)
            ->limit($page,15)
            ->select();
        return $re;
    }
    //获得供货仓没货商品数量
    public function storehousegetProNoCount(){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        $re =ProductModel::with('category')
            ->where('storehouse_id','=',$uid)
            ->where('stock','<=',0)
            ->select();
        return count($re);
    }
    //获得供货仓上个月销售最多和最少的商品
    public function storehouseGetProductHot($k){
        //获得供货仓id
        $uid = TokenService::getCurrentUid();
        //获得当前月份和时间
        $year = date("Y");
        $month = date("m");
        $end = strtotime($year."-".$month."-1 00:00:00");
        if($month-1<=0){
            $year--;
            $month=12;
        }else{
            $month--;
        }
        $begin = strtotime($year."-".$month."-1 00:00:00");
        //获得上个月所有订单
        $order = Order::where('storehouse_id',$uid)
            ->where('create_time','>=',$begin)
            ->where('create_time','<=',$end)
            ->where('status',3)
            ->select();
        $ID = Array();
        for($i = 0;$i<count($order);$i++){
            $ID[$i]=$order[$i]['id'];
        }
        //获得所有商品中卖出最多的三个
        if($k == 1){
            $re = OrderProduct::field('count(product_id) num,product_id')
                ->group('product_id')
                ->order('num desc')
                ->limit('10')
                ->select();
        } else if($k == 2){
            $re = OrderProduct::field('count(product_id) num,product_id')
                ->group('product_id')
                ->order('num asc')
                ->limit('10')
                ->select();
        }
        $num = Array();
        $id = Array();
        foreach ($re as $v){
            $num[$v['product_id']] = $v['num'];
            $id[] = $v['product_id'];
        }
        $pro = \app\api\model\Product::with('category')->select($id);
        //return $re;
        foreach ($pro as &$v){
            $v['num']=$num[$v['id']];
        }
        $len = count($pro);
        if($k == 1){
            while($len){
                $cou = $len;
                $len =0;
                for ($i=0;$i<$cou-1;$i++){
                    if($pro[$i]['num']<$pro[$i+1]['num']){
                        $key = $pro[$i];
                        $pro[$i]=$pro[$i+1];
                        $pro[$i+1]=$key;
                        $len = $i+1;
                    }
                }
            }
        }else if($k == 2){
            while($len){
                $cou = $len;
                $len =0;
                for ($i=0;$i<$cou-1;$i++){
                    if($pro[$i]['num']>$pro[$i+1]['num']){
                        $key = $pro[$i];
                        $pro[$i]=$pro[$i+1];
                        $pro[$i+1]=$key;
                        $len = $i+1;
                    }
                }
            }
        }

        return $pro;


    }
    //软删除供货仓商品
    public function delProduct($ids){
        $product = new ProductModel();
        //删除uid供货仓下的id是$id的商品
        $product->destroy($ids);
    }
    //修改商品
    public function updateProduct($ids,$name,$price,$category,$summary,$stock,$cost,$sales,$discount,$limit_counts,$sprice){
    	//return $discount;
        $pro = new ProductModel();
        return $pro->save([
            'name'=>$name,
            'price'=>$price,
            'category_id'=>$category,
            'summary'=>$summary,
            'stock'=>$stock,
            'cost'=>$cost,
            'sales'=>$sales,
            'discount'=>$discount,
            'limit_counts'=>$limit_counts,
            'sprice'=>$sprice
        ],['id' => $ids]);
    }
    //增加商品
    public function addProduct(){
            $mainImgIds = request()->post('mainImgIds');
            $sImgIds = request()->post('sImgIds');
            //product表增加数据
            $name = request()->post('name');
            $price = request()->post('price');
            $category = request()->post('category');
            $summary = request()->post('summary');
            $stock = request()->post('stock');
            $cost = request()->post('cost');
            $sales = request()->post('sales');
            $discount = request()->post('discount');
            $limit_counts = request()->post('limit_counts');
            $sprice = request()->post('sprice');
            $uid = TokenService::getCurrentUid();
            $pro = new ProductModel();
            $pro->data([
                'name' => $name,
                'price' => $price,
                'category_id' => $category,
                'summary' => $summary,
                'stock' => $stock,
                'storehouse_id' => $uid,
                'cost'=> $cost,
                'discount'=>$discount,
                'sales'=>$sales,
                'sprice'=>$sprice,
                'limit_counts'=>$limit_counts
            ]);
            $pro->save();
            //return $pro->id;
            if($pro->id){
                //return $mainImgIds[1];
                //往主图片表中添加数据
                $mImg = new ProductMainImage();
                //传过来是字符串，转为数组
                if($mainImgIds != ''){
                	$mainImgs = explode(",",$mainImgIds);
	                foreach($mainImgs as $p){
	                    $mImg->insert(['img_id'=>$p,'product_id'=>$pro->id]);
	                }
                }
                //往副图片表中添加数据
                $img = new ProductImage();
                if($sImgIds != ''){
                	$sImgs = explode(",",$sImgIds);
	                foreach ($sImgs as $p){
	                    $img->insert(['img_id'=>$p,'product_id'=>$pro->id]);
	                }
                }
                return $pro->id;
            }else{
                return null;
            }

            //image表增加数据
    }
    //修改时删除主图片
    public function delMainImg(){
        $imgId = input('post.imgId');
        $proId = input('post.proId');
        $mainImg = new ProductMainImage();
        $re = $mainImg->where('img_id',$imgId)
            ->where('product_id',$proId)
            ->find();
        //找到图片
        $img = Image::where('id',$re->img_id)
            ->find();
        //config('setting.img_prefix')是我图片的前缀域名，http://z.cn/,不用管
        $url = str_replace(config('setting.img_prefix'),'',$img->url);
        //将反斜杠都换一致
        $s=str_replace('\\', '/', '../public/images');
        //删除图片
        $r = unlink($s.$url);
        //删除表信息
        if($r){
            $re->delete();
            $img->delete();
        }
        return $r;
    }
    //修改时删除副图片
    public function delSImg(){
        $imgId = input('post.imgId');
        $proId = input('post.proId');
        $sImg = new ProductImage();
        $re = $sImg->where('img_id',$imgId)
            ->where('product_id',$proId)
            ->find();
        //找到图片
        $img = Image::where('id',$re->img_id)
            ->find();
        //config('setting.img_prefix')是我图片的前缀域名，http://z.cn/,不用管
        $url = str_replace(config('setting.img_prefix'),'',$img->url);
        //将反斜杠都换一致
        $s=str_replace('\\', '/', '../public/images');
        //删除图片
        $r = unlink($s.$url);
        //删除表信息
        if($r){
            $re->delete();
            $img->delete();
        }
        return $r;
    }
    //添加商品时删除图片，只需要删除image表里的数据
    public function delMainImgA(){
        $imgId = input('post.imgId');
        //找到图片
        $img = Image::where('id',$imgId)
            ->find();
        //config('setting.img_prefix')是我图片的前缀域名，http://z.cn/,不用管
        $url = str_replace(config('setting.img_prefix'),'',$img->url);
        //将反斜杠都换一致
        $s=str_replace('\\', '/', '../public/images');
        //删除图片
        $r = unlink($s.$url);
        //删除表信息
        if($r){
            $img->delete();
        }
        return $r;
    }
    //添加图片
    public function addImg($url){
        $img= new ImageModel();
        $img->save(['url'=>$url]);
        return $img->id;

    }
    //修改商品时添加主图片，需要添加image和product_main_image表
    public function uploadMainImg(){
        $file = request()->file('image');//获取上传图片
        $proId = input('post.proId');
        //return $proId;
        // 移动到框架应用根目录/public/images/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
            if ($info) {
                $getSaveName=str_replace("\\","/",$info->getSaveName());
                $img = $getSaveName;//获取名称
                $imgpath ='/'. $img;
                //存到image表
                $imgId = $this->addImg($imgpath);
                //存到product_main_image表
                $mImg = new ProductMainImage();
                $mImg->insert([
                    'img_id'=>$imgId,
                    'product_id'=>$proId
                ]);
                $path = 'images'. $imgpath;//数据库存储路径
                return [
                    'status' => 1,
                    'path' => $path,
                    'imgId'=>$imgId
                ];
            } else {
                $message = '图片上传失败';
                return ['status' => 0, 'message' => $message];
            }
        } else {
            $message = '图片上传失败';
            return ['status' => 0, 'message' => $message];
        }
    }
    //修改商品时添加副图片，向image和product_image表中添加数据
    public function uploadSImg(){
        $file = request()->file('image');//获取上传图片
        $proId = input('post.proId');
        //return $proId;
        // 移动到框架应用根目录/public/images/ 目录下
        if ($file) {
            $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
            if ($info) {
                $getSaveName=str_replace("\\","/",$info->getSaveName());
                $img = $getSaveName;//获取名称
                $imgpath ='/'. $img;
                //存到image表
                $imgId = $this->addImg($imgpath);
                //存到product_image表
                $sImg = new ProductImage();
                $sImg->insert([
                    'img_id'=>$imgId,
                    'product_id'=>$proId
                ]);
                $path = 'images'. $imgpath;//数据库存储路径
                return [
                    'status' => 1,
                    'path' => $path,
                    'imgId'=>$imgId
                ];
            } else {
                $message = '图片上传失败';
                return ['status' => 0, 'message' => $message];
            }
        } else {
            $message = '图片上传失败';
            return ['status' => 0, 'message' => $message];
        }
    }
//    //添加多个图片
//    public function addImgs(){
//        $file = request()->file('image');//获取上传图片
//        $proId = request()->post('proId');
//        // 移动到框架应用根目录/public/images/ 目录下
//        if ($file) {
//            $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
//            if ($info) {
//                $getSaveName=str_replace("\\","/",$info->getSaveName());
//                $img = $getSaveName;//获取名称
//                $imgpath ='/'. $img;
//                $imgId = $this->addImg($imgpath);
//
//                $proImg = new ProductImage();
//                $re=$proImg->save([
//                    'img_id'=>$imgId,
//                    'product_id'=>$proId
//                ]);
//
//                $path = 'images'. $imgpath;//数据库存储路径
//                return ['status' => 1, 'path' => $path];
//
//            } else {
//                $message = '图片上传失败';
//                return ['status' => 0, 'message' => $message];
//            }
//        } else {
//            $message = '图片上传失败';
//            return ['status' => 0, 'message' => $message];
//        }
//    }
    //添加商品图返回图片id和存储路径
    public function getImgIdUrl(){
        //return 1;
        $file = request()->file('image');//获取上传图片
        // 移动到框架应用根目录/public/images/ 目录下
        if ($file) {
            try{
                $info = $file->move(ROOT_PATH . 'public' . DS . 'images');
            }catch (Exception $e){
                echo "错误：".$e->getMessage();
            }

            if ($info) {
                $getSaveName=str_replace("\\","/",$info->getSaveName());
                $img = $getSaveName;//获取名称
                $imgpath ='/'. $img;
                $imgId = $this->addImg($imgpath);
                $path = 'images'. $imgpath;//数据库存储路径
                return [
                    'status' => 1,
                    'path' => $path,
                    'imgId'=>$imgId
                ];
            } else {
                $message = '图片上传失败';
                return ['status' => 0, 'message' => $message];
            }
        } else {
            $message = '图片上传失败';
            return ['status' => 0, 'message' => $message];
        }
    }

    //门店通过id，获得供货仓全部商品
    public function getProductsByStoreID($page){
        //获得门店id
        $uid = TokenService::getCurrentUid();
        $store = Store::get($uid);
        //供货仓id
        $house_id = $store->storehouse_id;
        $page=($page-1) * 15;
        $re = ProductModel::with('category')
                    ->with([
                        'imgs'=>function($query){
                            $query->with('imgUrl');
                        },'mainImgs'=>function($query){
                            $query->with('imgUrl');
                        }])
                    ->where('storehouse_id','=',$house_id)
                    ->limit($page,15)
                    ->select();
        if($re->isEmpty()){
            return 0;
        }
        return $re;

    }
    //门店通过id，获得供货仓商品数量
    public function getProductCountByStoreID(){
        //获得门店id
        $uid = TokenService::getCurrentUid();
        $store = Store::get($uid);
        //供货仓id
        $house_id = $store->storehouse_id;
        $list = ProductModel::where('storehouse_id','=',$house_id)
            ->select();
        return count($list);
    }
    //管理员获得商品
    public function adminGetProducts($page){
        $product = new ProductModel();
        $re = $product->adminGetProduct($page);
        if($re->isEmpty()){
            return 0;
        }
        return $re;
    }
    //管理员获得商品数量
    public function adminGetCount(){
        $product = new ProductModel();
        $re = $product->adminGetCount();
        if($re==0){
            throw new ProductException();
        }
        return $re;
    }

}