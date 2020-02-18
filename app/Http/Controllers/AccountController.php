<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRegistrationRequest;
use App\Http\Requests\UserLoginRequest;
use Ixudra\Curl\Facades\Curl;
use Socialite;
use App\Customer;
use File;
use DB;
use Illuminate\Support\Str;
use Mail;
use Cookie;


class AccountController extends Controller
{
	public function __construct(Request $request){
		$this->middleware(function ($request, $next) {
			$arr_nosession = array('login','doLogin','register','doRegister','verifyEmail','forgetCookie','googleAuthSuccess','doFBAuth','doFBCallback');

			if(!$request->session()->get('login') && !in_array($request->segment(2),$arr_nosession))
				return redirect('account/login');
			return $next($request);
		});
	}

	public function index(Request $request){
		#die('cookie = '.Cookie::get('cust_id'));
		if($request->session()->get('login')){
			$customer = new Customer;
			$data_cust = $customer
							->leftJoin('m_customer_address','m_customer.cust_id','=','m_customer_address.cust_id')
							->leftJoin('m_customer_bank','m_customer.cust_id','=','m_customer_bank.cust_id')
							->leftJoin('m_bank_table','m_customer_bank.bank_id','=','m_bank_table.bank_id')
							->select('m_customer.cust_id as cust_id_real','m_customer.*','m_customer_address.*','m_customer_bank.*','m_bank_table.*')
							->where('m_customer.cust_email',$request->session()->get('email'))
							->first();

			#dd($data_cust);

			$cust_addresses = $this->getCustAddresses($data_cust);

			if($request->segment(2)=='update'){
				$view = 'account_update';
				$provinces = Curl::to(config('config.rajaongkir_url').'province')
								->withData( config('config.rajaongkir_key') )
        						->get();
        		$provinces = json_decode($provinces)->rajaongkir->results;
        		#echo '<pre>'; print_r($provinces); echo '</pre>';die;

        		$addresses_options = $this->getAddressWithOptions($data_cust->cust_id);

        		$banks = DB::table('m_bank_table')->get();

			} else{
				$view = 'account';
			}
    		return view('account.'.$view,['data'=>$data_cust,'provinces'=>@$provinces,
    			'cust_addresses'=>$cust_addresses,'banks'=>@$banks,'addresses_options'=>@$addresses_options]);
    	}
    	else{
    		return redirect('account/login');
    	}
	}

	public function checkCookie(Request $request){
		#Cookie::queue('cust_id', NULL, time() - 3600);
		#die('cookie = '.Cookie::get('cust_id'));
		if(!$request->session()->get('cust_id') && !$request->session()->get('login')){
			$cust_id = Cookie::get('cust_id');
			if($cust_id && $cust_id !== NULL){
				$cust = DB::table('m_customer')->where('cust_id',$cust_id)->first();
				$arr_session = array(	'cust_id' => $cust_id );
				session($arr_session);
			} else {
				$customer = new Customer;

				$customer->cust_addtime = date('Y-m-d H:i');
				$customer->cust_type = 1;

				$customer->save();

				die('id = '.$customer->cust_id);

				$arr_session = array(	'cust_id' => $customer->cust_id );
				Cookie::queue('cust_id', $customer->cust_id, 2628000);
				session($arr_session);
			}
		}
	}

	function forgetCookie(Request $request){
		Cookie::forget('cust_id');
		#$request->session()->flush();
		#$request->session()->forget('cust_id');
		die('cust_id = '.$request->session()->get('cust_id'));
		#die($request->session()->get('cust_id'));
		#echo '<pre>sess = '; print_r($request->all()); echo '</pre>';
		die('cookie forgotten');
	}

	public function doUpdate(Request $request){
		#echo '<pre>'; print_r($request->all());echo '</pre>';die;
		$validation = [
            'cust_firstname'=>'required|max:100',
            'cust_lastname'=>'required|max:100',
            'addr_desc'=>'required|max:255',
            'addr_provinsi'=>'required',
            'addr_kota'=>'required',
            'addr_kecamatan'=>'required',
            'bank_id'=>'required',
            'bank_account_no'=>'required',
            'bank_account_name'=>'required'
        ];

        $aliases = [
            'cust_firstname'=>'Nama Depan',
            'cust_lastname'=>'Nama Belakang',
            'addr_desc'=>'Alamat',
            'addr_provinsi'=>'Provinsi',
            'addr_kota'=>'Kota',
            'addr_kecamatan'=>'Kecamatan',
            'bank_id'=>'Bank',
            'bank_account_no'=>'Nomor Rekening',
            'bank_account_name'=>'Atas Nama Rekening'
        ];

		$request->validate($validation,[],$aliases);

		$cust_bday = date("Y-m-d", strtotime($request->cust_bday));
		if($request->cust_sex) $cust_sex = 1;
		else $cust_sex = 2;

		$arr_update = [	'cust_firstname' => $request->cust_firstname,
						'cust_lastname' => $request->cust_lastname,
						'cust_bday' => $cust_bday,
						'cust_sex' => $cust_sex,
						'cust_iscomplete' => 1
		];

		DB::table('m_customer')->where('cust_id',$request->session()->get('cust_id'))
			->update($arr_update);

		$cust_addr = DB::table('m_customer_address')->where('cust_id',$request->session()->get('cust_id'));

		$arr_update = [	'addr_desc' => $request->addr_desc,
						'addr_provinsi' => $request->addr_provinsi,
						'addr_kota' => $request->addr_kota,
						'addr_kecamatan' => $request->addr_kecamatan
						];

		if($cust_addr->count()){
			DB::table('m_customer_address')->where('cust_id',$request->session()->get('cust_id'))
				->update($arr_update);
		} else {
			$arr_update['cust_id'] = $request->session()->get('cust_id');
			$arr_update['addr_main'] = 1;
			DB::table('m_customer_address')->insert($arr_update);
		}

		$cust_bank = DB::table('m_customer_bank')->where('cust_id',$request->session()->get('cust_id'));

		$arr_update = [	'bank_id' => $request->bank_id,
						'bank_account_no' => $request->bank_account_no,
						'bank_account_name' => $request->bank_account_name,
						];

		if($cust_bank->count()){
			DB::table('m_customer_bank')->where('cust_id',$request->session()->get('cust_id'))
				->update($arr_update);
		} else {
			$arr_update['cust_id'] = $request->session()->get('cust_id');
			$arr_update['bank_status'] = 1;
			$arr_update['bank_addtime'] = date('Y-m-d H:i:s');
			DB::table('m_customer_bank')->insert($arr_update);
		}

		$request->session()->flash('successmessage', 'Informasi akun anda berhasil diupdate.');

		return redirect('account');
	}

	public function getAddrArea(Request $request){
		$arr_child = ['province'=>'city','city'=>'subdistrict'];

		$arr_param = config('config.rajaongkir_key');
		$arr_param[$request->type] = $request->search_data;
		$result = Curl::to(config('config.rajaongkir_url').$arr_child[$request->type])
							->withData( $arr_param )
    						->get();
    	$result = json_decode($result)->rajaongkir->results;

    	return response()->json($result);

    	#echo '<pre>'; print_r($result); echo '</pre>';die;
	}

	public function profile(Request $request){
		$cust_id = decrypt($request->cust_id);

		$customer = new Customer;
		$data_cust = $customer
						->leftJoin('m_customer_address','m_customer.cust_id','=','m_customer_address.cust_id')
						->select('m_customer.*','m_customer_address.*')
						->where('m_customer.cust_id',$cust_id)
						->first();

		$view = 'account';
		return view('account.'.$view,['data'=>$data_cust]);
	}

	public function login(Request $request){
		#die('test');
		return view('account.login');
	}

	public function doLogin(UserLoginRequest $request){
		$validator = Validator::make($request->all(),[]);

		Cookie::forget('cust_id');

		$customer = new Customer;
		$data_cust = $customer->where('cust_email',$request->cust_email)->first();

		if($data_cust->cust_password !== md5($request->cust_password)){
			$validator->after(function ($validator) {
				$validator->errors()->add('cust_password', 'Password tidak sesuai.');
			});
		}
		$validator->validate();

		$arr_session = array(	'email'	=> $request->cust_email,
								'cust_id' => $data_cust->cust_id,
								'cust_image' => $data_cust->cust_image,
								'login'	=> TRUE);
		session($arr_session);

		return redirect('account');
	}

	public function doGoogleAuth(Request $request){
		return Socialite::driver('google')->redirect();
	}

	public function doFBAuth(){
		return Socialite::driver('facebook')->redirect();
	}

	public function doFBCallback(){
		try {
            $user = Socialite::driver('facebook')->user();
            dd($user);
            $create['name'] = $user->getName();
            $create['email'] = $user->getEmail();
            $create['facebook_id'] = $user->getId();

            $userModel = new User;
            $createdUser = $userModel->addNew($create);
            Auth::loginUsingId($createdUser->id);


            return redirect()->route('home');


        } catch (Exception $e) {
            return redirect('account/doFBAuth');
        }
	}

	public function googleAuthSuccess(Request $request){
		$cust = 
		DB::table('m_customer')
			->where('cust_email',$request->cust_email);

		#dd($cust->get());

		if($cust->count()){
			$cust = $cust->first();
			$arr_session = array(	'email'	=> $cust->cust_email,
									'cust_id' => $cust->cust_id,
									'cust_image' => $cust->cust_image,
									'login'	=> TRUE);
			session($arr_session);
		} else {
			#dd($request->all());
			$customer = new Customer;

			$customer->cust_firstname = $request->cust_firstname;
			$customer->cust_lastname = $request->cust_lastname;
			$customer->cust_email = $request->cust_email;

			$customer->save();

			$arr_session = array(	'email'	=> $request->cust_email,
									'cust_id' => $customer->cust_id,
									'login'	=> TRUE);
			session($arr_session);
		}

		return redirect('account');
	}

	public function register(Request $request){
		return view('account.register');
	}

	public function doRegister(UserRegistrationRequest $request){
		if($request->isMethod('post')){
			$validator = Validator::make($request->all(),[])->validate();

			#successful validation

			if($cust_id = $request->session()->get('cust_id')){
				#$customer->firstOrNew(array('cust_id' => $cust_id));
				$customer = Customer::find($cust_id);
				#die('cust_id = '.$cust_id);
				Cookie::forget('cust_id');
			} else $customer = new Customer;

			$customer->cust_firstname = $request->firstname;
			$customer->cust_lastname = $request->lastname;
			$customer->cust_phone = $request->cust_phone;
			$customer->cust_email = $request->cust_email;
			$customer->cust_password = md5($request->cust_password);
			$customer->cust_addtime = date('Y-m-d H:i');
			$customer->cust_type = 1;

			$customer->save();

			$arr_session = array(	'email'	=> $request->cust_email,
									'cust_id' => $customer->cust_id,
									'login'	=> TRUE);
			session($arr_session);

			return redirect('account')->withCookie(Cookie::forget('cust_id'));
		} else {
			return redirect('account/register');
		}
	}

	public function verification(Request $request){
		$customer = new Customer;
		$data_cust = $customer->where('cust_email',$request->session()->get('email'))->first();

		if($data_cust->cust_phone_verified==2){
			$allowed_time = date('Y-m-d H:i:s', strtotime('-5 minutes'));
			$otp_active = date('Y-m-d H:i:s', strtotime($data_cust->cust_otp_time)) >= $allowed_time;

			$time_left = 300 - (strtotime(date("Y/m/d H:i:s")) - strtotime($data_cust->cust_otp_time));

			if($time_left < 0){
				DB::table('m_customer')->where('cust_id',$request->session()->get('cust_id'))
				->update(['cust_phone_verified'=>0]);
			}
		}

		#dd(date('Y-m-d H:i:s'));
		#dd($time_left);

		return view('account.verification',['data'=>$data_cust,'otp_active'=>@$otp_active,'time_left'=>@$time_left]);
	}

	public function doEmailVerification(Request $request){
		$validator = Validator::make($request->all(),['verif_email'=>'required|email|max:100'],[],['verif_email'=>'Email']);

		$customer = new Customer;
		if($request->verif_email !== $request->session()->get('email')){
			$is_exist = $customer->where('cust_email',$request->verif_email)->count();
			if($is_exist){
				$validator->after(function ($validator) {
					$validator->errors()->add('verif_email', 'Email sudah digunakan.');
				});
			}
		}


		$validator->validate();

		$verification_code = Str::random(20);
		$customer 	->where('cust_email',$request->session()->get('email'))
					->update([	'cust_email'=>$request->verif_email,
								'cust_email_verif_code'=>$verification_code]);

		session(['email'=>$request->verif_email]);

		#kirim email

		$customer = new Customer;
		$customer = $customer->where('cust_email',$request->verif_email)->first();

		$data = array(	'name'=>$customer->cust_firstname.' '.$customer->cust_lastname,
						'code'=>$verification_code);

	    Mail::send(['html'=>'mail.mailverification'], $data, function($message) use($customer,$request) {
	        $message->to($request->verif_email, $customer->cust_firstname)->subject
	           ('Verifikasi Email akun BROWS.id');
	        $message->from('cs@brows.id','BROWS - Platform Sewa Menyewa Barang Online');
	    });

		$request->session()->flash('verifEmail', $request->verif_email);
		return redirect('account/verification');
	}

	public function doPhoneVerification(Request $request){
		$validator = Validator::make($request->all(),
		['verif_phone'=>'required|regex:/(08)[0-9]{8,12}/|max:14'],[],['verif_phone'=>'No HP']);

		$customer = new Customer;
		if($request->verif_phone !== $request->session()->get('phone')){
			$is_exist = $customer->where('cust_phone',$request->verif_phone)
								->where('cust_id','!=',$request->session()->get('cust_id'))->count();
			if($is_exist){
				$validator->after(function ($validator) {
					$validator->errors()->add('verif_phone', 'No HP sudah terdaftar.');
				});
			}
		}
		$validator->validate();

		$cust_phone_otp = strval(mt_rand(100000,999999));
		$customer 	->where('cust_email',$request->session()->get('email'))
					->update([	'cust_phone'=>$request->verif_phone,
								'cust_phone_otp'=>$cust_phone_otp,
								'cust_phone_verified'=>2,
								'cust_otp_time'=>date('Y-m-d H:i:s')]);

		#Kirim OTP

		$customer = new Customer;
		$customer = $customer->where('cust_phone',$request->verif_phone)->first();

		$data = array(	'name'=>$customer->cust_firstname.' '.$customer->cust_lastname,
						'code'=>$cust_phone_otp);

		$phone_number = '62'.substr($customer->cust_phone,strpos($customer->cust_phone,'8'));

		#dd($cust_phone_otp);
		$content = $cust_phone_otp." adalah OTP BROWS Kamu. Kode ini bersifat rahasia.";

		$arr_param = [	'account'=>'numb_telkom3','password'=>'123456',
						'numbers'=>$phone_number,'content'=>$content];
	  	#$url = ' http://103.81.246.59:20003/sendsms?account=numb_telkom3&password=027697&numbers=Nomor-tujuan&content=Isi-SMS';
		$url = ' http://103.81.246.59:20003/sendsms';
		$response = Curl::to('http://103.81.246.59:20003/sendsms')
						->withData($arr_param)
						->get();

		#$request->session()->flash('verifPhone', $request->verif_phone);
		return redirect('account/verification');
	}

	public function checkOTP(Request $request){
		#dd($request->all());
		$otp = $request->verif_OTP;

		$cust = DB::table('m_customer')->where(['cust_id'=>$request->session()->get('cust_id'),'cust_phone_otp'=>$otp]);
		if($cust->count()){
			DB::table('m_customer')->where(['cust_id'=>$request->session()->get('cust_id')])
				->update(['cust_phone_verified'=>1]);
		} else {
			$request->session()->flash('error_otp','Kode OTP salah.');
		}
		return redirect('account/verification');
	}

	function verifyEmail(Request $request){
		$customer = new Customer;
		$customer = $customer->where('cust_email_verif_code',$request->code)->first();

		if(!@$customer->cust_email) return abort(404);

		$arr_session = array(	'email'	=> $customer->cust_email,
								'cust_id' => $customer->cust_id,
								'cust_image' => $customer->cust_image,
								'login'	=> TRUE);
		session($arr_session);

		$customer 	->where('cust_email',$customer->cust_email)
					->update([	'cust_email_verified'=>1]);

		$request->session()->flash('successmessage', 'Selamat, verifikasi email berhasil.');

		return redirect('account/verification');
	}

	function doUploadID(Request $request){
		#echo '<pre>files = '; print_r($request->file()); echo '</pre>'; die;
		#echo '<pre>postdata = '; print_r($request->file('fotoID')->getClientOriginalExtension()); echo '</pre>'; die;
		#echo '<pre>postdata = '; print_r($request->file('fotoID')); echo '</pre>'; die;
		$request->validate([
            'fotoID' => 'required',
            'fotoDiri' => 'required'
		]);

		$customer = new Customer;
		$data_cust = $customer->where('cust_email',$request->session()->get('email'))->first();

		$filename_id = array();
		foreach($request->file() as $key=>$val){
			#die('ext = '.$val->getClientOriginalExtension());
			#echo '<pre>val = '; print_r($val); echo '</pre>';die;
			$fileName = 'CUST'.str_pad($data_cust->cust_id,20,'0',STR_PAD_LEFT).'.'.$val->getClientOriginalExtension();
 			#die('pathname = '.public_path('resources\fileUploads\\').$fileName);
        	#$request->file->move(public_path('resources\fileUploads\\'), $fileName);
        	#$request->file('fotoID')->move(public_path('resources\fileUploads\\'), $fileName);
        	copy($val->getRealPath(), public_path('resources/fileUploads/'.$key.'/').$fileName);
        	$filename_id[$key] = $fileName;
		}

		$customer 	->where('cust_email',$request->session()->get('email'))
					->update([	'cust_nik_verified'=>2,
								'cust_nik_filename'=>$filename_id['fotoID'],
								'cust_nik2_filename'=>$filename_id['fotoDiri']]);

        return response()->json(['success'=>'You have successfully upload file.']);
	}

	function doUploadDP(Request $request){
		$request->validate([
            'cust_image' => 'required|mimetypes:image/jpeg,image/png'
		],[],['cust_image'=>'Foto Profil']);

		$customer = new Customer;
		$data_cust = $customer->where('cust_email',$request->session()->get('email'))->first();

		$imagedata = $request->file('cust_image');
		$fileName = 'CUST'.str_pad($data_cust->cust_id,20,'0',STR_PAD_LEFT).'.'.$imagedata->getClientOriginalExtension();
		$path = public_path('resources/fileUploads/displayPictures/').$fileName;
		if(file_exists($path)) unlink($path);
		copy($imagedata->getRealPath(), $path);

		$fileName = $fileName.'?cf='.date('Ymdhis');
		$customer 	->where('cust_email',$request->session()->get('email'))
					->update([	'cust_image'=>$fileName ]);

		session(['cust_image'=>$fileName]);

		return response()->json(['success'=>'You have successfully upload file.',
								'imgurl'=>url('public/resources/fileUploads/displayPictures/'.$fileName),
								'imgID'=>'imagePreview']);
	}

	public function logout(Request $request){
		$request->session()->flush();
		return redirect('account');
	}

	public function getAllCustData($cust_id){
		$data_cust = DB::table('m_customer')
						->join('m_customer_address','m_customer.cust_id','=','m_customer_address.cust_id')
						->select('m_customer.*','m_customer_address.*')
						->where('m_customer.cust_id',$cust_id)->first();

		$data_cust->kecamatan_info = $this->getKecamatan($data_cust->addr_kecamatan);

		return $data_cust;
	}

	public function getAddressWithOptions($cust_id){
		$data_cust = DB::table('m_customer_address')
						->where('cust_id',$cust_id)->first();

		$provinces = Curl::to(config('config.rajaongkir_url').'province')
				->withData( config('config.rajaongkir_key') )
				->get();
		$provinces = json_decode($provinces)->rajaongkir->results;

		if(@$data_cust->addr_provinsi){
			$arr_param = config('config.rajaongkir_key');
			$arr_param['province'] = $data_cust->addr_provinsi;
			$cities = Curl::to(config('config.rajaongkir_url').'city')
							->withData( $arr_param )
    						->get();
    		$cities = json_decode($cities)->rajaongkir->results;
    	} else $cities = [];

		if(@$data_cust->addr_kota){
			$arr_param = config('config.rajaongkir_key');
			$arr_param['city'] = $data_cust->addr_kota;
			$subdistrics = Curl::to(config('config.rajaongkir_url').'subdistrict')
							->withData( $arr_param )
    						->get();
    		$subdistrics = json_decode($subdistrics)->rajaongkir->results;
    	} else $subdistrics = [];

    	return [	'provinces'=>$provinces,
    				'cities'=>$cities,
    				'subdistrics'=>$subdistrics
    	];
	}

	public function getCustAddresses($data_cust){
		if($data_cust->addr_provinsi){
			$arr_param = config('config.rajaongkir_key');
			$arr_param['id'] = $data_cust->addr_provinsi;
			$provinces = Curl::to(config('config.rajaongkir_url').'province')
							->withData( $arr_param )
    						->get();
    		$provinces = json_decode($provinces)->rajaongkir->results;
    	}

		if($data_cust->addr_kecamatan){
			$arr_param = config('config.rajaongkir_key');
			$arr_param['id'] = $data_cust->addr_kecamatan;
			$districts = Curl::to(config('config.rajaongkir_url').'subdistrict')
							->withData( $arr_param )
    						->get();
    		$districts = json_decode($districts)->rajaongkir->results;
    		#echo '<pre>'; print_r($districts); echo '</pre>';die;
    	}

		if($data_cust->addr_kota){
			$arr_param = config('config.rajaongkir_key');
			$arr_param['id'] = $data_cust->addr_kota;
			$cities = Curl::to(config('config.rajaongkir_url').'city')
							->withData( $arr_param )
    						->get();
    		$cities = json_decode($cities)->rajaongkir->results;
    	}

    	$return = new \stdClass;
    	$return->province = @$provinces->province;
    	$return->city = @$cities->type.' '.@$cities->city_name;
    	$return->district = @$districts->subdistrict_name;

    	return $return;
	}

	public function getKecamatan($id_kecamatan){
		$arr_param = config('config.rajaongkir_key');
		$arr_param['id'] = $id_kecamatan;
		$districts = Curl::to(config('config.rajaongkir_url').'subdistrict')
						->withData( $arr_param )
						->get();
		$district = json_decode($districts)->rajaongkir->results;

		return $district;
	}

}
