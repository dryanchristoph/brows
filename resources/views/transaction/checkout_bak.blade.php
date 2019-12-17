@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Checkout</span></li>
            </ul>
        </div>
    </div>
    <div id="container_checkout" class="holder mt-0">
        <div class="container">
            <h1 class="text-center">Checkout wizard</h1>
            <div class="clearfix"></div>
            <?php /*
            <form id="doCheckout" method="POST" action="{{ url('transaction/doCheckout') }}"> */ ?>
                {{ csrf_field() }}
                <input type="hidden" name="reff_no" value="{{ encrypt($tx->reff_no) }}" />
                <div class="row">
                    <div class="col-md-8">
                        <div class="steps-progress">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#step1" data-step="1"><span>01.</span><span>Alamat Pengiriman</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#step2" data-step="2"><span>02.</span><span>Metode Pengiriman</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#step3" data-step="3"><span>03.</span><span>Deposit</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#step4" data-step="4"><span>04.</span><span>Pembayaran</span></a>
                                </li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 25%;"></div>
                            </div>
                        </div>
                        <div class="tab-content">
                                <div class="tab-pane fade show active" id="step1">
                                    <div class="tab-pane-inside">
                                        <?php /*
                                        <p>
                                            <a href="login.html">Login</a> or <a href="#">Register</a> for faster payment.
                                        </p> */ ?>
                                        <div class="row mt-2">
                                            <div class="col-sm-6"><label class="text-uppercase">Nama Depan:</label>
                                                <div class="form-group"><input type="text" class="form-control" value="{{ $data_cust->cust_firstname }}"></div>
                                            </div>
                                            <div class="col-sm-6"><label class="text-uppercase">Nama Belakang:</label>
                                                <div class="form-group"><input type="text" class="form-control" value="{{ $data_cust->cust_lastname }}"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="text-uppercase">Provinsi:</label>
                                                <div class="form-group select-wrapper">
                                                    <select name="addr_provinsi" data-next="city" data-type="province" class="selectpicker cust_area" data-live-search="true" title="-- pilih provinsi --" data-actions-box="true">
                                                        @php
                                                            $curval = old('addr_provinsi') ? old('addr_provinsi') : $data_cust->addr_provinsi;
                                                        @endphp
                                                        @foreach($cust_addresses['provinces'] as $province)
                                                             <option value="{{ $province->province_id }}" {{ $curval == $province->province_id ? ' selected' : '' }}>{{$province->province}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="text-uppercase">Kota/ Kabupaten:</label>
                                                <div class="form-group select-wrapper">
                                                    <select name="addr_kota" id="city" data-next="subdistrict" data-type="city" class="selectpicker cust_area" data-live-search="true" title="-- pilih kota --">
                                                        @php
                                                            $curval = old('addr_kota') ? old('addr_kota') : $data_cust->addr_kota;
                                                        @endphp
                                                        @foreach($cust_addresses['cities'] as $city)
                                                             <option value="{{ $city->city_id }}" {{ $curval == $city->city_id ? ' selected' : '' }}>{{$city->type.' '.$city->city_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="text-uppercase">Kecamatan:</label>
                                                <div class="form-group select-wrapper">
                                                    <select name="addr_kecamatan" id="subdistrict" data-type="subdistrict" class="selectpicker" data-live-search="true" title="-- pilih kecamatan --">
                                                        @php
                                                            $curval = old('addr_kecamatan') ? old('addr_kecamatan') : $data_cust->addr_kecamatan;
                                                        @endphp
                                                        @foreach($cust_addresses['subdistrics'] as $subdistric)
                                                             <option value="{{ $subdistric->subdistrict_id }}" {{ $curval == $subdistric->subdistrict_id ? ' selected' : '' }}>{{$subdistric->subdistrict_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="text-uppercase">Alamat Lengkap:</label>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="addr_desc">{{ old('addr_desc') ? old('addr_desc') : $data_cust->addr_desc }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <?php /*
                                        <div class="clearfix">
                                            <input id="formcheckoutCheckbox1" name="checkbox1" type="checkbox">
                                            <label for="formcheckoutCheckbox1">Save address to my account</label>
                                        </div> */ ?>
                                        <div class="text-right"><button type="button" class="btn btn-sm step-next">Continue</button></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step2">
                                    <div class="tab-pane-inside">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="text-uppercase">Dikirim dari :</label>
                                                </div>
                                                <div class="row marg-top-sm">
                                                    <a class="anchor-profile" target="_blank" href="{{ url('account/profile?cust_id='.encrypt($data_owner->cust_id)) }}">
                                                        <div class="wrapper cd-inline-block">
                                                            <img src="{{ url('public/resources/fileUploads/displayPictures/'.($data_owner->cust_image ? $data_owner->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
                                                        </div>
                                                        <span class="cd-inline-block">
                                                            {{$data_owner->cust_firstname.' '.$data_owner->cust_lastname}}
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="row marg-top-lg">
                                                    <span class="col-3 col-sm-4 col-lg-3 info-title">Alamat</span>
                                                    <span class="col-9 col-sm-8 col-lg-9">{{ $data_owner->addr_desc }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3 col-sm-4 col-lg-3 info-title">Lokasi</span>
                                                    @php
                                                        $kec_info = $data_owner->kecamatan_info;
                                                    @endphp
                                                    <span class="col-9 col-sm-8 col-lg-9">
                                                        Kecamatan {{ $kec_info->subdistrict_name.', '.$kec_info->type.' '.$kec_info->city.', '.$kec_info->province }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="text-uppercase">Dikirim ke :</label>
                                                </div>
                                                <div class="row marg-top-sm">
                                                    <a class="anchor-profile" target="_blank" href="{{ url('account/profile?cust_id='.encrypt($data_cust->cust_id)) }}">
                                                        <div class="wrapper cd-inline-block">
                                                            <img src="{{ url('public/resources/fileUploads/displayPictures/'.($data_cust->cust_image ? $data_cust->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
                                                        </div>
                                                        <span class="cd-inline-block">
                                                            {{$data_cust->cust_firstname.' '.$data_cust->cust_lastname}}
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="row marg-top-lg">
                                                    <span class="col-3 col-sm-4 col-lg-3 info-title">Alamat</span>
                                                    <span class="col-9 col-sm-8 col-lg-9">{{ $data_cust->addr_desc }}</span>
                                                </div>
                                                <div class="row">
                                                    <span class="col-3 col-sm-4 col-lg-3 info-title">Lokasi</span>
                                                    @php
                                                        $kec_info = $data_cust->kecamatan_info;
                                                    @endphp
                                                    <span class="col-9 col-sm-8 col-lg-9">
                                                        Kecamatan {{ $kec_info->subdistrict_name.', '.$kec_info->type.' '.$kec_info->city.', '.$kec_info->province }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2 marg-top-lg">
                                            <div class="col-sm-4"><label class="text-uppercase">Pilih metode pengiriman:</label>
                                                <div class="form-group">
                                                    <select name="shipment_method" class="selectpicker" data-live-search="true" title="-- pilih metode kirim --">
                                                        <option value="1" selected>COD
                                                        <option value="2">Ekspedisi
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-8 cd-hidden">
                                                <label class="text-uppercase">Pilihan Ekspedisi:</label>
                                                <div id="courier_container">
                                                    @php
                                                        $is_selected = FALSE;
                                                    @endphp
                                                    @foreach($ongkir as $courier)
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="ship_courier" value="{{encrypt($courier->code)}}" {{ !$courier->costs ? ' disabled' : ($is_selected ? '' : 'checked="checked"') }}>
                                                                <img src="{{ url(config('config.courier_logo')[$courier->code]) }}" />
                                                            </label>
                                                            @if($courier->costs)
                                                                <select name="ship_service_name" class="selectpicker">
                                                                    @foreach($courier->costs as $cost)
                                                                        <option value="{{ encrypt($cost->cost[0]->value.'|'.$cost->service.'('.$cost->cost[0]->etd.'hari )') }}">{{ 'Rp '.number_format($cost->cost[0]->value,0,'.',',') }} | {{ $cost->service }} ( {{ $cost->cost[0]->etd }} hari )
                                                                    @endforeach
                                                                </select>
                                                                @php
                                                                    $is_selected = TRUE;
                                                                @endphp
                                                            @else
                                                                Tidak tersedia
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2"></div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-sm step-next">Continue</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="step3">
                                    <div class="tab-pane-inside">
                                        <div id="panel-with-deposit" class="cd-hidden">
                                            Karena Kamu memilih pengiriman menggunakan ekspedisi, Kamu dikenakan biaya Deposit sebesar :<br /><br />
                                            <span id="container_deposit_value" class="cd-font-xl"></span>
                                            <br /><br />
                                            Deposit ini akan dikembalikan ketika barang telah kembali dengan selamat ke tangan pemilik barang.
                                            <br /><br />
                                            Silahkan cek <a href="#">Terms & Conditions</a> transaksi menggunakan ekspedisi di BROWS.id.
                                            <br /><br />
                                            Silahkan lanjutkan ke tahap pembayaran.
                                            <br /><br />
                                        </div>
                                        <div id="panel-without-deposit" class="cd-font-xl">
                                            Kamu memilih COD, <b>tidak ada deposit</b> yang harus dikeluarkan.<br /><br />
                                            Silahkan cek <a href="#">Terms & Conditions</a> transaksi COD di BROWS.id.
                                            <br /><br />
                                            Silahkan lanjutkan ke tahap pembayaran.
                                            <br /><br />
                                        </div>
                                        <div class="text-right"><button type="button" class="btn btn-sm step-next">Continue</button></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade text-center" id="step4">
                                    Total Harga Sewa :
                                    <br /><br />
                                    <span id="grand_total" class="cd-font-xl">
                                        {{ 'Rp '.number_format($suminfo['tx_total_price'],0,'.',',') }}
                                    </span>
                                    <br /><br />
                                    Silahkan lanjutkan pembayaran dengan klik link di bawah ini.
                                    <br /><br />
                                    <div class="clearfix mt-1 mt-md-2">
                                        <button type="button" id="payRent" class="btn btn--lg w-100">
                                            <span>Bayar Sekarang</span>
                                            <div id="loader-wrap-payrent" class="loader-wrap cd-hidden cd-inline-block">
                                                <div class="dots">
                                                    <div class="dot one"></div>
                                                    <div class="dot two"></div>
                                                    <div class="dot three"></div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 mt-md-5">
                        <h2 class="d-md-none">ORDER SUMMARY</h2>
                        <div class="cart-table cart-table--sm">
                            <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                <div class="cart-table-prd-image"></div>
                                <div class="cart-table-prd-name"><b>ITEM</b></div>
                                <div class="cart-table-prd-qty"><b>QTY</b></div>
                                <div class="cart-table-prd-price"><b>PRICE</b></div>
                            </div>
                            @foreach($tx_detail as $product)
                            <div class="cart-table-prd">
                                <div class="cart-table-prd-image">
                                    <a href="{{ url('product/details?prod_id='.encrypt($product->prod_id)) }}">
                                        <img src="{{ url(config('config.productimageurl').$product->prod_image) }}" alt="">
                                    </a>
                                </div>
                                <div class="cart-table-prd-name">
                                    <h2><a href="{{ url('product/details?prod_id='.encrypt($product->prod_id)) }}">{{ $product->prod_name }}</a></h2>
                                </div>
                                <div class="cart-table-prd-qty"><b>{{ $product->tra_qty }}</b></div>
                                <div class="cart-table-prd-price"><b>{{ 'Rp '.number_format(($product->tra_price+$product->tra_insurance_cost) * $product->tra_qty,0,'.',',') }}</b></div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-total-sm">
                            <div class="float-right">Durasi sewa : <span class="card-rent-duration">{{ $tx->tx_duration }} hari</span></div>
                        </div>
                        <div class="card-total-sm cd-bg-white">
                            <div class="float-right">Service Charge : <span class="card-service-charge">{{ 'Rp '.number_format($tx->tx_fee,0,'.',',') }}</span></div>
                        </div>
                        <div class="card-total-sm">
                            <div class="float-right">Subtotal : <span class="card-subtotal-price">{{ 'Rp '.number_format($suminfo['tx_total_price'],0,'.',',') }}</span></div>
                        </div>
                        <div class="card-total-sm cd-bg-white">
                            <div class="float-right">Ongkos Kirim : <span class="card-ship-price">{{ 'Rp '.number_format(0,0,'.',',') }}</span></div>
                        </div>
                        <div class="card-total-sm cd-bg-white">
                            <div class="float-right">Deposit : <span class="card-deposit-price">{{ 'Rp '.number_format(0,0,'.',',') }}</span></div>
                        </div>
                        <div class="card-total-sm">
                            <div class="float-right">Grand Total :
                                <span class="card-total-price">
                                    {{ 'Rp '.number_format($suminfo['tx_total_price'],0,'.',',') }}
                                </span>
                                <div id="loader-wrap-grandtotal" class="loader-wrap cd-hidden cd-inline-block">
                                    <div class="dots">
                                        <div class="dot one"></div>
                                        <div class="dot two"></div>
                                        <div class="dot three"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2"></div>
                    </div>
                </div>
                <?php /*
            </form> */ ?>
        </div>
    </div>
</div>

@include('includes/foot')
