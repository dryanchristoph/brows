@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{ url('product') }}">Product</a></li>
                <li><span>Detail Barang</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <div class="row prd-block prd-block--mobile-image-first prd-block--prv-left js-prd-gallery" id="prdGallery100">
                <div class="col-md-6 col-xl-5">
                    <div class="prd-block_info js-prd-m-holder mb-2 mb-md-0"></div><!-- Product Gallery -->
                    <div class="prd-block_main-image main-image--slide js-main-image--slide">
                        <div class="prd-block_main-image-holder js-main-image-zoom" data-zoomtype="inner">
                            <div class="prd-block_main-image-video js-main-image-video"><video loop muted preload="metadata" controls="controls">
                                    <source src="#"></video>
                                <div class="gdw-loader"></div>
                            </div>
                            <div class="prd-has-loader">
                                <div class="gdw-loader"></div>
                                <img src="{{ $imgurl.'/'.$first_image }}" class="zoom" alt="" data-zoom-image="{{ $imgurl.'/'.$first_image }}">
                            </div>
                            <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                            <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                        </div>
                    </div>
                    <div class="product-previews-wrapper">
                        <div class="product-previews-carousel" id="previewsGallery100">
                            @foreach($prod_images as $prod_image)
                            <a href="#" data-value="Silver" data-index="{{ $prod_image->image_id }}" data-image="{{ $imgurl.'/'.$prod_image->prod_image }}" data-zoom-image="{{ $imgurl.'/'.$prod_image->prod_image }}">
                                <img src="{{ $imgurl.'/'.$prod_image->prod_image }}" alt="">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- /Product Gallery -->
                </div>
                <div class="col-md">
                    <div class="prd-block_info">
                        <form method="POST" action="{{ url('product/doProductUpload') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="prod_id" value="{{$prod_id}}" />
                        <div class="js-prd-d-holder prd-holder">
                            @if (count($errors) > 0)
                                 <div class = "alert alert-danger">
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @endif
                            <div class="prd-block_title-wrap">
                                <h1 class="prd-block_title">{{ @$prod_data->prod_name }}</h1>
                                <div class="prd-block__labels"><span class="prd-label--new">{{config('config.productstat_badge')[$prod_data->prod_status]['label']}}</span></div>
                            </div>
                            <div class="prd-block_info-top">
                                <div class="product-sku">ID: <span>#{{str_pad($prod_data->prod_id,5,'0',STR_PAD_LEFT)}}</span></div>
                                <div class="prd-rating">
                                    <a href="#" class="prd-review-link">
                                        <i class="icon-star fill"></i>
                                        <i class="icon-star fill"></i>
                                        <i class="icon-star fill"></i>
                                        <i class="icon-star fill"></i>
                                        <i class="icon-star"></i>
                                        <span>1 reviews</span>
                                    </a>
                                </div>
                                <div class="prd-availability">Availability: <span>{{$prod_data->prod_stock}} items</span></div>
                            </div>
                            <div class="row marg-top-lg">
                                <br />
                                <a class="anchor-profile" href="{{ url('account/profile?cust_id='.encrypt($prod_data->cust_id)) }}">
                                    <div class="wrapper cd-inline-block">
                                        <img src="{{ url('public/resources/fileUploads/displayPictures/'.($prod_data->cust_image ? $prod_data->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
                                    </div>
                                    <span class="cd-inline-block">
                                        {{$prod_data->cust_firstname.' '.$prod_data->cust_lastname}}
                                    </span>
                                </a>
                            </div>
                            <br />
                            <div class="row">
                                <br />
                                <span class="col col-sm-4 col-lg-4 info-title">Kategori</span>
                                <span class="col col-sm-8 col-lg-8"><label class="badge badge-secondary">{{$prod_data->dc_name}}</label></span>
                            </div>
                            <div class="row">
                                <span class="col col-sm-4 col-lg-4 info-title">Keterangan</span>
                                <span class="col col-sm-8 col-lg-8">{{$prod_data->prod_desc}}</span>
                            </div>
                            <div class="row">
                                <span class="col col-sm-4 col-lg-4 info-title">Stok</span>
                                <span class="col col-sm-8 col-lg-8">{{$prod_data->prod_stock}}</span>
                            </div>
                            <div class="row">
                                <span class="col col-sm-4 col-lg-4 info-title">Berat</span>
                                <span class="col col-sm-8 col-lg-8">{{number_format($prod_data->prod_weight_vol,2,".",",")}} kg</span>
                            </div>
                            <div class="row">
                                <span class="col col-sm-4 col-lg-4 info-title">Harga Sewa</span>
                                <span class="col col-sm-8 col-lg-8">{{'Rp '.number_format(($prod_data->prod_unit_price + $prod_data->prod_insurance_cost), 0, ".", ",")}} per hari</span>
                            </div>
                        </div>
                        <div class="prd-block_actions topline">
                            @if($prod_data->cust_id == Session::get('cust_id'))
                                <a href="{{ url('product/upload?prod_id='.encrypt($prod_data->prod_id)) }}" class="btn btn-primary">
                                    <i class="icon icon-handbag"></i>
                                    <span>Edit Barang</span>
                                </a>
                            @else
                            <div class="row">
                                <button type="button" name="btn_savedraft" value="1" class="btn btn-secondary addtocart" data-prodid="{{ encrypt($prod_data->prod_id) }}" data-fancybox data-src="#modalQuickView" tabindex="0">
                                    <i class="icon icon-handbag"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                            @endif
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 mt-3 mt-xl-0 sidebar-product">
                    <div class="shop-features-style4"><a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Dapatkan Keuntungan</div>
                                <div class="text2">Daripada nongkrong di gudang, upload barangmu di BROWS.id</div>
                            </div>
                        </a><a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-arrow-left-circle"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Keamanan terjamin</div>
                                <div class="text2">Kamu bisa asuransikan barangmu di sini</div>
                            </div>
                        </a><a href="#" class="shop-feature">
                            <div class="shop-feature-icon"><i class="icon-call"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">24/7 customer support</div>
                                <div class="text2">Support center siap membantumu kapanpun</div>
                            </div>
                        </a></div>
                    <div class="js-countdown-wrap">
                        <div class="countdown-box">
                            <div class="countdown js-countdown" data-promoperiod="50000"></div>
                            <!--<div class="countdown js-countdown" data-countdown="2018/05/01"></div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@include('includes/foot')
