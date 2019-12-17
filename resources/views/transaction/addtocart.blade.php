
<div class="prd-block" id="prdGalleryModal">
    <div class="prd-block_info">
        <div class="prd-block_info-row info-row-1 mb-md-1">
            <div class="info-row-col-1">
                <h1 class="prd-block_title">{{ $product->prod_name }}</h1>
            </div>
            <div class="info-row-col-2">
                <div>
                    <a class="anchor-profile" href="{{ url('account/profile?cust_id='.encrypt($product->cust_id)) }}">
                        <div class="wrapper cd-inline-block">
                            <img src="{{ url('public/resources/fileUploads/displayPictures/'.($product->cust_image ? $product->cust_image : 'profile-placeholder.png')) }}" class="rounded-circle imgprofile-menu">
                        </div>
                        <span class="cd-inline-block">
                            {{$product->cust_firstname.' '.$product->cust_lastname}}
                        </span>
                    </a>
                </div>
                <div class="product-sku">ID: <span>#{{ str_pad($product->prod_id,5,'0',STR_PAD_LEFT) }}</span></div>
                <?php /*
                <div class="prd-block__labels">
                    <span class="prd-label--sale">SALE</span>
                    <span class="prd-label--new">NEW</span>
                </div>*/ ?>
                <div class="prd-block_link"><a href="#" class="icon-heart-1"></a></div>
            </div>
        </div>
        <div class="prd-block_info-row info-row-1 mb-md-1 cd-hidden">
            <div id="alert_cart" class="alert alert-danger cd-keep-right">
            </div>
        </div>
        <div class="prd-block_info-row info-row-2">
            <form action="#">
                <div class="info-row-col-3">
                    <div class="prd-block_price">
                        <span class="prd-block_price--actual">
                            Rp {{ number_format(($product->prod_unit_price + $product->prod_insurance_cost),0,'.',',') }} per hari
                        </span>
                    </div>
                </div>
                <div class="info-row-col-4">
                    <div class="prd-block_price">
                        <span class="prd-block_price--actual">
                            Rp {{ number_format(($product->prod_unit_price + $product->prod_insurance_cost),0,'.',',') }} per hari
                        </span>
                    </div>
                    <div class="prd-block_qty"><span class="option-label">Jumlah:</span>
                        <div class="qty qty-changer qty-changer--lg">
                            <fieldset>
                                <input type="button" value="&#8210;" class="decrease">
                                <input type="text" name="qty_sewa" class="qty-input" value="1" data-min="1" data-max="{{ $product->prod_stock }}">
                                <input type="button" value="+" class="increase">
                            </fieldset>
                        </div>
                    </div>
                    <?php /*
                    <div class="prd-block_qty"><span class="option-label">Durasi Sewa: </span>
                        <div class="qty qty-changer qty-changer--lg">
                            <fieldset>
                                <input type="button" value="&#8210;" class="decrease">
                                <input type="text" name="prod_" class="qty-input" value="1" data-min="1" data-max="7">
                                <input type="button" value="+" class="increase">
                                <span class="marg-left-sm">hari</span>
                            </fieldset>
                        </div>
                    </div>
                    <div class="prd-block_options">
                        <div class="form-group select-wrapper-sm">
                            <select class="form-control" tabindex="0">
                                <option value="">36 / silver $34.00</option>
                                <option value="">38 / silver $34.00</option>
                                <option value="">36 / gold $45.00</option>
                                <option value="">38 / gold $45.00</option>
                            </select>
                        </div>
                    </div> */ ?>
                    <div class="prd-block_actions">
                        <div class="btn-wrap">
                            <button type="button" id="doAddToCart" class="btn btn--add-to-cart-sm">
                                <i class="icon icon-handbag"></i>
                                <span>Add to cart</span>
                            </button>
                            <div class="loader-wrap cd-hidden">
                                <div class="dots">
                                    <div class="dot one"></div>
                                    <div class="dot two"></div>
                                    <div class="dot three"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="prd-block_info js-prd-m-holder"></div><!-- Product Gallery -->
    <div class="product-previews-wrapper">
        <div class="product-quickview-carousel slick-arrows-aside-simple js-product-quickview-carousel">
            @foreach($product_images as $product_image)
                <div>
                    <a href="{{ url(config('config.productimageurl').$product_image->prod_image) }}" data-fancybox="gallery">
                        <img src="{{ url(config('config.productimageurl').$product_image->prod_image) }}" alt="">
                    </a>
                </div>
            @endforeach
            </div>
        <div class="gdw-loader"></div>
    </div>
    <!-- /Product Gallery -->
    <div class="mt-3 mt-md-4">
        <h2>Deskripsi</h2>
        <p>
            {{ $product->prod_desc }}
        </p>
        
        </div>
    </div>
</div>