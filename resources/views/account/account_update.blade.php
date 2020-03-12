@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Akun Saya</span></li>
                <li class="cd-float-right"><a href="{{ url('account/logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <div class="row">
                @include('includes/sidemenu')
                <div class="col-md-9 aside">
                    <h2>Account Details</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Profile Picture</h3>
                                    <div class="dp-container">
                                        <div class="avatar-upload">
                                            <div class="avatar-edit">
                                                <form class="file-upload" method="POST" action="{{ url('account/doUploadDP') }} " enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <input type='file' name="cust_image" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"></label>
                                                </form>
                                            </div>
                                            <div class="avatar-preview">
                                                @if(!$data->cust_image)
                                                <div id="imagePreview" style="background-image: url({{ url('resources/images/icons/profile-placeholder.png') }});">
                                                @else
                                                <div id="imagePreview" style="background-image: url({{ url('public/resources/fileUploads/displayPictures/'.$data->cust_image) }});">
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body cd-form">
                                    <form id="form-update-account" action="{{ url('account/update') }}" method="POST">
                                    @if (count($errors) > 0)
                                         <div class = "alert alert-danger">
                                            <ul>
                                               @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                               @endforeach
                                            </ul>
                                         </div>
                                      @endif
                                    {{ csrf_field() }}
                                    <h3>Data Identitas</h3>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nama Depan</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="cust_firstname" class="form-control" value="{{ old('cust_firstname') ? old('cust_firstname') : $data->cust_firstname  }}" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nama Belakang</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="cust_lastname" class="form-control" value="{{ old('cust_lastname') ? old('cust_lastname') : $data->cust_lastname }}" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Email <span class="badge badge-{{ config('config.verif_badge')[$data->cust_email_verified]['badge'] }}">{{ config('config.verif_badge')[$data->cust_email_verified]['label'] }}</span></span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="cust_email" class="form-control" value="{{ old('cust_email') ? old('cust_email') : $data->cust_email }}" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nomor HP <span class="badge badge-{{ config('config.verif_badge')[$data->cust_phone_verified]['badge'] }}">{{ config('config.verif_badge')[$data->cust_phone_verified]['label'] }}</span></span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="cust_phone" class="form-control" value="{{ old('cust_phone') ? old('cust_phone') : $data->cust_phone }}" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Alamat</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <textarea name="addr_desc" class="form-control" rows="4">{{ old('addr_desc') ? old('addr_desc') : $data->addr_desc }}</textarea>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Provinsi</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <select name="addr_provinsi" data-next="city" data-type="province" class="selectpicker cust_area" data-live-search="true" title="-- pilih provinsi --" data-actions-box="true">
                                                @php
                                                $curval = old('addr_provinsi') ? old('addr_provinsi') : $data->addr_provinsi;
                                                @endphp
                                                @foreach($provinces as $province)
                                                <option value="{{ $province->province_id }}" {{ $curval == $province->province_id ? ' selected' : '' }}>{{$province->province}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Kota/ Kabupaten</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <select name="addr_kota" id="city" data-next="subdistrict" data-type="city" class="selectpicker cust_area" data-live-search="true" title="-- pilih kota --">
                                                @php
                                                    $curval = old('addr_kota') ? old('addr_kota') : $data->addr_kota;
                                                @endphp
                                                @foreach($addresses_options['cities'] as $city)
                                                     <option value="{{ $city->city_id }}" {{ $curval == $city->city_id ? ' selected' : '' }}>{{$city->type.' '.$city->city_name}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Kecamatan</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <select name="addr_kecamatan" id="subdistrict" data-type="subdistrict" class="selectpicker" data-live-search="true" title="-- pilih kecamatan --">
                                                 @php
                                                    $curval = old('addr_kecamatan') ? old('addr_kecamatan') : $data->addr_kecamatan;
                                                @endphp
                                                @foreach($addresses_options['subdistrics'] as $subdistric)
                                                     <option value="{{ $subdistric->subdistrict_id }}" {{ $curval == $subdistric->subdistrict_id ? ' selected' : '' }}>{{$subdistric->subdistrict_name}}</option>
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Tanggal Lahir</span>
                                        <span class="col col-sm-8 col-lg-4">
                                            <div class="input-group date">
                                              <input type="text" autocomplete="off" name="cust_bday" id="datepicker" class="form-control" value="{{ old('cust_bday') ? old('cust_bday') : date('d M Y',strtotime($data->cust_bday)) }}">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div>
                                        </span>
                                        <span class="col col-sm-0 col-0 col-lg-4">
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Jenis Kelamin</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="checkbox" id="cust_sex" name="cust_sex[]" data-toggle="toggle" data-on="Laki - Laki" data-off="Perempuan" {{ old('cust_sex') ? ' checked' : old('cust_sex') ? '' : ' checked' }}>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Bank</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <select name="bank_id" class="selectpicker" data-live-search="true" title="-- pilih bank --">
                                                @php
                                                $curval = old('bank_id') ? old('bank_id') : $data->bank_id;
                                                @endphp
                                                @foreach($banks as $bank)
                                                <option value="{{$bank->bank_id}}" {{ $curval == $bank->bank_id ? ' selected' : ''}}>{{$bank->bank_id}} - {{$bank->bank_name}}
                                                @endforeach
                                            </select>
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nomor Rekening</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="bank_account_no" value="{{ old('bank_account_no') ? old('bank_account_no') : $data->bank_account_no }}" class="form-control" />
                                        </span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Atas Nama Rekening</span>
                                        <span class="col col-sm-8 col-lg-8">
                                            <input type="text" name="bank_account_name" value="{{old('bank_account_name') ? old('bank_account_name') : $data->bank_account_name }}" class="form-control" />
                                        </span>
                                    </div>
                                    <div class="row marg-top-lg">
                                        <div class="cd-keep-right">
                                            <a href="{{ url('account') }}" class="btn btn-danger">Batal</a>
                                            <button type="submit" class="btn btn-primary">Update Profile</button>
                                        </div>
                                    </div>
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