<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use DB;

class ProductController extends Controller
{
    //
	public function __construct(Request $request){
		$this->middleware(function ($request, $next) {
			$arr_nosession = array('details','catalog');

			if(!$request->session()->get('login') && !in_array($request->segment(2),$arr_nosession))
				return redirect('account/login');
			return $next($request);
		});
	}

    public function index(Request $request){
    	$product = DB::table('m_product')
    					->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
            			->select('m_product.*', 'm_customer.*')
    					->where('m_product.cust_id',$request->session()->get('cust_id'))
    					->where('prod_status','!=',4)
                        ->orderBy('prod_id','desc')
    					->get()->keyBy('prod_id');

    	#echo '<pre>prod ids = '; print_r($product); echo '</pre>'; die;
    	$arr_prod_id = array_keys($product->toArray());
    	#echo '<pre>prod ids = '; print_r($arr_prod_id); echo '</pre>'; die;
    	$productimage = DB::table('m_product_image')->whereIn('prod_id', $arr_prod_id)->get()->toArray();

    	#echo '<pre>productimages = '; print_r($productimage); echo '</pre>'; die;

    	$arr_productimage = array();
    	foreach($productimage as $key=>$val){
    		$arr_productimage[$val->prod_id][$key] = $val;
    	}

    	ksort($arr_productimage, SORT_NUMERIC);

    	return view('product.product',['products'=>$product,'product_images'=>$arr_productimage]);
    }

    public function catalog(Request $request){
        if($request->dc){
            $dc = decrypt($request->dc);
            $arr_where = ['m_category_detail.dc_id'=>$dc];
            $rs_category = DB::table('m_category_detail')->where('dc_id',$dc)->first();
            $mc_id = $rs_category->mc_id;
            $sc_id = $rs_category->sc_id;
            $dc_id = $rs_category->dc_id;
        } elseif($request->sc){
            $sc = decrypt($request->sc);
            $arr_where = ['m_category_detail.sc_id'=>$sc];
            $rs_category = DB::table('m_category_detail')->where('sc_id',$sc)->first();
            $mc_id = $rs_category->mc_id;
            $sc_id = $rs_category->sc_id;
        } elseif($request->mc){
            $mc_id = $mc = decrypt($request->mc);
            $arr_where = ['m_category_detail.mc_id'=>$mc];
        } else {
            $arr_where = [];
        }

        $product = DB::table('m_product')
                        ->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
                        ->join('m_category_detail','m_product.dc_id','=','m_category_detail.dc_id')
                        ->select('m_product.*', 'm_customer.*')
                        #->where('m_product.cust_id',$request->session()->get('cust_id'))
                        ->where('prod_status',1)
                        ->where($arr_where)
                        ->orderBy('prod_id','desc')
                        ->get()->keyBy('prod_id');

        $arr_prod_id = array_keys($product->toArray());
        #echo '<pre>prod ids = '; print_r($arr_prod_id); echo '</pre>'; die;
        $productimage = DB::table('m_product_image')->whereIn('prod_id', $arr_prod_id)->get()->toArray();

        #echo '<pre>productimages = '; print_r($productimage); echo '</pre>'; die;

        $arr_productimage = array();
        foreach($productimage as $key=>$val){
            $arr_productimage[$val->prod_id][$key] = $val;
        }

        ksort($arr_productimage, SORT_NUMERIC);

        $m_categories = DB::table('m_category')
                            ->join('m_category_detail','m_category.mc_id','=','m_category_detail.mc_id')
                            ->whereIn('m_category_detail.dc_id',function($query){
                                $query->select('dc_id')
                                            ->from('m_product');
                            })
                            ->get();

        $categories = DB::table('m_category_detail')
                            ->join('m_category','m_category_detail.mc_id','=','m_category.mc_id')
                            ->join('m_category_sub',function($join){
                                $join->on('m_category_detail.sc_id','=','m_category_sub.sc_id');
                                $join->on('m_category_detail.mc_id','=','m_category_sub.mc_id');
                            })
                            ->select('m_category_detail.*','m_category.mc_name','m_category_sub.sc_name')
                            ->whereIn('m_category_detail.dc_id',function($query){
                                $query->select('dc_id')
                                            ->from('m_product');
                            })
                            ->orderBy('m_category_detail.mc_id','asc')
                            ->orderBy('m_category_detail.sc_id','asc')
                            ->orderBy('m_category_detail.dc_id','asc')
                            #->where($arr_where)
                            ->groupBy('mc_id','sc_id','dc_id')
                            ->get();

        #dd($categories);

        $arr_categories = [];
        foreach($categories as $category){
            $arr_categories[$category->mc_id][] = $category;
        }

        #dd($arr_categories);

        return view('product.catalog',['products'=>$product,'product_images'=>$arr_productimage,
                    'm_categories'=>$m_categories,'d_categories'=>$arr_categories,'mc_id'=>@$mc_id,'sc_id'=>@$sc_id,'dc_id'=>@$dc_id]);
    }

    public function details(Request $request){
    	$category = DB::table('m_category')->get()->keyBy('mc_id');
    	$sub_category = DB::table('m_category_sub')->get()->keyBy('sc_id');
    	$detail_category = DB::table('m_category_detail')
                                ->join('m_category','m_category_detail.mc_id','=','m_category.mc_id')
                                ->join('m_category_sub',function($join){
                                    $join->on('m_category_detail.sc_id','=','m_category_sub.sc_id');
                                    $join->on('m_category_detail.mc_id','=','m_category_sub.mc_id');
                                })
                                ->orderBy('m_category_detail.mc_id','asc')
                                ->orderBy('m_category_detail.sc_id','asc')
                                ->orderBy('m_category_detail.dc_id','asc')
                                ->get();

    	if($request->get('prod_id'))
    		$wheredata = [  'prod_id'=>decrypt($request->prod_id) ];
    	else
    		$wheredata = ['prod_status'=>4,'m_product.cust_id'=>$request->session()->get('cust_id')];

        #dd($wheredata);

    	$newProduct = DB::table('m_product')
    						->leftJoin('m_category_detail', 'm_product.dc_id', '=', 'm_category_detail.dc_id')
    						->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
            				->select('m_product.*', 'm_category_detail.dc_name','m_customer.*')
    						->where($wheredata)->get();

    	$firstImage = 'placeholder.png';
    	if($newProduct->isEmpty()){
    		$page_stat = 'new';
    		$prodID = DB::table('m_product')
    					->insertGetId(['cust_id'=>$request->session()->get('cust_id'),'prod_status'=>4]);

			$newProduct = DB::table('m_product')
				->leftJoin('m_category_detail', 'm_product.dc_id', '=', 'm_category_detail.dc_id')
				->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
				->select('m_product.*', 'm_category_detail.dc_name','m_customer.*')
				->where($wheredata)->get();
    		$prodImages = [];
    		$placeholder_count = 8;
    	} else {
    		if($newProduct->first()->cust_id == $request->session()->get('cust_id') && $request->segment(2)=='upload'){
    			if($newProduct->first()->prod_status==4) $page_stat = 'new';
    			else $page_stat = 'edit';
    		} else $page_stat = 'view';

    		$prodID = $newProduct->first()->prod_id;

    		$prodImages = DB::table('m_product_image')->where('prod_id',$prodID)->get();
    		$placeholder_count = 8 - $prodImages->count();
    		if($prodImages->first())
    			$firstImage = $prodImages->first()->prod_image;
    	}

    	$arr_data = ['categories'=>$category,'sub_categories' => $sub_category,'detail_categories'=>$detail_category,
    				'prod_id' => encrypt($prodID), 'prod_images' => $prodImages, 'first_image' => $firstImage,
    				'prod_data'=>$newProduct->first(),'page_stat' => $page_stat,
    				'placeholder_count' => $placeholder_count, 'imgurl' => url('public/resources/fileUploads/productImages/')];

    	if($page_stat=='view') return view('product.upload_view',$arr_data);
    	else return view('product.upload_edit',$arr_data);
    }

    public function doUploadImage(Request $request){
    	$customer = new Customer;
		$data_cust = $customer->where('cust_email',$request->session()->get('email'))->first();
		$cust_id_folder = 'CUST'.str_pad($data_cust->cust_id,8,'0',STR_PAD_LEFT);

		$prod_id = decrypt($request->prod_id);
		$image_index = $request->image_index;

		if($image_index == 'undefined'){
			$maxIndex = DB::table('m_product_image')->where(['prod_id'=>$prod_id])->max('image_id');

			if(!$maxIndex) $image_index = 1;
			else $image_index = $maxIndex+1;
		}

		$fileName = 'PROD'.str_pad($prod_id,8,'0',STR_PAD_LEFT).'-'.'IMG0'.$image_index.'.'.$request->file('productImage')->getClientOriginalExtension();
		$directory = public_path('resources/fileUploads/productImages/'.$cust_id_folder.'/');
		$path = $directory.$fileName;
		if (!file_exists($directory)) mkdir($directory, 0777, true);
		
		if(file_exists($path)) unlink($path);
		$imagedata = $request->file('productImage');
		copy($imagedata->getRealPath(), $path);

		$fileName = $cust_id_folder.'/'.$fileName.'?cf='.date('Ymdhis');

		$imageRecord = DB::table('m_product_image')->where(['prod_id'=>$prod_id,'image_id'=>$image_index])->get();

		if($imageRecord->isEmpty()){
			DB::table('m_product_image')->insert(['prod_id'=>$prod_id,'image_id'=>$image_index,'prod_image'=>$fileName]);
		} else {
			DB::table('m_product_image')
				->where(['prod_id'=>$prod_id,'image_id'=>$image_index])
				->update(['prod_image'=>$fileName]);
		}

		return response()->json(['success'=>'You have successfully upload file.',
								'imgurl'=>url('public/resources/fileUploads/productImages/'.$fileName),
								'image_index'=>$image_index]);
    }

    public function deleteImage(Request $request){
    	$data_image = DB::table('m_product_image')->where(['prod_id'=>decrypt($request->prod_id),'image_id'=>$request->img_id]);
    	#echo '<pre>imagedata = '; print_r($data_image); echo '</pre>'; die;
    	$data_image_first = $data_image->first();
    	$path = public_path('resources/fileUploads/productImages/'.substr($data_image_first->prod_image,0,strpos($data_image_first->prod_image,'?')));
    	if(file_exists($path)) unlink($path);
    	$data_image->delete();

    	return response()->json(['success'=>'You have deleted the file',
								'imgurl'=>url('public/resources/fileUploads/productImages/placeholder.png')]);
    }

    public function countPrice(Request $request){
    	if($request->rent_price == ''){
    		$is_empty = TRUE;
    		$rent_price = 0;
    		$insurance_cost = 0;
    	} else {
    		$rent_price = $request->rent_price;
    		if($request->is_insuranced=='true'){
	    		if((.1*$rent_price) < 10000) $insurance_cost = 10000;
	    		else $insurance_cost = .1*$rent_price;
	    	} else $insurance_cost = 0;
    		$is_empty = FALSE;
    	}

    	$total_cost = $rent_price+$insurance_cost;

    	$insurance_cost = number_format($insurance_cost, 0, ".", ",");
    	$total_cost = number_format($total_cost, 0, ".", ",");
    	return response()->json([	'is_empty' => $is_empty,
    								'insurance_cost'=>'Rp '.$insurance_cost,
    								'total_cost'=>'Rp '.$total_cost]);
    }

    public function doProductUpload(Request $request){

        #dd($request);

        #$validator = Validator::make($request->all(),[]);

        $prod_id = decrypt($request->prod_id);

        $request->validate([
            'prod_name' => 'required|max:250',
            'dc_id' => 'required',
            'prod_desc' => 'required|max:1500',
            'prod_unit_price' => 'required',
            'prod_stock' => 'required',
            'prod_weight_vol' => 'required'
        ],[],[  'prod_name' => 'Nama Barang',
                'dc_id' => 'Kategori Barang',
                'prod_desc' => 'Deskripsi Produk',
                'prod_unit_price' => 'Harga Sewa',
                'prod_stock' => 'Jumlah Stok',
                'prod_weight_vol' => 'Berat Satuan']);

        #$validator->validate();

    	#echo '<pre>inputs = '; print_r($request->all()); echo '</pre>';die;

    	$prod_unit_price = preg_replace('/[^0-9]/','',$request->prod_unit_price);
    	$prod_weight_vol = preg_replace('/[^0-9.]/','',$request->prod_weight_vol);

    	if($request->prod_insurance){
    		$prod_insurance = 1;

    		if((.1*$prod_unit_price) < 10000) $insurance_cost = 10000;
	    		else $insurance_cost = .1*$prod_unit_price;
    	} else {
    		$prod_insurance = 0;

    		$insurance_cost = 0;
    	}

        $prod = DB::table('m_product')->select('cust_id')->where('prod_id',$prod_id)->first();

        #dd($prod_id);
        $cust = DB::table('m_customer')->where('cust_id',@$prod->cust_id)->first();

        $prod_addtime = NULL;
        $prod_updatetime = NULL;
    	if($request->btn_savedraft){
            $prod_status = 5;
            $prod_updatetime = date('Y-m-d H:i:s');
            $request->session()->flash('successmessage', 'Produk berhasil disimpan sebagai DRAFT.');
    	} elseif($request->btn_publishproduct){
            if(@$cust->cust_iscomplete == 0){
                $request->session()->flash('successmessage', 'Produk disimpan sebagai DRAFT.
                    Untuk mempublish produk, silahkan lengkapi data user di menu <a href="'.url('account/update').'">Account</a>');
                $prod_status = 5;
                #die('masuk sini '.@$cust->cust_iscomplete);
            }
            else {
                $request->session()->flash('successmessage', 'Produk berhasil dipublish.');
                $prod_status = 1;
            }
            $prod_addtime = date('Y-m-d H:i:s');
        }

    	$arr_update = ['prod_name'=>$request->prod_name,
    					'dc_id'=>$request->dc_id,
    					'prod_desc'=>$request->prod_desc,
    					'prod_unit_price'=>$prod_unit_price,
    					'prod_stock'=>$request->prod_stock,
                        'prod_weight_unit'=>2,
    					'prod_weight_vol'=>$prod_weight_vol,
    					'prod_insurance'=>$prod_insurance,
    					'prod_insurance_cost'=>$insurance_cost,
    					'prod_status'=>$prod_status,
                        'prod_addtime'=>$prod_addtime,
                        'prod_updatetime'=>$prod_updatetime];

    	$prodID = DB::table('m_product')
    					->where('prod_id',$prod_id)
    					->update($arr_update);

        return redirect('product');
    }
}
