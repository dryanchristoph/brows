@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Product Catalog</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <!-- Two columns -->
            <?php /*
            <!-- Page Title -->
            <div class="page-title text-center d-none d-lg-block">
                <div class="title">
                    <h1>WOMEN’S</h1>
                </div>
            </div> */ ?>
            <!-- /Page Title -->
            <div class="row">
                <!-- Right column -->
                <div class="col-lg-3 aside aside--right fixed-col js-filter-col">
                    <div class="fixed-col_container">
                        @foreach($m_categories as $m_category)
                        <div class="sidebar-block filter-group-block{{$m_category->mc_id==$mc_id ? ' open' : ' collapsed'}}">
                            <div class="sidebar-block_title"><span>{{$m_category->mc_name}}</span>
                                <div class="toggle-arrow"></div>
                            </div>
                            <div class="sidebar-block_content">
                                <ul class="category-list">
                                    @php
                                        $prevSC = FALSE;
                                    @endphp
                                    @if(@$d_categories[$m_category->mc_id])
                                        @foreach($d_categories[$m_category->mc_id] as $category)
                                            @if($prevSC !== $category->sc_id)
                                                <li{{$category->sc_id==$sc_id ? ' class="active"' : ''}}><a href="{{url('product/catalog?sc='.encrypt($category->sc_id))}}"><b>{{$category->sc_name}}</b></a></li>
                                            @endif
                                            <li class="cd-detail-category-list{{$category->dc_id==$dc_id ? ' active' : ''}}">
                                                <a href="{{url('product/catalog?dc='.encrypt($category->dc_id))}}">{{$category->dc_name}}</a>
                                            </li>
                                            @php
                                                $prevSC = $category->sc_id;
                                            @endphp
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Right column -->
                <!-- Center column -->
                <div class="col-lg aside">
                    <div class="prd-grid-wrap">
                        <!-- Filter Row -->
                        <div class="filter-row invisible">
                            <div class="row row-1 d-lg-none align-items-center">
                                <?php /*
                                <div class="col">
                                    <h1 class="category-title">WOMEN’S</h1>
                                </div> */ ?>
                                <div class="col-auto ml-auto">
                                    <div class="view-in-row d-md-none"><span data-view="data-to-show-sm-1"><i class="icon icon-view-1"></i></span> <span data-view="data-to-show-sm-2"><i class="icon icon-view-2"></i></span></div>
                                    <div class="view-in-row d-none d-md-inline"><span data-view="data-to-show-md-2"><i class="icon icon-view-2"></i></span> <span data-view="data-to-show-md-3"><i class="icon icon-view-3"></i></span></div>
                                </div>
                            </div>
                            <div class="row row-2">
                                <div class="col-left d-flex align-items-center">
                                    <div class="sort-by-holder">
                                        <div class="select-label d-none d-lg-inline">Sort by:</div>
                                        <div class="select-wrapper-sm d-none d-lg-inline-block"><select class="form-control input-sm">
                                                <option value="featured">Featured</option>
                                                <option value="rating">Rating</option>
                                                <option value="price">Price</option>
                                            </select></div>
                                        <div class="select-directions d-none d-lg-inline"><span><i class="icon icon-arrow-down"></i></span> <span><i class="icon icon-arrow-up"></i></span></div>
                                        <div class="dropdown d-flex d-lg-none align-items-center justify-content-center"><span class="select-label">Sort By</span>
                                            <div class="select-wrapper-sm"><select class="form-control input-sm">
                                                    <option value="featured">Featured</option>
                                                    <option value="rating">Rating</option>
                                                    <option value="price">Price</option>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="filter-button d-lg-none"><a href="#" class="fixed-col-toggle">FILTER</a></div>
                                </div>
                                <div class="col col-center d-none d-lg-flex align-items-center justify-content-center">
                                    <div class="view-label">View:</div>
                                    <div class="view-in-row">
                                        <span data-view="data-to-show-4"><i class="icon icon-view-4"></i></span>
                                        <span data-view="data-to-show-3"><i class="icon icon-view-3"></i></span>
                                    </div>
                                </div>
                                <div class="col-right ml-auto d-none d-lg-flex align-items-center">
                                    <div class="show-count-holder">
                                        <div class="select-label">Show:</div>
                                        <div class="select-wrapper-sm"><select class="form-control input-sm">
                                                <option value="featured">12</option>
                                                <option value="rating">36</option>
                                                <option value="price">100</option>
                                            </select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Filter Row -->
                        <!-- Products Grid -->
                        @if(count($products) > 0)
                        <div class="prd-grid product-listing data-to-show-4 data-to-show-md-3 data-to-show-sm-2 js-category-grid">
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
                                        <div class="prd-rating prd-hidemobile"><i class="icon-star fill"></i><i class="icon-star fill"></i><i class="icon-star fill"></i>
                                            <i class="icon-star fill"></i><i class="icon-star"></i>
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
                        <div class="loader-wrap">
                            <div class="dots">
                                <div class="dot one"></div>
                                <div class="dot two"></div>
                                <div class="dot three"></div>
                            </div>
                        </div>
                        <!-- /Products Grid -->
                        <div class="show-more d-flex mt-4 mt-md-6 justify-content-center align-items-start">
                            <a href="{{url('product/catalog')}}" class="btn btn--alt">Reset Filter</a>
                            <?php /*
                            <ul class="pagination mt-0">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                            </ul> */ ?>
                        </div>
                        @else
                        <div class="prd-grid">
                            <div class="empty-category">
                                <div class="empty-category-text"><span>MAAF</span>, BELUM ADA BARANG DI KATEGORI INI</div>
                                <div class="empty-category-button"><a href="{{ url('product/catalog') }}" class="btn-decor">SHOW ALL PRODUCTS</a></div>
                                <div class="empty-category-icon"><i class="icon-sad-face"></i></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <!-- /Center column -->
            </div>
            <!-- /Two columns -->
        </div>
    </div>
</div>

@include('includes/foot')