<?php
    $count_cart = \App\Cart::where('cust_id',Request::session()->get('cust_id'))
                        ->count();

    $m_categories = DB::table('m_category')->whereNotNull('mc_imageurl')->get();

    $categories = \App\Categories::join('m_category','m_category_detail.mc_id','=','m_category.mc_id')
                            ->join('m_category_sub',function($join){
                                $join->on('m_category_detail.sc_id','=','m_category_sub.sc_id');
                                $join->on('m_category_detail.mc_id','=','m_category_sub.mc_id');
                            })
                            ->select('m_category_detail.*','m_category.mc_name','m_category_sub.sc_name')
                            ->orderBy('m_category_detail.mc_id','asc')
                            ->orderBy('m_category_detail.sc_id','asc')
                            ->orderBy('m_category_detail.dc_id','asc')
                            ->groupBy('mc_id','sc_id','dc_id')
                            ->get();

    $arr_categories = [];
    foreach($categories as $category){
        $arr_categories[$category->mc_id][] = $category;
    }
?>

<!-- Mobile Menu -->
    <div class="mobilemenu js-push-mbmenu">
        <div class="mobilemenu-content">
            <div class="mobilemenu-close mobilemenu-toggle">CLOSE</div>
            <div class="mobilemenu-scroll">
                <div class="mobilemenu-search">
                    
                </div>
                <div class="nav-wrapper show-menu">
                    <div class="nav-toggle"><span class="nav-back"><i class="icon-arrow-left"></i></span> <span class="nav-title"></span></div>
                    <ul class="nav nav-level-1">
                        <li>
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <li>
                            <a href="category.html">Kategori Barang</a><span class="arrow"></span>
                            <ul class="nav-level-2">
                                @foreach($m_categories as $mc)
                                <li>
                                    <a href="{{ url('product/catalog?mc='.encrypt($mc->mc_name)) }}" title="">{{$mc->mc_name}}</a>
                                    <span class="arrow"></span>
                                    <ul class="nav-level-3">
                                        @foreach($arr_categories[$mc->mc_id] as $dc)
                                        <li><a href="{{ url('product/catalog?dc='.encrypt($dc->dc_id)) }}">{{ $dc->dc_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="mobilemenu-bottom">
                    <div class="mobilemenu-currency"></div>
                    <div class="mobilemenu-language"></div>
                    <div class="mobilemenu-settings"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Mobile Menu -->
    <div class="hdr-mobile show-mobile">
        <div class="hdr-content">
            <div class="container">
                <!-- Menu Toggle -->
                
                <div class="menu-toggle"><a href="#" class="mobilemenu-toggle"><i class="icon icon-menu"></i></a></div>
                
                <!-- /Menu Toggle -->
                <div class="logo-holder">
                    <?php /*
                    <a href="{{ url('/') }}" class="logo"><img src="{{asset('resources/images/logo/brows.png')}}" srcset="{{asset('resources/images/logo/brows.png')}} 2x" alt=""></a>
                    */ ?>
                    <div class="typeahead__container cd-inline-block">
                        <div class="typeahead__field">
                            <div class="typeahead__query">
                                <input class="js-typeahead-search" name="user_v1[query]" placeholder="Search" autocomplete="off">
                            </div>
                            <div class="typeahead__button">
                                <button type="submit">
                                    <i class="typeahead__search-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hdr-mobile-right">
                    <div class="hdr-content-right links-holder"></div>
                    <div class="minicart-holder"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="hdr-desktop hide-mobile">
        <div class="hdr-topline">
            <div class="container">
                <div class="row">
                    <div class="col-auto hdr-topline-left">
                        <div class="custom-text">Tentang <span>BROWS</span></div>
                    </div>
                    <div class="col hdr-topline-center">

                    </div>
                    <div class="col-auto hdr-topline-right">
                        <a href="{{url('/tnc')}}" class="cd-dropdn-link"><i class="icon icon-heart-1"></i><span>Terms & Conditions</span></a>
                        <a href="{{ url('faq') }}" class="dropdn-link"><i class="icon icon-heart-1"></i><span>FAQ</span></a>
                        <!-- Header Wishlist -->
                        <?php /*
                        <div class="dropdn dropdn_wishlist @@classes"><a href="account-wishlist.html" class="dropdn-link"><i class="icon icon-heart-1"></i><span>Support Center</span></a></div>
                        */ ?>
                        <!-- /Header Wishlist -->
                    </div>
                </div>
            </div>
        </div>
        <div class="hdr-content hide-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-auto logo-holder"><a href="{{ url('/') }}" class="logo"><img src="{{asset('resources/images/logo/brows.png')}}" srcset="{{asset('resources/images/logo/brows.png')}} 2x" alt=""></a></div>
                    <!--navigation-->
                    <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                    <div class="nav-holder">
                        <div class="hdr-nav">
                            <!--mmenu-->
                            <ul class="mmenu mmenu-js">
                                <li class="mmenu-item--mega"><a href="{{ url('product/catalog') }}">Kategori</a>
                                    <div class="mmenu-submenu mmenu-submenu-with-sublevel">
                                        <div class="mmenu-submenu-inside">
                                            <div class="container">
                                                <div class="mmenu-right width-20">
                                                    <h4 class="text-center submenu-title">Featured</h4>
                                                    <div class="prd-carousel-menu" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "arrows": true}'>
                                                        <div class="prd-sm"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/products/product-11-2.jpg')}}" class="lazyload" alt=""></a>
                                                            <div class="prd-info">
                                                                <h2 class="prd-title"><a href="product.html">Leather belt</a></h2>
                                                                <div class="prd-price">
                                                                    <div class="price-new">$ 90.00</div>
                                                                    <div class="price-old">$ 150.00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="prd-sm"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/products/product-06-2.jpg')}}" class="lazyload" alt=""></a>
                                                            <div class="prd-info">
                                                                <h2 class="prd-title"><a href="product.html">Louboutin</a></h2>
                                                                <div class="prd-price">
                                                                    <div class="price-new">$ 110.00</div>
                                                                    <div class="price-old">$ 210.00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="prd-sm"><a href="product.html" class="prd-img"><img src="{{asset('resources/gwtemplate/images/products/product-placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/products/product-08-2.jpg')}}" class="lazyload" alt=""></a>
                                                            <div class="prd-info">
                                                                <h2 class="prd-title"><a href="product.html">Office bag</a></h2>
                                                                <div class="prd-price">
                                                                    <div class="price-new">$ 210.00</div>
                                                                    <div class="price-old">$ 310.00</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mmenu-cols column-5">
                                                        @foreach($m_categories as $mc)
                                                        @php
                                                            $i = 0;
                                                        @endphp
                                                        <div class="mmenu-col">
                                                            <h3 class="submenu-title">
                                                                <a href="{{url('product/catalog?mc='.encrypt($mc->mc_id))}}">{{$mc->mc_name}}</a>
                                                            </h3>
                                                            <ul class="submenu-list">
                                                                @foreach($arr_categories[$mc->mc_id] as $dc)
                                                                @php
                                                                    $i++;
                                                                    if($i==5) break;
                                                                @endphp
                                                                <li>
                                                                    <a href="{{ url('product/catalog?dc='.encrypt($dc->dc_id)) }}">{{ $dc->dc_name }}</a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            <a href="{{url('product/catalog?mc='.encrypt($mc->mc_id))}}" class="submenu-view-more">Lebih Lanjut</a>
                                                            <div class="submenu-img">
                                                                <a href="{{url('product/catalog?mc='.encrypt($mc->mc_id))}}">
                                                                    <img src="{{asset('resources/images/categories/'.$mc->mc_imageurl)}}" data-src="{{asset('resources/images/categories/'.$mc->mc_imageurl)}}" class="lazyload" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                <div class="mmenu-bottom">
                                                    <div class="custom-text"><span>FREE</span> STANDARD DELIVERY ON ORDERS OVER $ 150</div>
                                                    <div class="custom-text"><span>100%</span> money back guarantee</div>
                                                    <div class="custom-text"><span>24/7</span> customer support</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <div class="col cd-search-header" style="height: 75px;">
                                    <!-- Header Search -->
                                    <form action="#" class="search{{ Session::get('login') ? ' cd-width-80' : ' cd-width-100' }}">
                                        <?php /*
                                        <button type="submit" class="search-button"><i class="icon-search2"></i></button>
                                        <input type="text" class="search-input typeahead" placeholder="Cari Barang di Sini">
                                        */ ?>

                                        <div class="typeahead__container cd-inline-block">
                                            <div class="typeahead__field">
                                                <div class="typeahead__query">
                                                    <input class="js-typeahead-search" name="user_v1[query]" placeholder="Search" autocomplete="off">
                                                </div>
                                                <div class="typeahead__button">
                                                    <button type="submit">
                                                        <i class="typeahead__search-icon"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- /Header Search -->
                                    @if(Session::get('login'))
                                    <a id="btn-upload-menu" href="{{ url('product/upload') }}" class="dropdn-link cd-sidesearchbutton">
                                        <i class="fa fa-upload"></i><span>Upload Barang</span>
                                    </a>
                                    @endif
                                </div>
                            </ul>
                            <!--/mmenu-->
                        </div>
                    </div>
                    <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                    <div class="col-auto hdr-content-right">
                        <div class="links-holder">
                            <?php /*<div class="dropdn dropdn_wishlist only-icon cd-inline-block">
                                <a href="account-wishlist.html" class="dropdn-link">
                                    <i class="icon icon-heart-1"></i><span>Wishlist</span>
                                </a>
                            </div>*/ ?>
                            <div class="dropdn dropdn_account only-icon cd-pad-left-lg cd-inline-block">
                                <a href="{{ url('/account') }}">
                                    @if(Session::get('cust_image') == NULL)
                                        <i class="icon icon-person"></i>
                                        @if(!Session::get('login'))
                                        <span class="hide-mobile">
                                            Login
                                        </span>
                                        @endif
                                    @else
                                    <div class="wrapper">
                                        <?php /*
                                        <div class="displayPicture" style="background-image:url('{{ url('public/resources/fileUploads/displayPictures/'.Session::get('cust_image')) }}')">
                                        </div> */ ?>
                                        <img src="{{ url('public/resources/fileUploads/displayPictures/'.Session::get('cust_image')) }}" class="rounded-circle imgprofile-menu">
                                    </div>
                                    @endif
                                </a>
                            </div>
                        </div>
                        <!--//navigation-->
                        <div class="minicart-holder">
                            <div class="minicart cd-inline-block cd-minicart">
                                <a href="{{ url('transaction/cart') }}" class="minicart-link">
                                    <i class="icon icon-handbag"></i>
                                    <span class="minicart-qty">{{ $count_cart }}</span>
                                    <span class="minicart-title">Shopping Cart</span>
                                    <span class="minicart-total">$750.00</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-holder compensate-for-scrollbar">
        <div class="container">
            <div class="row"><a href="#" class="mobilemenu-toggle show-mobile"><i class="icon icon-menu"></i></a>
                <div class="col-auto logo-holder-s">
                    <a href="{{ url('/') }}" class="logo">
                        <img src="{{asset('resources/images/logo/brows.png')}}" srcset="{{asset('resources/images/logo/brows.png')}} 2x" alt="">
                    </a>
                </div>
                <!--navigation-->
                <div class="prev-menu-scroll icon-angle-left prev-menu-js"></div>
                <div class="nav-holder-s"></div>
                <div class="next-menu-scroll icon-angle-right next-menu-js"></div>
                <!--//navigation-->
                <div class="col-auto links-holder-s"></div>
                <div class="col-auto minicart-holder-s"></div>
            </div>
        </div>
    </div>
</header>
