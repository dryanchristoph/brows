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
                                    <h3>Data Identitas <span class="badge badge-{{config('config.cust_iscomplete_badge')[$data->cust_iscomplete]['badge']}}">{{config('config.cust_iscomplete_badge')[$data->cust_iscomplete]['label']}}</span></h3>
                                    @if(Session::get('successmessage'))
                                    <div class="alert alert-success">{{ Session::get('successmessage') }}</div>
                                    @endif
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nama Lengkap</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->cust_firstname.' '.$data->cust_lastname }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Email <span class="badge badge-{{ config('config.verif_badge')[$data->cust_email_verified]['badge'] }}">{{ config('config.verif_badge')[$data->cust_email_verified]['label'] }}</span></span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->cust_email }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nomor HP <span class="badge badge-{{ config('config.verif_badge')[$data->cust_phone_verified]['badge'] }}">{{ config('config.verif_badge')[$data->cust_phone_verified]['label'] }}</span></span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->cust_phone }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Alamat</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->addr_desc }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Provinsi</span>
                                        <span class="col col-sm-8 col-lg-8">{{ @$cust_addresses->province }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Kota/ Kabupaten</span>
                                        <span class="col col-sm-8 col-lg-8">{{ @$cust_addresses->city }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Kecamatan</span>
                                        <span class="col col-sm-8 col-lg-8">{{ @$cust_addresses->district }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Tanggal Lahir</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->cust_bday ? date('d M Y',strtotime($data->cust_bday)) : '' }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Jenis Kelamin</span>
                                        <span class="col col-sm-8 col-lg-8">{{ @config('config.cust_sex')[$data->cust_sex] }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Bank</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->bank_name }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Nomor Rekening</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->bank_account_no }}</span>
                                    </div>
                                    <div class="row">
                                        <span class="col col-sm-4 col-lg-4 info-title">Atas Nama Rekening</span>
                                        <span class="col col-sm-8 col-lg-8">{{ $data->bank_account_name }}</span>
                                    </div>
                                    @if($data->cust_id_real==Session::get('cust_id'))
                                    <div class="row marg-top-lg">
                                        <a href="{{ url('account/update') }}" class="btn btn-primary cd-keep-right">Edit Profile</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card mt-3 d-none" id="updateDetails">
                        <div class="card-body">
                            <h3>Update Account Details</h3>
                            <div class="row mt-2">
                                <div class="col-sm-6"><label class="text-uppercase">First Name:</label>
                                    <div class="form-group"><input type="text" class="form-control" value="{{ $data->cust_firstname }}"></div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">Last Name:</label>
                                    <div class="form-group"><input type="text" class="form-control" value="{{ $data->cust_lastname }}"></div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-6"><label class="text-uppercase">E-mail:</label>
                                    <div class="form-group"><input type="email" class="form-control" value="{{ $data->cust_email }}"></div>
                                </div>
                                <div class="col-sm-6"><label class="text-uppercase">Phone:</label>
                                    <div class="form-group"><input type="text" class="form-control" value="{{ $data->cust_phone }}"></div>
                                </div>
                            </div>
                            <div class="mt-2"><button type="reset" class="btn btn--alt js-close-form" data-form="#updateDetails">Cancel</button> <button type="submit" class="btn ml-1">Update</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')
