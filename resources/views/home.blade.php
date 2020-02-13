@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <!-- BN Slider 1 -->
    <div class="holder fullwidth full-nopad mt-0">
        <div class="container">
            <div class="bnslider-wrapper">
                <div class="bnslider bnslider--lg bnslider--darkarrows keep-scale" id="bnslider-001" data-slick='{"arrows": true, "dots": true}' data-autoplay="false" data-speed="5000" data-start-width="1920" data-start-height="815" data-start-mwidth="480" data-start-mheight="578">
                    <div class="bnslider-slide bnslide-fashion-4">
                        <div class="bnslider-image-mobile" style="background-image: url('{{asset('resources/images/banners/app-banner-1.png')}}');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('resources/images/banners/Banner1a.png')}}');"></div>
                    </div>
                    <div class="bnslider-slide bnslide-fashion-3">
                        <div class="bnslider-image-mobile" style="background-image: url('{{asset('resources/images/banners/app-banner-2.png')}}');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('resources/images/banners/Banner2a.png')}}');"></div>
                        <?php /*
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-center">
                                <div class="bnslider-text-content-flex container">
                                    <div class="bnslider-vert border-half" data-animation="zoomIn" data-animation-delay="0s">
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay=".5s">LOOK HUN-REAL IN THE HEAT IN OUR</div>
                                        <div class="bnslider-text bnslider-text--sm text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #000;">URBAN STYLES</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1.5s">OUTFIT ALL IN ONE</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="#" class="btn-decor" style="color: #000;">shop now<span class="btn-line" style="background-color: #fff;"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div> */ ?>
                    </div>
                    <div class="bnslider-slide bnslide-fashion-1">
                        <div class="bnslider-image-mobile" style="background-image: url('{{asset('resources/images/banners/app-banner-3.png')}}');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('resources/images/banners/Banner3a.png')}}');"></div>
                        <?php /*
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-left">
                                <div class="bnslider-text-content-flex container">
                                    <div class="bnslider-vert border-half mx-0" data-animation="fadeIn" data-animation-delay="0.5s">
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="0.8s" style="color: #000;">LOOK HUN-REAL IN THE HEAT IN OUR</div>
                                        <div class="bnslider-text bnslider-text--sm text-center" data-animation="fadeInUp" data-animation-delay="1s" style="color: #000;">URBAN STYLES</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1.6s" style="color: #000;">OUTFIT ALL IN ONE</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="#" class="btn-decor" style="color: #000;">shop now<span class="btn-line" style="background-color: #000;"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div> */ ?>
                    </div>
                    <div class="bnslider-slide bnslide-fashion-2">
                        <div class="bnslider-image-mobile" style="background-image: url('{{asset('resources/images/banners/app-banner-4.png')}}');"></div>
                        <div class="bnslider-image" style="background-image: url('{{asset('resources/images/banners/Banner4a.png')}}');"></div>
                        <?php /*
                        <div class="bnslider-text-wrap bnslider-overlay">
                            <div class="bnslider-text-content txt-middle txt-left">
                                <div class="bnslider-text-content-flex container">
                                    <div class="bnslider-vert w-50 mx-0" data-animation="fadeIn" data-animation-delay="0.5s">
                                        <div class="bnslider-text bnslider-text--md text-center" data-animation="pulsate" data-animation-delay="0.8s" style="font-weight: 700">HIT REFRESH</div>
                                        <div class="bnslider-text bnslider-text--xxs text-center" data-animation="fadeInUp" data-animation-delay="1s" style="font-weight: 300">LOOK HUN-REAL IN THE HEAT IN OUR</div>
                                        <div class="bnslider-text bnslider-text--sm text-center" data-animation="fadeInUp" data-animation-delay="1.6s" style="color: #f9f600;">SOON ON SALE</div>
                                        <div class="btn-wrap double-mt text-center" data-animation="fadeInUp" data-animation-delay="2s"><a href="#" class="btn-decor">shop now<span class="btn-line" style="background-color: #f9f600;"></span></a></div>
                                    </div>
                                </div>
                            </div>
                        </div> */ ?>
                    </div>
                </div>
                <div class="bnslider-loader">
                    <div class="loader-wrap">
                        <div class="dots">
                            <div class="dot one"></div>
                            <div class="dot two"></div>
                            <div class="dot three"></div>
                        </div>
                    </div>
                </div>
                <div class="bnslider-arrows container-fluid">
                    <div></div>
                </div>
                <div class="bnslider-dots vert-dots container-fluid"></div>
            </div>
        </div>
    </div>
    <!-- //BN Slider 1 -->
    <div class="holder fullboxed bgcolor mt-0 py-2 py-sm-3">
        <div class="container">
            <div class="row bnr-grid">
                <div class="col-md col-6">
                    <a href="{{url('product/catalog?mc='.encrypt($mc[2]->mc_id))}}" class="bnr-wrap">
                        <div class="bnr bnr1 bnr--style-1 bnr--right bnr--middle bnr-hover-scale" data-fontratio="5.55">
                            <img src="{{asset('resources/images/categories/FASHION_sm.png')}}" data-src="{{asset('resources/images/categories/FASHION.png')}}" alt="Banner" class="lazyload">
                        </div>
                    </a>
                </div>
                <div class="col-md col-6">
                    <a href="{{url('product/catalog?mc='.encrypt($mc[3]->mc_id))}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.55">
                            <img src="{{asset('resources/images/categories/HOBBY_sm.png')}}" data-src="{{asset('resources/images/categories/HOBBY.png')}}" alt="Banner" class="lazyload">
                        </div>
                    </a>
                </div>
                <div class="col-md col-6">
                    <a href="{{url('product/catalog?mc='.encrypt($mc[4]->mc_id))}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.55">
                            <img src="{{asset('resources/images/categories/ELECTRONICS_sm.png')}}" data-src="{{asset('resources/images/categories/ELECTRONICS.png')}}" alt="Banner" class="lazyload">
                        </div>
                    </a>
                </div>
                <div class="col-md col-6">
                    <a href="{{url('product/catalog?mc='.encrypt($mc[5]->mc_id))}}" class="bnr-wrap">
                        <div class="bnr bnr2 bnr--style-1 bnr--left bnr--middle bnr-hover-scale" data-fontratio="5.55">
                            <img src="{{asset('resources/images/categories/APPLIANCE_sm.png')}}" data-src="{{asset('resources/images/categories/APPLIANCE.png')}}" alt="Banner" class="lazyload">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="holder fullboxed bgcolor mt-0 pb-2 pb-sm-3">
        <div class="container">
            <div class="row bnr-grid">
                <div class="col-md"><a href="#" class="bnr-wrap">
                        <div class="bnr bnr--style-1 bnr--center bnr--middle bnr-hover-scale" data-fontratio="5.55">
                          <a href="{{url('product/upload')}}" class="caption-white">
                            <img src="{{asset('resources/images/banners/sewakan.png?cf=20191120')}}" data-src="{{asset('resources/images/banners/sewakan.png?cf=20191120')}}" alt="Banner" class="lazyload">
                            <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text3">Sewakan Barang Anda</span></span></span>
                          </a>
                        </div>
                    </a></div>
                <div class="col-md"><a href="#" class="bnr-wrap">
                        <div class="bnr bnr--style-1 bnr--center bnr--middle bnr-hover-scale" data-fontratio="5.55">
                          <a href="{{url('account/login')}}" class="caption-white">
                            <img src="{{asset('resources/images/banners/join.png')}}" data-src="{{asset('resources/images/banners/join.png')}}" alt="Banner" class="lazyload">
                            <span class="bnr-caption">
                            <span class="bnr-text-wrap">
                            <span class="bnr-text3 dark-text">Registrasi User</span></span></span>
                          </a>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="title-with-right">
                <h2 class="h1-style">Sewa Barang Ini Sekarang</h2>
                <div class="prd-carousel-tabs js-filters-prd d-none d-md-flex" data-grid="tabCarousel-01">
                    <span class="active" data-filter="prd">All</span>
                    <span data-filter="prd-popular">Popular</span>
                    <span data-filter="prd-new">New</span>
                </div>
                <div class="prd-carousel-tabs js-filters-prd-sm d-md-none">
                    <span class="filters-label active" data-filter=".prd">All</span>
                    <span class="filters-label" data-filter=".prd-popular">Popular</span>
                    <span class="filters-label" data-filter=".prd-new">New</span>
                </div>
            </div>
            <div class="prd-grid prd-carousel js-prd-carousel-tab slick-arrows-aside-simple slick-arrows-mobile-lg data-to-show-4 data-to-show-md-3 data-to-show-sm-3 data-to-show-xs-2 js-product-isotope-sm" id="tabCarousel-01" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
                @foreach($products as $product)
                <div class="prd prd-has-loader prd-new prd-popular">
                    <div class="prd-inside">
                        @php
                            $productstat_badge = config('config.productstat_badge')[$product->prod_status];
                            $imagesthisproduct = $product_images[$product->prod_id];
                            $firstimage = $imagesthisproduct[array_keys($imagesthisproduct)[0]];
                        @endphp
                        <div class="prd-img-area">
                            <a href="{{ url('product/details?prod_id='.encrypt($product->prod_id)) }}" class="prd-img">
                                <img src="{{url(config('config.productimageurl').$firstimage->prod_image) }}" data-srcset="{{url(config('config.productimageurl').$firstimage->prod_image) }}" alt="Glamor shoes" class="js-prd-img lazyload">
                            </a>
                            <div class="label-{{ config('config.productstat_badge')[$product->prod_status]['badge'] }}">
                                {{ config('config.productstat_badge')[$product->prod_status]['label'] }}
                            </div>
                            <a href="#" class="label-wishlist icon-heart js-label-wishlist"></a>
                            <ul class="list-options color-swatch prd-hidemobile">
                                @foreach($product_images[$product->prod_id] as $prod_image)
                                <li data-image="{{url(config('config.productimageurl').$prod_image->prod_image)}}">
                                    <a href="#" class="js-color-toggle">
                                        <img src="{{url(config('config.productimageurl').$prod_image->prod_image)}}" data-srcset="{{url(config('config.productimageurl').$prod_image->prod_image)}}" class="lazyload" alt="Color Name">
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="gdw-loader"></div>
                        </div>
                        <div class="prd-info">
                            <div class="prd-tag prd-hidemobile">
                                <a href="#">{{ $product->cust_firstname.' '.$product->cust_lastname }}</a>
                            </div>
                           <h2 class="prd-title">
                                <a href="{{ url('product/details?prod_id='.encrypt($product->prod_id)) }}">{{ $product->prod_name }}</a>
                            </h2>
                            <div class="prd-rating prd-hidemobile">
                                @php
                                    $i = 0;
                                @endphp
                                @if($product->rating)

                                    $rounded_rating = round($product->rating)
                                    @foreach($rounded_rating as $rating)
                                        <i class="icon-star fill"></i>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach

                                    @while($i<5)
                                        <i class="icon-star"></i>
                                        @php
                                            $i++;
                                        @endphp
                                    @endwhile
                                @endif
                            </div>
                            <div class="prd-price">
                                <div class="price-new">{{ 'Rp '.number_format(($product->prod_unit_price+$product->prod_insurance_cost), 0, ".", ",") }} per hari</div>
                            </div>
                            <div class="prd-hover">
                                <div class="prd-action">
                                    @if(Session::get('cust_id')==$product->cust_id)
                                        <a href="{{ url('product/upload?prod_id='.encrypt($product->prod_id)) }}" class="btn">
                                            <i class="icon icon-handbag"></i>
                                            <span>Edit Barang</span>
                                        </a>
                                    @else
                                        <button class="btn addtocart" data-prodid="{{ encrypt($product->prod_id) }}" data-fancybox data-src="#modalQuickView">
                                            <i class="icon icon-handbag"></i>
                                            <span>Add To Cart</span>
                                        </button>
                                    @endif
                                    <div class="prd-links">
                                        <a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="more-link-wrapper text-center"><a href="{{url('product/catalog')}}" class="btn-decor">show all</a></div>
        </div>
    </div>
    <?php /*<div class="holder fullwidth full-nopad bgcolor bgcolor-1">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-md"><a href="#" class="bnr bnr--style-2 bnr--center bnr--middle" data-fontratio="9.52"><span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">ciber sale</span> <span class="bnr-text2">on summer collections</span> <span class="bnr-text3">50% or more off</span> <span class="btn-decor bnr-btn btn-decor--whiteline">shop now<span class="btn-line"></span></span></span></span></a></div>
                <div class="col-md d-none d-md-block"><a href="#" class="bnr bnr--left bnr--middle"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/home-fashion/banner-6.jpg')}}" alt="Banner" class="lazyload"></a></div>
            </div>
        </div>
    </div>*/ ?>

    <?php /*<div class="holder">
        <div class="container">
            <div class="row vert-margin mobile-xs-pad">
                <div class="col-6 col-lg-3 aside-col-lg-4"><a href="#" class="bnr bnr--style-3 bnr--left bnr--top" data-fontratio="2.63"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/home-fashion/banner-7.jpg')}}" alt="Banner" class="lazyload"> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">Limited discunts for jeans</span> <span class="bnr-text2">65<sup>%</sup><sub>off</sub></span></span></span></a></div>
                <div class="col-6 col-lg-3 aside-d-none"><a href="#" class="bnr bnr--style-4 bnr--center bnr--middle" data-fontratio="2.63"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/home-fashion/banner-8.jpg')}}" alt="Banner" class="lazyload"> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text1">unique deal</span> <span class="bnr-text2">diesel watches</span> <span><span class="btn-decor bnr-btn">shop now<span class="btn-line"></span></span></span></span></span></a></div>
                <div class="col-lg-6 aside-col-lg-8">
                    <div class="prd-promo prd-promo-carousel vert-dots">
                        <div class="prd-hor prd-has-loader">
                            <h3 class="sidebar-block_title">Bestseller</h3>
                            <div class="prd-inside">
                                <div class="prd-img-area">
                                    <div class="prd-img-wrap"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-09.jpg')}}" alt="Office shirt" class="js-prd-img"></a></div>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-09.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-09.jpg')}}" alt="Color Name"></a></li>
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-09-2.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-09-2.jpg')}}" alt="Color Name"></a></li>
                                    </ul>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h3 class="sidebar-block_title">Bestseller</h3>
                                    <div class="inside">
                                        <div class="prd-tag"><a href="#">clorks</a></div>
                                        <h2 class="prd-title"><a href="product.html">Office shirt</a></h2>
                                        <div class="prd-rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 78.00</div>
                                        </div>
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prd-hor prd-has-loader">
                            <h3 class="sidebar-block_title">Deal of the day</h3>
                            <div class="prd-inside">
                                <div class="prd-img-area">
                                    <div class="prd-img-wrap"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-10.jpg')}}" alt="Flip Flops Easy" class="js-prd-img"></a></div>
                                    <div class="label-sale">-29%</div>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-10.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-10.jpg')}}" alt="Color Name"></a></li>
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-10-2.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-10-2.jpg')}}" alt="Color Name"></a></li>
                                    </ul>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h3 class="sidebar-block_title">Deal of the day</h3>
                                    <div class="inside">
                                        <div class="prd-tag"><a href="#">claytan</a></div>
                                        <h2 class="prd-title"><a href="product.html">Flip Flops Easy</a></h2>
                                        <div class="prd-rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 122.00</div>
                                            <div class="price-old">$ 240.00</div>
                                            <div class="price-comment">You save $ 118.00</div>
                                        </div>
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prd-hor prd-has-loader">
                            <h3 class="sidebar-block_title">Top Rated</h3>
                            <div class="prd-inside">
                                <div class="prd-img-area">
                                    <div class="prd-img-wrap"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-11.jpg')}}" alt="Leather belt" class="js-prd-img"></a></div>
                                    <ul class="list-options color-swatch prd-hidemobile">
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-11.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-11.jpg')}}" alt="Color Name"></a></li>
                                        <li data-image="{{asset('resources/gwtemplate/images/products/product-11-2.jpg')}}"><a href="#" class="js-color-toggle"><img src="{{asset('resources/gwtemplate/images/products/xsmall/product-11-2.jpg')}}" alt="Color Name"></a></li>
                                    </ul>
                                    <div class="gdw-loader"></div>
                                </div>
                                <div class="prd-info">
                                    <h3 class="sidebar-block_title">Top Rated</h3>
                                    <div class="inside">
                                        <div class="prd-tag"><a href="#">cabian</a></div>
                                        <h2 class="prd-title"><a href="product.html">Leather belt</a></h2>
                                        <div class="prd-rating"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star"></i></div>
                                        <div class="prd-price">
                                            <div class="price-new">$ 87.00</div>
                                        </div>
                                        <div class="prd-action">
                                            <form action="#"><input type="hidden"> <button class="btn" data-fancybox data-src="#modalCheckOut"><i class="icon icon-handbag"></i><span>Add To Cart</span></button></form>
                                            <div class="prd-links"><a href="#" class="icon-eye prd-qview-link js-qview-link" data-fancybox data-src="#modalQuickView"></a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>*/ ?>


    <?php /*<div class="holder fullwidth full-nopad bgcolor py-4">
        <div class="container">
            <h2 class="h1-style text-center">Looks We Like</h2>
            <div class="instagram-carousel">
                <div id="instafeed" class="instagram-feed-full js-instagram-feed" data-instafeed='{"limit": "12", "accessToken": "8136043898.1677ed0.5f6f0f08a4614a9f83fd02618b192be9", "sortBy": "most-recent"}'></div>
                <div class="instagram-carousel-arrows container"></div>
            </div>
            <div class="text-center"><a href="#" class="btn-decor">shop the lookbook</a></div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <div class="row vert-margin">
                <div class="col-md-4 col-lg-3">
                    <h2 class="h1-style text-center-sm">Popular Tags</h2>
                    <ul class="tags-list text-center-sm">
                        <li><a href="#">Jeans</a></li>
                        <li><a href="#">St.Valentine’s gift</a></li>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">Discount</a></li>
                        <li><a href="#">Maxi dress</a></li>
                        <li><a href="#">Underwear</a></li>
                        <li><a href="#">men accessories</a></li>
                        <li><a href="#">hand bags</a></li>
                        <li><a href="#">Jeans</a></li>
                        <li><a href="#">St.Valentine’s gift</a></li>
                        <li><a href="#">Sunglasses</a></li>
                        <li><a href="#">Discount</a></li>
                        <li><a href="#">Maxi dress</a></li>
                        <li><a href="#">Underwear</a></li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6">
                    <div class="title-with-arrows">
                        <h2 class="h1-style">Our Blog</h2>
                        <div class="carousel-arrows"></div>
                    </div>
                    <div class="post-prws post-prws-carousel" data-slick='{"slidesToShow": 2, "responsive": [{"breakpoint": 1024,"settings": {"slidesToShow": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 1}}]}'>
                        <div class="post-prw"><a href="blog-post.html" class="post-img"><img src="{{asset('resources/gwtemplate/images/blog/blog-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/blog/small/blog-img-1.jpg')}}" class="lazyload" alt=""></a>
                            <h4 class="post-title"><a href="#">New brands arrivals</a></h4>
                            <p class="post-teaser">Lorem ipsum dolor amet consest adicpising elitr anno dolor sit.</p>
                            <div class="post-bot">
                                <div class="post-date">13 dec</div><a href="blog-post.html" class="post-link">read more</a>
                                <div class="post-action"><a href="#" class="icon icon-heart-1"></a> <a href="#" class="icon-share"></a></div>
                            </div>
                        </div>
                        <div class="post-prw"><a href="blog-post.html" class="post-img"><img src="{{asset('resources/gwtemplate/images/blog/blog-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/blog/small/blog-img-2.jpg')}}" class="lazyload" alt=""></a>
                            <h4 class="post-title"><a href="#">x-mas sale</a></h4>
                            <p class="post-teaser">Lorem ipsum dolor amet consest adicpising elitr anno dolor sit.</p>
                            <div class="post-bot">
                                <div class="post-date">13 dec</div><a href="blog-post.html" class="post-link">read more</a>
                                <div class="post-action"><a href="#" class="icon icon-heart-1"></a> <a href="#" class="icon-share"></a></div>
                            </div>
                        </div>
                        <div class="post-prw"><a href="blog-post.html" class="post-img"><img src="{{asset('resources/gwtemplate/images/blog/blog-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/blog/small/blog-img-3.jpg')}}" class="lazyload" alt=""></a>
                            <h4 class="post-title"><a href="#">minim veniam quis nostrud</a></h4>
                            <p class="post-teaser">Lorem ipsum dolor amet consest adicpising elitr anno dolor sit.</p>
                            <div class="post-bot">
                                <div class="post-date">13 dec</div><a href="blog-post.html" class="post-link">read more</a>
                                <div class="post-action"><a href="#" class="icon icon-heart-1"></a> <a href="#" class="icon-share"></a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="title-with-arrows">
                        <h2 class="h1-style">Promos</h2>
                        <div class="carousel-arrows"></div>
                    </div>
                    <div class="promo-carousel" data-slick='{"responsive": [{"breakpoint": 1200,"settings": {"slidesToShow": 1}},{"breakpoint": 768,"settings": {"slidesToShow": 1}},{"breakpoint": 480,"settings": {"slidesToShow": 2}}]}'>
                        <div><a href="#" target="_blank" class="bnr-wrap">
                                <div class="bnr bnr7 bnr--style-5 bnr--center bnr--middle bnr-hover-scale" data-fontratio="2.63"><img src="{{asset('resources/gwtemplate/images/home-fashion/banner-9.jpg')}}" alt=""><span class="bnr-caption" style="display: flex;"><span class="bnr-text-wrap"><span class="bnr-text1"><span><b>30%</b><br>SALE</span></span><span class="bnr-text2">hurry up !</span><span class="bnr-text3">underwear sale<br><b>diesel, Calvin klein, g-star</b></span></span></span></div>
                            </a></div>
                        <div><a href="#" target="_blank" class="bnr-wrap">
                                <div class="bnr bnr8 bnr--style-5 bnr--center bnr--middle bnr-hover-scale" data-fontratio="2.63"><img src="{{asset('resources/gwtemplate/images/home-fashion/banner-10.jpg')}}" alt=""> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text2">NEW</span> <span class="bnr-text3">women's accessories<br>popular brands</span> <span class="bnr-text1"><span style="padding:.7em 1em;"><b>20%</b><br>OFF</span></span></span></span></div>
                            </a></div>
                        <div><a href="#" target="_blank" class="bnr-wrap">
                                <div class="bnr bnr9 bnr--style-5 bnr--center bnr--middle bnr-hover-scale" data-fontratio="2.63"><img src="{{asset('resources/gwtemplate/images/home-fashion/banner-11.jpg')}}" alt=""> <span class="bnr-caption"><span class="bnr-text-wrap"><span class="bnr-text2">DISCOUNT</span><span class="bnr-text1"> <span style="padding:.7em 1em;"><b>-20%</b></span></span> <span class="bnr-text3">for<br>men's clothing</span></span></span></div>
                            </a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <h2 class="h1-style text-center">Shop brands</h2>
            <div class="brand-prd-carousel vert-dots" data-slick='{"fade": true}'>
                <div class="brand-prd">
                    <div class="brand-prd-image">
                        <div class="carousel-inside slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-1.jpg')}}" alt="" class="lazyload"></div>
                                <div class="carousel-item"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-2.jpg')}}" alt="" class="lazyload"></div>
                            </div><span class="carousel-control next"></span> <span class="carousel-control prev"></span>
                        </div>
                    </div>
                    <div class="brand-prd-info">
                        <div class="inside">
                            <div class="text-center"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images//brand/brand-guess.png')}}" alt="" class="lazyload"></div>
                            <p>Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet.</p>
                            <div class="text-center d-none d-lg-block"><a href="#" class="btn-decor">shop men</a><a href="#" class="btn-decor">shop women</a></div>
                        </div>
                    </div>
                </div>
                <div class="brand-prd">
                    <div class="brand-prd-image">
                        <div class="carousel-inside slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-3.jpg')}}" alt="" class="lazyload"></div>
                                <div class="carousel-item"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-4.jpg')}}" alt="" class="lazyload"></div>
                            </div><span class="carousel-control next"></span> <span class="carousel-control prev"></span>
                        </div>
                    </div>
                    <div class="brand-prd-info">
                        <div class="inside">
                            <div class="text-center"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images//brand/brand-zara.png')}}" alt="" class="lazyload"></div>
                            <p>Ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet.</p>
                            <div class="text-center d-none d-lg-block"><a href="#" class="btn-decor">shop men</a><a href="#" class="btn-decor">shop women</a></div>
                        </div>
                    </div>
                </div>
                <div class="brand-prd">
                    <div class="brand-prd-image">
                        <div class="carousel-inside slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-5.jpg')}}" alt="" class="lazyload"></div>
                                <div class="carousel-item"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-img-6.jpg')}}" alt="" class="lazyload"></div>
                            </div><span class="carousel-control next"></span> <span class="carousel-control prev"></span>
                        </div>
                    </div>
                    <div class="brand-prd-info">
                        <div class="inside">
                            <div class="text-center"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images//brand/brand-ck.png')}}" alt="" class="lazyload"></div>
                            <p>Dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet. Lorem ipsum dolor sit amet consestuer adicpising elitr anno dolor sit amet lorem ipsum.</p>
                            <div class="text-center d-none d-lg-block"><a href="#" class="btn-decor">shop men</a><a href="#" class="btn-decor">shop women</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <ul class="brand-carousel js-brand-carousel slick-arrows-aside-simple">
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-01.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-02.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-03.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-04.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-05.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-06.png')}}" class="lazyload" alt=""></a></li>
                <li><a href="#"><img src="{{asset('resources/gwtemplate/images/brand/brand-logo-placeholder.png')}}" data-src="{{asset('resources/gwtemplate/images/brand/brand-logo-07.png')}}" class="lazyload" alt=""></a></li>
            </ul>
            <div class="text-center"><a href="#" class="btn-decor">view all brands</a></div>
        </div>
    </div>*/ ?>
</div>

@include('includes/foot')
