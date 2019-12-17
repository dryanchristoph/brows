@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Verifikasi Akun</span></li>
                <li class="cd-float-right"><a href="{{ url('account/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <div class="row">
                @include('includes/sidemenu')
                <div class="col-md-9 aside">
                    <h2>Verifikasi Akun</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            @if(Session::get('successmessage'))
                            	<div class = "alert alert-success">
                                   {{ Session::get('successmessage') }}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class = "alert alert-danger">
                                   <ul>
                                      @foreach ($errors->all() as $error)
                                         <li>{{ $error }}</li>
                                      @endforeach
                                   </ul>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <h3>Email
                                    	@if($data->cust_email_verified == 1)
	                                    	<span class="badge badge-success">Verified</span>
	                                    @endif
                                    </h3>

		                            @if($data->cust_email_verified == 0)
			                            @if ($email = Session::get('verifEmail'))
			                            	<div class="alert alert-success">
			                            		Link verifikasi email telah dikirimkan ke alamat email Anda. <br />
			                            		Harap periksa email Anda : <br />
			                            		<span class="badge badge-warning">{{ $email }}</span>
			                            	</div>
			                            @else
			                            <form method="POST" action="{{ url('account/doEmailVerification')  }}">
			                            	{{ csrf_field() }}
		                                    <div class="row mt-2">
			                                    <div class="form-group cd-full-width">
			                                    	<input type="text" name="verif_email" class="form-control" value="{{ old('verif_email') ? old('verif_email') : $data->cust_email }}">
			                                    </div>
			                                </div>
			                                @if(old('verif_email'))
			                                	<div class="row mt-2">
			                                		<a href="{{ url('account/verification') }}" class="float-right">Reset</a>
			                                	</div>
			                                @endif
				                            <div class="row mt-2">
				                            	<button type="submit" class="btn">Kirim kode Verifikasi</button>
				                            </div>
				                        </form>
				                        @endif
				                    @else
				                    	{{ $data->cust_email }}
				                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Nomor HP
                                    	@if($data->cust_phone_verified == 1)
	                                    	<span class="badge badge-success">Verified</span>
	                                    @endif
                                    </h3>
                                    @if(in_array($data->cust_phone_verified,array(0,2)))
                                        @if($otp_active && $data->cust_phone_verified == 2)
                                          	<div class="alert alert-success">
                            		            Kode verifikasi OTP sudah dikirim ke nomor HP Anda. <br />
                            		            Harap periksa pesan Anda di nomor : <br />
                            		       		<span class="badge badge-warning">{{ $data->cust_phone }}</span>
			                            	</div>
                                          	<form method="POST" action="{{url('account/checkOTP')}}">
                                            	{{csrf_field()}}
	                                            <div class="row mt-2">
                                              		<input type="text" name="verif_OTP" placeholder="Input Kode OTP" class="form-control">
                                              		</input>
	                                            </div>
	                                            <div class="row mt-2">

	                                            </div>
	                                            <div class="row mt-2">
					                            	<button id="btn_submit_otp" type="submit" class="btn">Verifikasi OTP</button>
					                            	<p id="countdown_otp"></p>
					                            </div>
					                            <div class="row mt-2">
					                            	<p id="time_left" class="cd-hidden">{{$time_left}}</p>
					                            </div>
                                          	</form>
                                        @else
			                                <form method="POST" action="{{url('account/doPhoneVerification')}}">
			                                    {{csrf_field()}}
			                                    <div class="row mt-2">
				                                    <div class="form-group cd-full-width">
				                                    	<input type="text" name="verif_phone" class="form-control" value="{{ old('verif_phone') ? old('verif_phone') : '0'.$data->cust_phone }}">
				                                    </div>
				                                </div>
			                                  @if(old('verif_phone'))
			                                    <div class="row mt-2">
			                                        <a href="{{url('account/verification')}}" class="float-right">Reset</a>
			                                    </div>
			                                  @endif
					                            <div class="row mt-2">
					                            	<button type="submit" class="btn">Kirim kode OTP</button>
					                            </div>
			                              </form>
                              			@endif
                                  @else
                                    {{'0'.$data->cust_phone}}
                                  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="row">
                    	<div class="col col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h3>Verifikasi Identitas
                    					@include('includes/verif_badge',['verif_data'=>$data->cust_nik_verified])
                    				</h3>
	                                <form class="file-upload" method="POST" action="{{ url('account/doUploadID') }} " enctype="multipart/form-data">
	                                	{{ csrf_field() }}
		                                <div class="row mt-2">
		                                	<div class="col col-sm-6 text-center">
		                                		@if(in_array($data->cust_nik_verified,array(0,3)))
		                                		<span><b>Upload Foto KTP</b></span><br />
		                                		<img id="fotoID" src="{{ asset('resources/images/icons/identity.png') }}" style="max-height:150px;max-width:200px" />
		                                		<br />
		                                		<div class="custom-file">
												  <input type="file" name="fotoID" class="custom-file-input uploadWithPreview">
												  <div class="progress cd-progress">
							                        <div class="bar"></div >
							                        <div class="percent">0%</div >
							                    </div>
												  <label class="custom-file-label" for="customFile">Choose file</label>
												</div>
		                                		@else
		                                		<span><b>Foto KTP</b></span><br />
		                                		<img id="fotoID" src="{{ asset('public/resources/fileUploads/fotoID/'.$data->cust_nik_filename) }}" style="max-height:150px;max-width:200px" />
		                                		@endif

		                                	</div>
		                                	<div class="col col-sm-6 text-center">
		                                		@if(in_array($data->cust_nik_verified,array(0,3)))
		                                		<span><b>Upload Foto Anda Memegang KTP</b></span><br />
		                                		<img id="fotoPegangID" src="{{ asset('resources/images/icons/identity.png') }}" style="max-height:150px;max-width:200px" />
		                                		<div class="custom-file">
												  <input type="file" name="fotoDiri" class="custom-file-input uploadWithPreview">
												  <div class="progress cd-progress">
							                        <div class="bar"></div >
							                        <div class="percent">0%</div >
							                    </div>
												  <label class="custom-file-label" for="customFile">Choose file</label>
												</div>
												@else
		                                		<span><b>Foto Anda Memegang KTP</b></span><br />
		                                		<img id="fotoID" src="{{ asset('public/resources/fileUploads/fotoDiri/'.$data->cust_nik2_filename) }}" style="max-height:150px;max-width:200px" />
		                                		@endif
		                                	</div>
		                                </div>
		                                @if(in_array($data->cust_nik_verified,array(0,3)))
		                                <br />
		                                <div class="row mt-2 text-center">
			                            	<input type="submit" value="Upload foto Anda dan Foto KTP" class="btn cd-centralize"></input>
			                            </div>
			                            @endif
			                        </form>
	                            </div>
	                        </div>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')
