@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Transaction Details</span></li>
            </ul>
        </div>
    </div>
    <div id="container_checkout" class="holder mt-0">
        <div class="container">
            <h1 class="text-center">Detail Transaksi #{{$tx->reff_no}}</h1>
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
                                    <a class="nav-link {{ ($step == 'step1' || !$step) ? ' active' : '' }}" data-toggle="tab" href="#step1" data-step="1"><span>01.</span><span>Alamat Pengiriman</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($step == 'step2') ? ' active' : '' }}" data-toggle="tab" href="#step2" data-step="2"><span>02.</span><span>Metode Pengiriman</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($step == 'step3') ? ' active' : '' }}" data-toggle="tab" href="#step3" data-step="3"><span>03.</span><span>Deposit</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ ($step == 'step4') ? ' active' : '' }}" data-toggle="tab" href="#step4" data-step="4"><span>04.</span><span>Pembayaran</span></a>
                                </li>
                            </ul>
                            <div class="progress">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="5" style="width: 25%;"></div>
                            </div>
                        </div>
                        <div class="tab-content">
                                <div class="tab-pane fade {{ ($step == 'step1' || !$step) ? ' show active' : '' }}" id="step1">
                                    <div class="tab-pane-inside">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="text-uppercase">Pemilik Barang :</label>
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
                                                    <label class="text-uppercase">Penerima Barang :</label>
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
                                    </div>
                                </div>
                                <div class="tab-pane fade{{ $step == 'step2' ? ' show active' : '' }}" id="step2">
                                    <div class="tab-pane-inside">
                                        <div class="row mt-2 marg-top-sm">
                                            <div class="col-sm-4">
                                                <label class="text-uppercase">Metode pengiriman:</label>
                                                <h2>
                                                    <label class="badge badge-{{config('config.shipment_method')[$tx->ship_method]['badge']}}">
                                                        {{config('config.shipment_method')[$tx->ship_method]['label']}}
                                                    </label>
                                                </h2>
                                            </div>
                                            @if($tx->ship_method==2)
                                            <div class="col-sm-8">
                                                <label class="text-uppercase">Kurir:</label>
                                                <label>
                                                    <img src="{{ url(config('config.courier_logo')[$tx->ship_courier]) }}" />
                                                </label>
                                                <br />
                                                <label class="text-uppercase">Layanan :</label>
                                                <label>
                                                    {{ $tx->ship_service_name }}
                                                </label>
                                            </div>
                                            @endif
                                        </div>

                                        <div class="mt-2"></div>
                                    </div>
                                </div>
                                <div class="tab-pane fade{{ $step == 'step3' ? ' show active' : '' }}" id="step3">
                                    <div class="tab-pane-inside text-center">
                                        @php
                                            if($actAs==2) $subject = 'Penyewa Barang';
                                            else $subject = 'Kamu';
                                        @endphp
                                        @if($tx->tx_deposit)
                                        <div id="panel-with-deposit">
                                            Karena {{$subject}} memilih pengiriman menggunakan ekspedisi, {{$subject}} dikenakan biaya Deposit sebesar :<br /><br />
                                            <span id="container_deposit_value" class="cd-font-xl"></span>
                                            <br /><br />
                                            Deposit ini akan dikembalikan ketika barang telah kembali dengan selamat ke tangan pemilik barang.
                                            <br /><br />
                                            Silahkan cek <a href="#">Terms & Conditions</a> transaksi menggunakan ekspedisi di BROWS.id.
                                            <br /><br />
                                            Silahkan lanjutkan ke tahap pembayaran.
                                            <br /><br />
                                        </div>
                                        @else
                                        <div id="panel-without-deposit" class="cd-font-xl">
                                            {{$subject}} memilih COD, <b>tidak ada deposit</b> yang harus dikeluarkan.<br /><br />
                                            Silahkan cek <a href="#">Terms & Conditions</a> transaksi COD di BROWS.id.
                                            <br /><br />
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade text-center{{ $step == 'step4' ? ' show active' : '' }}" id="step4">
                                    Total Harga Sewa :
                                    <br /><br />
                                    <span id="grand_total" class="cd-font-xl">
                                        {{ 'Rp '.number_format($suminfo['tx_total_price'],0,'.',',') }}
                                    </span>
                                    <br /><br />
                                    @if($tx->transaction_status == 'settlement')
                                        <span>
                                            Transaksi Berhasil<br />
                                            <img class="img-sm marg-top-lg" src="{{ url('resources/images/icons/check.png') }}" />
                                        </span>
                                        <div class="row text-left marg-top-lg">
                                            <span class="col col-sm-4 col-lg-3 info-title">Metode Pembayaran</span>
                                            <span class="col col-sm-8 col-lg-9">{{ $tx->pay_method }}</span>
                                        </div>
                                        <div class="row text-left">
                                            <span class="col col-sm-4 col-lg-3 info-title">ID Pembayaran</span>
                                            <span class="col col-sm-8 col-lg-9">{{ $tx->mtrans_id }}</span>
                                        </div>
                                        <div class="row text-left">
                                            <span class="col col-sm-4 col-lg-3 info-title">Tanggal Transaksi</span>
                                            <span class="col col-sm-8 col-lg-9">{{ date('d M Y H:i',strtotime($tx->tx_time)) }}</span>
                                        </div>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-2 mt-md-5">
                        <h2 class="d-md-none">ORDER SUMMARY</h2>
                        <div class="cart-table cart-table--sm">
                            @if($successmessage = Session::get('successmessage'))
                            <div class="cart-table-prd-headings cd-bg-white row">
                                <div class="col-sm-12 col-lg-12">
                                    <span class="badge badge-success">{{$successmessage}}</span>
                                </div>
                            </div>
                            @endif
                            <div class="cart-table-prd-headings cd-bg-white row">
                                <div class="col-sm-4 col-lg-4 cd-marg-auto">Status</div>
                                <div class="col-sm-8 col-lg-8">
                                    <h3 class="label-status-trans">
                                        <span class="badge badge-{{config('config.txstat_badge')[$tx->tx_status]['badge']}}">{{config('config.txstat_badge')[$tx->tx_status]['label']}}</span>
                                    </h3>
                                </div>
                            </div>
                            @if(@$tx->tx_ket_status)
                                <div class="cart-table-prd-headings cd-bg-white row">
                                    <div class="col-sm-4 col-lg-4 cd-marg-auto">Keterangan</div>
                                    <div class="col-sm-8 col-lg-8 cd-centralize-v">
                                        {{$tx->tx_ket_status}}
                                    </div>
                                </div>
                            @endif
                            @if(@$return_date)
                                <div class="cart-table-prd-headings cd-bg-white row">
                                    <div class="col-sm-4 col-lg-4 cd-marg-auto">Tanggal Pengembalian</div>
                                    <div class="col-sm-8 col-lg-8 cd-centralize-v">
                                        {{$return_date}}
                                    </div>
                                </div>
                            @endif
                            @if($arr_select = @config('config.followup_'.$actAs.'_'.$tx->ship_method)[$tx->tx_status])
                                <form action="{{url('transaction/updateStatus')}}" method="POST">
                                    {{csrf_field()}}
                                    <input type="hidden" name="reff_no" value="{{encrypt($tx->reff_no)}}" />

                                    <div class="cart-table-prd-headings cd-bg-white row">
                                        <div class="col-sm-4 col-lg-4 cd-marg-auto">Follow Up</div>
                                        <div class="col-sm-8 col-lg-8">
                                            <select id="updatestat_transaksi" class="selectpicker form-control" name="follow_up">
                                                @foreach($arr_select as $stat_option)
                                                    <option value="{{encrypt($stat_option)}}">{{config('config.txstat_badge')[$stat_option]['label']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @if($tx->ship_method==2)
                                    <div id="container_nomor_resi" class="cart-table-prd-headings cd-bg-white row cd-hidden">
                                        <div class="col-sm-4 col-lg-4 cd-marg-auto">Nomor Resi</div>
                                        <div class="col-sm-8 col-lg-8">
                                            <input type="text" row="3" class="form-control" name="ship_resi"></input>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="cart-table-prd-headings cd-bg-white row">
                                        <div class="col-sm-4 col-lg-4 cd-marg-auto">Keterangan</div>
                                        <div class="col-sm-8 col-lg-8">
                                            <textarea type="text" row="3" class="form-control" name="keterangan_status"></textarea>
                                        </div>
                                    </div>
                                    <div class="cart-table-prd-headings cd-bg-white row">
                                        <div class="col-sm-12 col-lg-12 cd-marg-auto text-right">
                                            <button type="submit" class="btn btn-primary">Update Status Transaksi</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
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
