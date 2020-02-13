<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use Ixudra\Curl\Facades\Curl;
use DateTime;
use Illuminate\Support\Str;
use DB;

class TransactionController extends Controller
{
    public function __construct(Request $request){
        $this->middleware(function ($request, $next) {
            $arr_nosession = array('addToCartPage','doAddToCart','cart');

            if(!$request->session()->get('login') && !in_array($request->segment(2),$arr_nosession))
                return redirect('account/register');
            return $next($request);
        });
    }

    //
    public function addToCartPage(Request $request){
    	$prod_id = decrypt($request->prod_id);
    	$product = DB::table('m_product')
    						->leftJoin('m_category_detail', 'm_product.dc_id', '=', 'm_category_detail.dc_id')
    						->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
            				->select('m_product.*', 'm_category_detail.dc_name','m_customer.*')
    						->where([ 'prod_id'=>$prod_id ])->first();

    	$prodImages = DB::table('m_product_image')->where('prod_id',$product->prod_id)->get();

    	return view('transaction.addtocart',['product'=>$product,'product_images'=>$prodImages]);
    }

    public function doAddToCart(Request $request){
    	#echo '<pre>'; print_r($request->all()); echo '</pre>'; die;
        $account = new AccountController($request);
        $cust_id = $account->checkCookie($request);

    	$prod_id = decrypt($request->prod_id);

    	$cart = DB::table('t_cart_detail')->where(['prod_id'=>$prod_id,'cust_id'=>$request->session()->get('cust_id')])->get();

        $response = [];
    	if($cart->isEmpty()){
	    	DB::table('t_cart_detail')->insert(['prod_id'=>$prod_id,
	    										'cust_id'=>$request->session()->get('cust_id'),
	    										'qty'=>$request->qty,
	    										'addtime'=>date('Y-m-d H:i:s')]);
	    	$response['text'] = 'Berhasil ditambahkan ke Keranjang Belanja. <a href="'.url('transaction/cart').'" class="btn btn-primary">Lihat Keranjang Belanja</a>';
	    	$response['res'] = 'success';
	    } else {
	    	$response['text'] = 'Produk ini sudah ada di Keranjang Belanja. <a href="'.url('transaction/cart').'" class="btn btn-primary">Lihat Keranjang Belanja</a>';
	    	$response['res'] = 'danger';
	    }
        $response['count_cart'] = DB::table('t_cart_detail')->where('cust_id',$request->session()->get('cust_id'))
                        ->count();
	    return response()->json($response);
    }

    public function cart(Request $request){
        #die('cust_id = '.$request->session()->get('cust_id'));
    	$cart = DB::table('t_cart_detail')
                        ->join('m_product', 't_cart_detail.prod_id', '=', 'm_product.prod_id')
                        ->join('m_customer', 'm_product.cust_id', '=', 'm_customer.cust_id')
                        ->select('t_cart_detail.*', 'm_product.*','m_product.cust_id', 'm_customer.*')
                        ->where('t_cart_detail.cust_id',$request->session()->get('cust_id'))
                        ->orderBy('m_product.cust_id','desc')
                        ->get()->keyBy('prod_id');

        $arr_prod_id = array_keys($cart->toArray());

        $productimage = DB::table('m_product_image')->whereIn('prod_id', $arr_prod_id)->get()->toArray();

        $arr_productimage = array();
        foreach($productimage as $key=>$val){
            $arr_productimage[$val->prod_id][$key] = $val;
        }

        ksort($arr_productimage, SORT_NUMERIC);
        #echo '<pre>'; print_r($cart); echo '</pre>';
        #echo '<pre>'; print_r($arr_productimage); echo '</pre>';die;

        return view('transaction.cart',['cart'=>$cart,'product_images'=>$arr_productimage]);
    }

    public function countCartPrice(Request $request){
        $cart = DB::table('t_cart_detail')
                    ->join('m_product', 't_cart_detail.prod_id', '=', 'm_product.prod_id')
                    ->select('t_cart_detail.*', 'm_product.*')
                    ->where([   't_cart_detail.cust_id'=>$request->session()->get('cust_id'),
                                'm_product.cust_id'=>$request->owner_id   ])
                    ->orderBy('m_product.cust_id','desc')
                    ->get()->keyBy('prod_id');

        $price = 0;
        if($request->arr_qty){
            foreach($request->arr_qty as $key=>$val){
                $prod_id = decrypt($val['prod_id']);
                $price += ($cart[$prod_id]->prod_unit_price + $cart[$prod_id]->prod_insurance_cost) * $val['qty'];
            }
        }

        $price = $price * $request->durasi;

        if($price > 0)
            $service_charge = 5000;
        else $service_charge = 0;

        $response['price'] = 'Rp '.number_format($price,0,'.',',');
        $response['service_charge'] = 'Rp '.number_format($service_charge,0,'.',',');
        $response['subtotal'] = 'Rp '.number_format($price + $service_charge,0,'.',',');
        $response['enc_owner_id'] = encrypt($request->owner_id);

        return response()->json($response);
    }

    public function deleteCartProduct(Request $request){
        $prod_id = decrypt($request->prod_id);

        DB::table('t_cart_detail')
            ->where([   'cust_id'=>$request->session()->get('cust_id'),
                        'prod_id'=>$prod_id])->delete();

        $response['count_cart'] = DB::table('t_cart_detail')->where('cust_id',$request->session()->get('cust_id'))
                        ->count();

        return response()->json($response);
    }

    public function checkout(Request $request){
        if($request->owner_id){
            $owner_id = decrypt($request->owner_id);

            $is_complete = DB::table('m_customer')->where(  ['cust_id'=>$request->session()->get('cust_id'),
                                                            'cust_iscomplete'=>1]);
            if($is_complete->count()){

                $cart = DB::table('t_cart_detail')
                            ->join('m_product', 't_cart_detail.prod_id', '=', 'm_product.prod_id')
                            ->select('t_cart_detail.*', 'm_product.*')
                            ->where([   't_cart_detail.cust_id'=>$request->session()->get('cust_id'),
                                        'm_product.cust_id'=>$owner_id   ])
                            ->orderBy('m_product.cust_id','desc')
                            ->get()->keyBy('prod_id');

                $owner = DB::table('m_customer')
                            ->where('cust_id',$owner_id)->first();

                $checkout = $cart;
                //update qty
                $price = 0;
                foreach($cart as $key=>$val){
                    if($request->qty[$key])
                        $checkout[$key]->qty = $request->qty[$key];

                    $price += ($checkout[$key]->prod_unit_price + $checkout[$key]->prod_insurance_cost) * $checkout[$key]->qty;
                }
                #echo '<pre>cart = '; print_r($checkout); echo '</pre>';die;

                #dd($checkout);

                if($price > 0)
                    $service_charge = 5000;
                else $service_charge = 0;

                $tx = DB::table('t_transaction')->where(['cust_id'=>$request->session()->get('cust_id'),'tx_status'=>11]);
                if($tx->count()){
                    $reff_no = $tx->first()->reff_no;
                    $tx->delete();
                    DB::table('t_transaction_detail')->where('reff_no',$reff_no)->delete();
                }

                do{
                    $reff_no = 'R'.date('Ymd').strtoupper(Str::random(8));
                    $count = DB::table('t_transaction')->where('reff_no',$reff_no)->count();
                } while ($count > 0);

                DB::table('t_transaction')->insert([    'reff_no'=>$reff_no,
                                                        'cust_id'=>$request->session()->get('cust_id'),
                                                        'tx_addby'=>$request->session()->get('cust_id'),
                                                        'owner_id'=>$owner_id,
                                                        'tx_fee'=>$service_charge,
                                                        'tx_duration'=>$request->duration,
                                                        'tx_date'=>date('Y-m-d H:i:s'),
                                                        'tx_addtime'=>date('Y-m-d H:i:s'),
                                                        'tx_status'=>11
                                                        ]);

                foreach($checkout as $key=>$product){
                    DB::table('t_transaction_detail')->insert([ 'reff_no'=>$reff_no,
                                                                'prod_id'=>$product->prod_id,
                                                                'tra_price'=>$product->prod_unit_price,
                                                                'tra_qty'=>$product->qty,
                                                                'tra_insurance_cost'=>$product->prod_insurance_cost,
                                                                'tra_weight_unit'=>2,
                                                                'tra_weight_vol'=>$product->prod_weight_vol
                                                                ]);

                }
                /*
                $request->session()->flash('checkout',$checkout);
                $request->session()->flash('owner',$owner);
                $request->session()->flash('price','Rp '.number_format($price,0,'.',','));
                $request->session()->flash('service_charge','Rp '.number_format($service_charge,0,'.',','));
                $request->session()->flash('subtotal','Rp '.number_format($price + $service_charge,0,'.',','));
                */

                return redirect('transaction/checkout');
            } else {
                $request->session()->flash('errormessage','Data user Kamu belum lengkap. Silahkan lengkapi di menu <a class="btn btn-primary" href="'.url('account/update').'">Account</a>');
                return redirect('transaction/cart');
            }
        }
        else return abort(404);
    }

    function showCheckout(Request $request){
        #DB::enableQueryLog();
        $tx = DB::table('t_transaction')
                    ->join('m_customer','t_transaction.owner_id','=','m_customer.cust_id')
                    ->join('t_transaction_detail','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                    ->select('t_transaction.*','m_customer.*')
                    ->where(['t_transaction.cust_id'=>$request->session()->get('cust_id'),'tx_status'=>11])
                    ->groupBy('t_transaction.reff_no');

        $tx_price = $tx->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));
        $tx_insurance_cost = $tx->sum(DB::raw('t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty'));
        $tx_weight_vol = $tx->sum('t_transaction_detail.tra_weight_vol');

        $tx = $tx->get();

        #dd(DB::getQueryLog());

        if($tx->count()){

            $total_price = (($tx_price + $tx_insurance_cost) * $tx->first()->tx_duration)+$tx->first()->tx_fee;

            $suminfo = [    'tx_price' => $tx_price,
                            'tx_insurance_cost' => $tx_insurance_cost,
                            'tx_weight_vol' => $tx_weight_vol,
                            'tx_total_price' => $total_price
            ];

            $tx_detail = DB::table('t_transaction_detail')
                                ->join('t_transaction','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                                ->join('m_product','t_transaction_detail.prod_id','=','m_product.prod_id')
                                ->join('m_product_image','m_product.prod_id','=','m_product_image.prod_id')
                                ->select('t_transaction_detail.*','m_product.*','m_product_image.*')
                                ->where(['t_transaction.cust_id'=>$request->session()->get('cust_id'),'tx_status'=>11])
                                ->groupBy('t_transaction_detail.prod_id')
                                ->get();

            #dd($tx_detail);
            $account = new AccountController($request);
            $cust_addresses = $account->getAddressWithOptions($request->session()->get('cust_id'));

            $data_cust = $account->getAllCustData($request->session()->get('cust_id'));
            $data_owner = $account->getAllCustData($tx->first()->owner_id);

            $ongkir = $this->cekOngkir($data_owner,$data_cust,$tx_weight_vol);

            #dd($ongkir);

            return view('transaction.checkout',
                ['tx'=>$tx->first(),'suminfo'=>$suminfo,'tx_detail'=>$tx_detail,'data_cust'=>$data_cust,
                'data_owner'=>$data_owner,'cust_addresses'=>$cust_addresses,'ongkir'=>$ongkir]);
        }
        else return abort(404);
    }

    function cekOngkir($owner_data,$cust_data,$weight,$courier='jne:pos:tiki'){
        $arr_param = config('config.rajaongkir_key');
        $arr_param['origin'] = $owner_data->addr_kecamatan;
        $arr_param['originType'] = 'subdistrict';
        $arr_param['destination'] = $cust_data->addr_kecamatan;
        $arr_param['destinationType'] = 'subdistrict';
        $arr_param['weight'] = $weight*1000;
        $arr_param['courier'] = 'jne:pos:tiki';
        #dd($arr_param);
        $cost = Curl::to(config('config.rajaongkir_url').'cost')
                        ->withData( $arr_param )
                        ->post();
        $cost = json_decode($cost)->rajaongkir->results;

        return $cost;
    }

    public function cekCheckoutPrice(Request $request){
        $checkoutPrice = $this->getCheckoutPrice($request);

        $return = [ 'ship_price' => 'Rp '.number_format($checkoutPrice['ship_price'],0,'.',','),
                    'tx_deposit' => 'Rp '.number_format($checkoutPrice['tx_deposit'],0,'.',','),
                    'total_price' => 'Rp '.number_format($checkoutPrice['total_price'],0,'.',',')
        ];

        return response()->json($return);
    }

    public function details(Request $request){
        $reff_no = decrypt($request->reff_no);

        $tx = DB::table('t_transaction')
                ->join('m_customer','t_transaction.owner_id','=','m_customer.cust_id')
                ->join('t_transaction_detail','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                ->leftJoin('t_payment_method','t_transaction.reff_no','=','t_payment_method.reff_no')
                ->leftJoin('t_shipping','t_transaction.reff_no','=','t_shipping.reff_no')
                ->select('t_transaction.cust_id as real_cust_id','t_transaction.owner_id as real_owner_id',
                            't_transaction.*','m_customer.*','t_payment_method.*','t_shipping.*')
                ->where(['t_transaction.reff_no'=>$reff_no])
                ->orderBy('t_payment_method.tx_time', 'DESC')
                ->groupBy('t_transaction.reff_no');

        $tx_price = $tx->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));
        $tx_insurance_cost = $tx->sum(DB::raw('t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty'));
        $tx_weight_vol = $tx->sum('t_transaction_detail.tra_weight_vol');

        $tx = $tx->get();

        #dd($tx->first());

        if(in_array($tx->first()->tx_status,array(11,1))) return redirect('transaction/checkout');

        #dd(DB::getQueryLog());

        if($tx->count()){
            $account = new AccountController($request);

            $data_cust = $account->getAllCustData($tx->first()->real_cust_id);
            $data_owner = $account->getAllCustData($tx->first()->real_owner_id);

            if($tx->first()->real_cust_id==$request->session()->get('cust_id'))
                $actAs = 1; //penyewa barang
            elseif($tx->first()->real_owner_id==$request->session()->get('cust_id'))
                $actAs = 2; //pemilik barang

            $total_price = (($tx_price + $tx_insurance_cost) * $tx->first()->tx_duration)+$tx->first()->tx_fee;

            $suminfo = [    'tx_price' => $tx_price,
                            'tx_insurance_cost' => $tx_insurance_cost,
                            'tx_weight_vol' => $tx_weight_vol,
                            'tx_total_price' => $total_price
            ];

            if($tx->first()->tx_status==5){
                $start_time = \Carbon\Carbon::parse($tx->first()->tx_rentstart_date);

                $return_date = $start_time->addDays($tx->first()->tx_duration);
                $return_date = $return_date->format('d M Y');
            }

            $tx_detail = DB::table('t_transaction_detail')
                                ->join('t_transaction','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                                ->join('m_product','t_transaction_detail.prod_id','=','m_product.prod_id')
                                ->join('m_product_image','m_product.prod_id','=','m_product_image.prod_id')
                                ->select('t_transaction_detail.*','m_product.*','m_product_image.*')
                                ->where(['t_transaction.reff_no'=>$reff_no])
                                ->groupBy('t_transaction_detail.prod_id')
                                ->get();

            #dd($tx_detail);

            #dd($ongkir);

            return view('transaction.details',
                ['tx'=>$tx->first(),'suminfo'=>$suminfo,'tx_detail'=>$tx_detail,'data_cust'=>$data_cust,
                'data_owner'=>$data_owner,'step'=>@$request->step,'actAs'=>$actAs,'return_date'=>@$return_date]);
        }
        else return abort(404);
    }

    public function updateStatus(Request $request){
        #dd($request->all());

        $reff_no = decrypt($request->reff_no);
        $follow_up = decrypt($request->follow_up);

        $arr_update = ['tx_status'=>$follow_up,'tx_ket_status'=>$request->keterangan_status];

        if($follow_up==5) {
            $arr_update['tx_rentstart_date'] = date('Y-m-d H:i:s');

            $tx_detail = DB::table('t_transaction_detail')->where('reff_no',$reff_no);
            $amount = $tx_detail->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));

            DB::table('m_customer_balance')->insert(['reff_no'=>$reff_no,'cust_id'=>$request->session()->get('cust_id'),
                                                        'bal_type'=>2,'bal_amount'=>$amount]);
        }

        if($request->ship_resi){
            if($follow_up==4)
                $col = 'ship_resi';
            elseif($follow_up==13)
                $col = 'ship_resi_back';

            DB::table('t_shipping')->where('reff_no',$reff_no)->update([$col=>$request->ship_resi]);
        }

        DB::table('t_transaction')->where('reff_no',$reff_no)
            ->update($arr_update);

        $request->session()->flash('sucessmessage','Berhsail update status transaksi.');

        return redirect('transaction/details?reff_no='.$request->reff_no);
    }

    public function payRent(Request $request){
        $reff_no = decrypt($request->reff_no);
        $checkoutPrice = $this->getCheckoutPrice($request);

        #dd($request->all());

        require_once base_path('vendor/midtrans/midtrans-php/Midtrans.php');

        // Set your Merchant Server Key
        #\Midtrans\Config::$serverKey = 'SB-Mid-server-CP2Nwq_lYk2ASxMdNqBGQX2m';
        \Midtrans\Config::$serverKey = 'Mid-server-keJe6gDudd-ePNoY_QaqD2kC';

        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $transaction_details = array(
                'order_id' => decrypt($request->reff_no),
                'gross_amount' => $checkoutPrice['total_price']
        );

        #dd($request->session()->get('cust_email'));

        #if($request->session()->get('cust_email') == 'christophorus.dryantoro@telkom.co.id')
            $transaction_details['gross_amount'] = 1;

        $tx = DB::table('t_transaction')->where(['reff_no'=>$reff_no])->first();

        $account = new AccountController($request);
        $data_cust = $account->getAllCustData($request->session()->get('cust_id'));
        $data_owner = $account->getAllCustData($tx->owner_id);

        #dd($data_cust);

        $kec_info = $data_cust->kecamatan_info;
        $addr = 'Kecamatan '.$kec_info->subdistrict_name.', '.$kec_info->type.' '.$kec_info->city.', '.$kec_info->province;

        #dd($data_cust->addr_desc);

        $shipping_address = array(
            'first_name'    => $data_cust->cust_firstname,
            'last_name'     => $data_cust->cust_lastname,
            'address'       => $data_cust->addr_desc,
            'city'          => $kec_info->type.' '.$kec_info->city,
            'postal_code'   => '',
            'phone'         => $data_cust->cust_phone,
            'country_code'  => 'IDN'
            );

        $customer_details = array(
            'first_name'    => $data_cust->cust_firstname, //optional
            'last_name'     => $data_cust->cust_lastname, //optional
            'email'         => $data_cust->cust_email, //mandatory
            'phone'         => $data_cust->cust_phone, //mandatory
            'billing_address'  => $shipping_address, //optional
            'shipping_address' => $shipping_address //optional
            );

        $transaction = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
            //'item_details' => $item_details,
            );
        #dd($transaction);
        #die('test');
        $check_payment = DB::table('t_payment_method')->where(['reff_no'=>$reff_no])->count();

        #$status = \Midtrans\Transaction::status($reff_no);
        #dd($status);
        //if($status->transaction_status=='settlement'){
        if($check_payment){
            $return['is_paid'] = true;
            $return['reff_no'] = encrypt($reff_no);

        } else {
            $snapToken = \Midtrans\Snap::getSnapToken($transaction);
            $return['is_paid'] = false;
            $return['snap_token'] = $snapToken;
        }

        return response()->json($return);
    }

    public function finishPayment(Request $request){
        $reff_no = $request->order_id;

        DB::table('t_payment_method')
            ->insert([  'reff_no'=>$reff_no,
                        'pay_method'=>$request->payment_type,
                        'status_message'=>$request->status_message,
                        'transaction_status'=>$request->transaction_status,
                        'pay_method'=>$request->payment_type,
                        'mtrans_id'=>$request->transaction_id,
                        'gross_amount'=>$request->gross_amount,
                        'fraud_status'=>$request->fraud_status,
                        'tx_time'=>$request->transaction_time]);

        if($request->transaction_status=='settlement')
            $tx_status = 2;
        elseif($request->transaction_status=='pending')
            $tx_status = 12;
        else $tx_status = 1;

        DB::table('t_transaction')->where('reff_no',$reff_no)
            ->update(['tx_status'=>$tx_status]);


        /*$is_avail = DB::table('t_payment_method')->where('mtrans_id',$request->transaction_id)->count();
        if(!$is_avail){*/
        //}

        $is_avail = DB::table('t_shipping')->where(['reff_no'=>$reff_no,'ship_type'=>1])->count();

        if($request->ship_service_name && $request->ship_service_name !== 'false'){
            $ship_service = decrypt($request->ship_service_name);
            $tx_ship_price = explode("|", $ship_service, 2)[0];
            $ship_method = 2;
            $ship_courier = decrypt($request->ship_courier);
        } else {
            $ship_service = null;
            $tx_ship_price = 0;
            $ship_method = 1;
            $ship_courier = null;
        }

        $tx = DB::table('t_transaction')->where(['reff_no'=>$reff_no])->first();

        $account = new AccountController($request);
        $data_cust = $account->getAllCustData($request->session()->get('cust_id'));
        $data_owner = $account->getAllCustData($tx->owner_id);

        if(!$is_avail){
            $cust_addr = $data_cust->kecamatan_info;
            $owner_addr = $data_owner->kecamatan_info;
            DB::table('t_shipping')
                ->insert([  'reff_no'=>$reff_no,
                            'ship_type'=>1,
                            'ship_method'=>$ship_method,
                            'ship_courier'=>$ship_courier,
                            'ship_price'=>$tx_ship_price,
                            'ship_service_name'=>$ship_service,
                            'ship_status'=>1,
                            'addr_sender_kecamatan'=>$owner_addr->subdistrict_name,
                            'addr_sender_province'=>$owner_addr->province,
                            'addr_sender_phone'=>$data_owner->cust_phone,
                            'addr_sender_city'=>$owner_addr->type.' '.$owner_addr->city,
                            'addr_sender_desc'=>$data_owner->addr_desc,
                            'addr_receiver_kecamatan'=>$cust_addr->subdistrict_name,
                            'addr_receiver_province'=>$cust_addr->province,
                            'addr_receiver_phone'=>$data_cust->cust_phone,
                            'addr_receriver_city'=>$cust_addr->type.' '.$cust_addr->city,
                            'addr_receiver_desc'=>$data_cust->addr_desc]);
        }

        return redirect('transaction/details?reff_no='.encrypt($reff_no).'&step=step4');
    }

    public function myRents(Request $request){
        $tx = DB::table('t_transaction')
                    ->join('m_customer','t_transaction.owner_id','=','m_customer.cust_id')
                    ->join('t_transaction_detail','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                    #->leftJoin('t_product_review','t_product_review.tra_id','=','t_transaction.')
                    ->select('t_transaction.*','m_customer.*',
                        DB::raw('sum(t_transaction_detail.tra_price*t_transaction_detail.tra_qty) AS sum_price'),
                        DB::raw('sum(t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty) AS sum_insurance'))
                    ->where(['t_transaction.cust_id'=>$request->session()->get('cust_id')])
                    ->groupBy('t_transaction.reff_no');

        $tx_price = $tx->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));
        $tx_insurance_cost = $tx->sum(DB::raw('t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty'));
        $tx_weight_vol = $tx->sum('t_transaction_detail.tra_weight_vol');

        $tx = $tx->get();

        #dd($tx);

        if($tx->count()){
            #dd(DB::getQueryLog());
            /*
            $total_price = (($tx_price + $tx_insurance_cost) * $tx->first()->tx_duration)+$tx->first()->tx_fee;

            $suminfo = [    'tx_price' => $tx_price,
                            'tx_insurance_cost' => $tx_insurance_cost,
                            'tx_weight_vol' => $tx_weight_vol,
                            'tx_total_price' => $total_price
            ];*/

            $tx_detail = DB::table('t_transaction_detail')
                                ->join('t_transaction','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                                ->leftjoin('m_product','t_transaction_detail.prod_id','=','m_product.prod_id')
                                ->leftjoin('m_product_image','m_product.prod_id','=','m_product_image.prod_id')
                                ->select('t_transaction_detail.*','m_product.*','m_product_image.*')
                                ->where(['t_transaction.cust_id'=>$request->session()->get('cust_id')])
                                ->groupBy('t_transaction_detail.reff_no')
                                ->get();

            #dd($tx_detail);
            $account = new AccountController($request);
            $cust_addresses = $account->getAddressWithOptions($request->session()->get('cust_id'));

            $data_cust = $account->getAllCustData($request->session()->get('cust_id'));
            $data_owner = $account->getAllCustData($tx->first()->owner_id);

            #$ongkir = $this->cekOngkir($data_owner,$data_cust,$tx_weight_vol);


            $arr_tx_detail = [];
            foreach($tx_detail as $tx_det){
                $arr_tx_detail[$tx_det->reff_no][] = $tx_det;
            }
            #dd($arr_tx_detail);

            return view('transaction.myrents',
                ['tx'=>$tx,'tx_details'=>$arr_tx_detail,'data_cust'=>$data_cust,
                'data_owner'=>$data_owner,'cust_addresses'=>$cust_addresses]);
        } else return view('transaction.myrents');
    }

    public function myRentedStuffs(Request $request){
        $tx = DB::table('t_transaction')
                    ->join('m_customer','t_transaction.cust_id','=','m_customer.cust_id')
                    ->join('t_transaction_detail','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                    ->select('t_transaction.*','m_customer.*',
                        DB::raw('sum(t_transaction_detail.tra_price*t_transaction_detail.tra_qty) AS sum_price'),
                        DB::raw('sum(t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty) AS sum_insurance'))
                    ->where(['t_transaction.owner_id'=>$request->session()->get('cust_id')])
                    ->groupBy('t_transaction.reff_no');

        $tx_price = $tx->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));
        $tx_insurance_cost = $tx->sum(DB::raw('t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty'));
        $tx_weight_vol = $tx->sum('t_transaction_detail.tra_weight_vol');

        $tx = $tx->get();

        #dd($tx);

        if($tx->count()){
            $tx_detail = DB::table('t_transaction_detail')
                                ->join('t_transaction','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                                ->join('m_product','t_transaction_detail.prod_id','=','m_product.prod_id')
                                ->join('m_product_image','m_product.prod_id','=','m_product_image.prod_id')
                                ->select('t_transaction_detail.*','m_product.*','m_product_image.*')
                                ->where(['t_transaction.owner_id'=>$request->session()->get('cust_id')])
                                ->groupBy('t_transaction_detail.tra_id')
                                ->get();

            #dd($tx_detail);
            $account = new AccountController($request);

            $data_cust = $account->getAllCustData($tx->first()->cust_id);
            $data_owner = $account->getAllCustData($request->session()->get('cust_id'));

            #dd($tx_detail);

            $arr_tx_detail = [];
            $i = 1;
            foreach($tx_detail as $tx_det){
                #echo 'reff no = '.$tx_det->reff_no.'<br>';
                $arr_tx_detail[$tx_det->reff_no][] = $tx_det;
                $i++;
            }
            #dd($arr_tx_detail);
            #die;

            return view('transaction.myrentedstuffs',
                ['tx'=>$tx,'tx_details'=>$arr_tx_detail,'data_cust'=>$data_cust,
                'data_owner'=>$data_owner]);
        } else return view('transaction.myrentedstuffs');
    }

    private function getCheckoutPrice($request){
        if($request->reff_no)
            $reff_no = decrypt($request->reff_no);

        if($request->ship_service_name && $request->ship_service_name !== 'false'){
            $ship_service = decrypt($request->ship_service_name);
            $tx_ship_price = explode("|", $ship_service, 2)[0];
            $is_cod = FALSE;
        } else {
            $tx_ship_price = 0;
            $is_cod = TRUE;
        }

        $tx = DB::table('t_transaction')
                ->join('t_transaction_detail','t_transaction.reff_no','=','t_transaction_detail.reff_no')
                ->select('t_transaction.*')
                ->where(['t_transaction.reff_no'=>$reff_no])
                ->groupBy('t_transaction.reff_no');

        $tx_price = $tx->sum(DB::raw('t_transaction_detail.tra_price*t_transaction_detail.tra_qty'));
        $tx_insurance_cost = $tx->sum(DB::raw('t_transaction_detail.tra_insurance_cost*t_transaction_detail.tra_qty'));

        if(!$is_cod)
            $tx_deposit = ($tx_price + $tx_insurance_cost) * 10;
        else $tx_deposit = 0;
        $total_price = (($tx_price + $tx_insurance_cost) * $tx->first()->tx_duration)+$tx->first()->tx_fee + $tx_ship_price + $tx_deposit;
        
        $return = [ 'tx' => $tx,
                    'ship_price' => $tx_ship_price,
                    'tx_deposit' => $tx_deposit,
                    'total_price' => $total_price
        ];

        return $return;
    }

    public function addReviewPage(Request $request){
        $reff_no = decrypt($request->reff_no);

        $tra_details = DB::table('t_transaction_detail')
                        ->join('m_product','m_product.prod_id','=','t_transaction_detail.prod_id')
                        ->where('reff_no',$reff_no)
                        ->get()->keyBy('prod_id');

        $arr_prod_id = array_keys($tra_details->toArray());

        $productimage = DB::table('m_product_image')->whereIn('prod_id', $arr_prod_id)->get()->toArray();

        $arr_productimage = array();
        foreach($productimage as $key=>$val){
            $arr_productimage[$val->prod_id][$key] = $val;
        }

        ksort($arr_productimage, SORT_NUMERIC);

        return view('transaction.addReview',['tra_details'=>$tra_details,'product_images'=>$arr_productimage]);
    }
}
