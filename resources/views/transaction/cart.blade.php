@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><span>Cart</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <h1 class="text-center">Shopping Cart</h1>
            @if(count($cart))
            @if(Session::get('errormessage'))
                <div class="alert alert-danger text-center">
                    {!! Session::get('errormessage') !!}
                </div>
            @endif
            <form id="formCheckout" method="POST" action="{{ url('transaction/checkout') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col col-md-8">
                        <div class="cart-table">
                        	@php
                                $i = 0;
                        		$prev = null;
                                $total_price = 0;
                        	@endphp
                        	@foreach($cart as $key=>$cart_detail)
                        	@if($prev !== $cart_detail->cust_id)
                            <div class="cart-table-prd-owner-profile{{ $prev==null ? ' active' : '' }}" data-owner-id="{{ $cart_detail->cust_id }}">
                            	<label class="container">
    	                        	<a class="anchor-profile" target="_blank" href="{{ url('account/profile?cust_id='.encrypt($cart_detail->cust_id)) }}">
    	                                <div class="wrapper cd-inline-block">
    	                                    <img src="{{ url('public/resources/fileUploads/displayPictures/'.($cart_detail->cust_image ? $cart_detail->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
    	                                </div>
    	                                <span class="cd-inline-block">
    	                                    {{ $cart_detail->cust_firstname.' '.$cart_detail->cust_lastname }}
    	                                </span>
    	                            </a>
    	                        	<input type="radio" data-owner-id="{{ $cart_detail->cust_id }}" class="form-control" name="owner_id" value="{{ encrypt($cart_detail->cust_id) }}" {{ $prev==null ? 'checked="checked"' : '' }}/>
    	                        </label>
                            </div>
                            @php $i++; @endphp
                            @endif
                            @php
                                $prev = $cart_detail->cust_id;
                                if($i==1){
                                    $total_price += ($cart_detail->prod_unit_price + $cart_detail->prod_insurance_cost)*$cart_detail->qty;
                                }
                            @endphp
                            <div class="cart-table-prd" data-prod-id="{{ $cart_detail->prod_id }}" data-owner-id="{{ $cart_detail->cust_id }}">
                                <div class="cart-table-prd-image">
                                	<a href="{{ url('product/details?prod_id='.encrypt($cart_detail->prod_id)) }}">
                                		<img src="{{ url(config('config.productimageurl').$product_images[$key][array_keys($product_images[$key])[0]]->prod_image) }}" alt="">
                                	</a>
                                </div>
                                <div class="cart-table-prd-name">
                                    <h2><a href="{{ url('product/details?prod_id='.encrypt($cart_detail->prod_id)) }}">{{ $cart_detail->prod_name }}</a></h2>
                                </div>
                                <div class="cart-table-prd-qty">
                                	<span>qty:</span>
                                    <div class="qty qty-changer">
                                        <fieldset>
                                            <input type="button" value="&#8210;" class="decrease">
                                            <input type="text" id="prod_qty" name="qty[{{$cart_detail->prod_id}}]" data-owner-id="{{ $cart_detail->cust_id }}" data-prod-id="{{ encrypt($cart_detail->prod_id) }}" class="qty-input" value="{{ $cart_detail->qty }}" data-min="1" data-max="{{ $cart_detail->prod_stock }}">
                                            <input type="button" value="+" class="increase">
                                        </fieldset>
                                    </div>
                                </div>
                                <?php /*
                                <div class="cart-table-prd-qty"><span>qty:</span> <b>{{ $cart_detail->qty }}</b></div> */ ?>
                                <div class="cart-table-prd-price">
                                	<span>price:</span>
                                	<b>{{ 'Rp '.number_format(($cart_detail->prod_unit_price + $cart_detail->prod_insurance_cost),0,".",",") }}</b>
                                	<span class="cd-keep-right">per day</span>
                                </div>
                                <div class="cart-table-prd-action">
                                	<a href="#" class="icon-heart"></a>
                                	<a href="#" class="icon-cross" id="confirm-delete-cartproduct" title="<span class='fa fa-trash'></span> Hapus Barang" data-toggle="popover"
                                    data-content="Kamu yakin ingin menghapus barang ini?<br><br><button class='btn btn-default btn-confirm-delete' data-prod-id='{{ encrypt($cart_detail->prod_id) }}' data-owner-id='{{ encrypt($cart_detail->cust_id) }}'>Ya</button><button class='btn btn--grey btn-popover-dismiss'>Tidak</button>" data-html="true" data-prod-id="{{ $cart_detail->prod_id }}" data-owner-id="{{ $cart_detail->cust_id }}"></a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sidebar-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="text-center" colspan="2">
                                                Durasi sewa : 
                                                <div class="qty qty-changer cd-inline-block">
                                                    <fieldset>
                                                        <input type="button" value="&#8210;" class="decrease">
                                                        <input type="text" name="duration" class="qty-input" value="1" data-min="1" data-max="20">
                                                        <input type="button" value="+" class="increase">
                                                    </fieldset>
                                                </div>
                                                hari
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Total Harga Sewa</td>
                                            <td class="text-right" id="price">{{ 'Rp '.number_format($total_price,'0','.',',') }}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                if($total_price > 0) $service_charge = 5000;
                                                else $service_charge = 0;
                                            @endphp
                                            <td class="text-right">Service Charge</td>
                                            <td class="text-right" id="service_charge">{{ 'Rp '.number_format($service_charge,'0','.',',') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-total text-uppercase text-right">Subtotal
                                <span class="card-total-price" id="subtotal">
                                    {{ 'Rp '.number_format(($total_price)+$service_charge,'0','.',',') }}
                                </span>
                                <div class="loader-wrap cd-hidden cd-inline-block">
                                    <div class="dots">
                                        <div class="dot one"></div>
                                        <div class="dot two"></div>
                                        <div class="dot three"></div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--full btn--lg">proceed to checkout</button>
                        </div>                    
                    </div>
                </div>
            </form>
            @else
                <div class="prd-grid cd-centralize">
                    <div class="empty-category">
                        <div class="empty-category-text"><span>MAAF</span>, KERANJANG BELANJA KAMU MASIH KOSONG</div>
                        <div class="empty-category-button"><a href="{{ url('/') }}" class="btn-decor">Sewa Barang Sekarang</a></div>
                        <div class="empty-category-icon"><i class="icon-sad-face"></i></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    </div>

@include('includes/foot')