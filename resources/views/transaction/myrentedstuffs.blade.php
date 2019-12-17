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
                    <h2>Barang yang Disewa</h2>
                    <div class="row">
                        @if(@$tx)
                        @foreach($tx as $transaction)
                            <div class="col-sm-6">
                                <h2 class="d-md-none">ORDER SUMMARY</h2>
                                <div class="cart-table cart-table--sm">
                                    <a href="{{ url('transaction/details?reff_no='.encrypt($transaction->reff_no)) }}">
                                    <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                        <div class="cart-table-prd-image">#{{ $transaction->reff_no }}</div>
                                        <div class="cart-table-prd-price text-right">
                                            <h3 class="label-status-trans">
                                                <span class="badge badge-{{config('config.txstat_badge')[$transaction->tx_status]['badge']}}">{{config('config.txstat_badge')[$transaction->tx_status]['label']}}</span>
                                            </h3>
                                        </div>
                                    </div>
                                    </a>
                                    @foreach($tx_details[$transaction->reff_no] as $tx_detail)
                                    <div class="cart-table-prd">
                                        <div class="cart-table-prd-image">
                                            <a href="{{ url('product/details?prod_id='.encrypt($tx_detail->prod_id)) }}">
                                                <img src="{{ url(config('config.productimageurl').$tx_detail->prod_image) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="cart-table-prd-name">
                                            <h2><a href="{{ url('product/details?prod_id='.encrypt($tx_detail->prod_id)) }}">{{ $tx_detail->prod_name }}</a></h2>
                                        </div>
                                        <div class="cart-table-prd-qty"><b>{{ $tx_detail->tra_qty }}</b></div>
                                    </div>
                                    @endforeach
                                    <div class="card-total-sm">
                                        Penyewa :
                                        <a class="anchor-profile" target="_blank" href="{{ url('account/profile?cust_id='.encrypt($transaction->cust_id)) }}">
                                            <div class="wrapper cd-inline-block">
                                                <img src="{{ url('public/resources/fileUploads/displayPictures/'.($transaction->cust_image ? $transaction->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
                                            </div>
                                            <span class="cd-inline-block">
                                                {{$transaction->cust_firstname.' '.$transaction->cust_lastname}}
                                            </span>
                                        </a>
                                        </div>
                                    <div class="card-total-sm cd-bg-white">
                                        <div class="float-right">Total : <span class="card-ship-price">{{ 'Rp '.number_format((($transaction->sum_price+$transaction->sum_insurance)*$transaction->tx_duration)+$transaction->tx_fee,0,'.',',') }}</span></div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="prd-grid cd-centralize">
                            <div class="empty-category">
                                <div class="empty-category-text"><span>MAAF</span>, KAMU BELUM PERNAH MENYEWA di BROWS.id</div>
                                <div class="empty-category-button"><a href="{{ url('/') }}" class="btn-decor">Sewa Barang Sekarang</a></div>
                                <div class="empty-category-icon"><i class="icon-sad-face"></i></div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')
