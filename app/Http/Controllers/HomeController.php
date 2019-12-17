<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            $use_whitelist = FALSE;
            if($use_whitelist){
                $arr_whitelist = array('::1','10.1.110.1');

                if(!in_array($request->ip(),$arr_whitelist) && $request->segment(1)!=='comingsoon')
                    return redirect('/comingsoon');

                if(in_array($request->ip(),$arr_whitelist) && $request->segment(1)=='comingsoon') return redirect('/');
            }
            return $next($request);
        });
    }

    public function comingsoon(){
        return view('comingsoon');
    }

    public function search(Request $request){
        $categories = DB::table('m_category_detail')
                        ->join('m_category_sub','m_category_detail.sc_id','=','m_category_sub.sc_id')
                        ->join('m_category','m_category_detail.mc_id','=','m_category.mc_id')
                        ->select('m_category_detail.*','m_category_sub.sc_name','m_category.mc_name')
                        ->whereIn('m_category_detail.dc_id',function($query){
                            $query->select('dc_id')
                                        ->from('m_product');
                        })
                        #->limit(5)
                        ->get();

        $arr_categories = [];
        $arr_products = [];

        $mc_prev = NULL;
        $sc_prev = NULL;
        $arr_names = [];
        foreach($categories as $category){
            if($mc_prev !== $category->mc_id){
                if(!in_array(@$category->mc_name,$arr_names)){
                    $arr_categories[] = ['id'=>encrypt($category->mc_id),'type'=>'mc','name'=>$category->mc_name,'avatar'=>NULL,'group'=>'Categories'];
                    $arr_names[] = $category->mc_name;
                }
            }
            if($sc_prev !== $category->sc_id){
                if(!in_array(@$category->sc_name,$arr_names)){
                    $arr_categories[] = ['id'=>encrypt($category->sc_id),'type'=>'sc','name'=>$category->sc_name,'avatar'=>NULL,'group'=>'Categories'];
                    $arr_names[] = $category->sc_name;
                }
            }

            if(!in_array($category->dc_name,$arr_names)){
                $arr_categories[] = ['id'=>encrypt($category->dc_id),'type'=>'dc','name'=>$category->dc_name,'avatar'=>NULL,'group'=>'Categories'];
                $arr_names[] = $category->dc_name;
            }
        }

        #dd($arr_categories_2);

        $products = DB::table('m_product')
                        ->join('m_product_image','m_product.prod_id','=','m_product_image.prod_id')
                        ->where('prod_status',1)
                        ->groupBy('m_product.prod_name')
                        ->get();

        foreach($products as $product){
            $arr_products[] = ['id'=>encrypt($product->prod_id),'name'=>$product->prod_name,'type'=>'product','avatar'=>url(config('config.productimageurl').$product->prod_image),'group'=>'Products'];
        }


        if (empty($arr_categories) && empty($arr_products)) $status = FALSE;
        else $status = TRUE;
        
        header('Content-Type: application/json');
        echo json_encode(array(
            "status" => $status,
            "error"  => null,
            "data"   => array(
                "categories" => $arr_categories,
                "products"   => $arr_products
            )
        ));
    }

    //

    public function index (Request $request){
        $product = DB::table('m_product')
                        ->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
                        ->select('m_product.*', 'm_customer.*')
                        ->where('prod_status',1)
                        ->orderBy('prod_id','desc')
                        ->get()->keyBy('prod_id');

        $arr_prod_id = array_keys($product->toArray());

        $count_cart = DB::table('t_cart_detail')
                        ->where('cust_id',$request->session()->get('cust_id'))
                        ->count();

        $productimage = DB::table('m_product_image')->whereIn('prod_id', $arr_prod_id)->get()->toArray();

        $arr_productimage = array();
        foreach($productimage as $key=>$val){
            $arr_productimage[$val->prod_id][$key] = $val;
        }

        ksort($arr_productimage, SORT_NUMERIC);

        $mc = DB::table('m_category')->get()->keyBy('mc_id');

        #dd($mc);

    	return view('home',['products'=>$product,'product_images'=>$arr_productimage,'mc'=>$mc]);
    }

    public function account(Request $request){

    }

    public function login(Request $request){
    	return view('login');
    }

    public function faq (Request $request){
      return view('faq');
    }

    public function tnc (Request $request){
      return view('tnc');
    }

    public function contact_us  (Request $request){
      return view('contact_us');
    }

    public function privacy (Request $request){
      return view('privacy');
    }

    public function about (Request $request){
      return view('about');
    }
}
