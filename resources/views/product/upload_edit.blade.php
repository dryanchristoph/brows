
@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="{{ url('product') }}">Product</a></li>
                <li><span>Upload Barang</span></li>
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


                            <div class="prd-has-loader">
                                <div class="gdw-loader"></div>
                                <img src="{{ $imgurl.'/'.$first_image }}" class="zoom" alt="" data-zoom-image="{{ $imgurl.'/'.$first_image }}">
                            </div>
                            <div class="prd-block_main-image-next slick-next js-main-image-next">NEXT</div>
                            <div class="prd-block_main-image-prev slick-prev js-main-image-prev">PREV</div>
                        </div>

                        <div class="prd-block_main-image-links">
                            <?php /*<a data-fancybox data-width="900" href="https://www.youtube.com/watch?v=Zk3kr7J_v3Q" class="prd-block_video-link"><i class="icon icon-play"></i></a>
                            <a href="../resources/gwtemplate/images/products/large/product-01.jpg" class="prd-block_zoom-link"><i class="icon icon-zoomin"></i></a> */ ?>
                            <form id="uploadProductImage" method="POST" action="{{ url('product/doUploadImage') }} " enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="prod_id" value="{{$prod_id}}" />
                                <label class="btn btn-default" title="Upload Foto Barang">
                                    <span class="fa fa-upload"></span>
                                    Upload Foto<input type="file" id="uploadPrdImage" name="productImage" class="cd-hidden" accept=".png, .jpg, .jpeg">
                                </label>
                                <button id="confirmDelete" type="button" class="btn btn-danger{{ $first_image=='placeholder.png' ? ' cd-hidden' : '' }}" title="<span class='fa fa-trash'></span> Hapus Foto" data-toggle="popover"
                                data-content="Kamu yakin ingin menghapus foto ini?<br><br><button class='btn btn-default btn-confirm-delete'>Ya</button><button class='btn btn--grey btn-popover-dismiss'>Tidak</button>" data-html="true">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </form>
                            <form id="deleteProductImage" method="POST" action="{{ url('product/deleteImage') }} ">
                                {{ csrf_field() }}
                                <input type="hidden" name="prod_id" value="{{$prod_id}}" />
                            </form>
                        </div>
                    </div>
                    <div class="product-previews-wrapper">
                        <div class="product-previews-carousel" id="previewsGallery100">
                            @foreach($prod_images as $prod_image)
                            <a href="#" data-value="Silver" data-index="{{ $prod_image->image_id }}" data-image="{{ $imgurl.'/'.$prod_image->prod_image }}" data-zoom-image="{{ $imgurl.'/'.$prod_image->prod_image }}">
                                <img src="{{ $imgurl.'/'.$prod_image->prod_image }}" alt="">
                            </a>
                            @endforeach
                            @for ($i = 0; $i < $placeholder_count; $i++)
                            <a href="#" data-value="Silver" data-image="{{ $imgurl.'/placeholder.png' }}" data-zoom-image="{{ $imgurl.'/placeholder.png' }}">
                                <img src="{{ $imgurl.'/placeholder.png' }}" alt="">
                            </a>
                            @endfor
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
                            @if(Session::get('errormessage'))
                                <div class="alert alert-danger">
                                    {{html_entity_decode(Session::get('errormessage'))}}
                                </div>
                            @endif
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
                                <div class="form-group cd-width-80">
                                    <input type="text" name="prod_name" value="{{ old('prod_name') ? old('prod_name') : @$prod_data->prod_name }}" class="form-control" placeholder="Nama Barang" />
                                </div>
                                <div class="prd-block__labels"><span class="prd-label--new">{{ @config('config.productstat_badge')[@$prod_data->prod_status]['label'] }}</span></div>
                            </div>
                            <div class="row">
                                <span>Kategori</span>
                                <select name="dc_id" class="selectpicker input-xs" data-width="100%" data-live-search="true" title="Pilih Kategori">
                                @php ($prev = null)
                                @foreach($detail_categories as $detail_category)
                                    @if($detail_category->sc_id.'|'.$detail_category->mc_id !== $prev)
                                    <optgroup label="{{ $detail_category->sc_name }}">
                                    @endif
                                    @php ($prev = $detail_category->sc_id.'|'.$detail_category->mc_id)
                                    <option data-subtext="{{ $detail_category->mc_name }}" value="{{$detail_category->dc_id}}"{{ $detail_category->dc_id == old('dc_id') ? ' selected' : ($detail_category->dc_id==@$prod_data->dc_id) ? ' selected' : '' }}>{{$detail_category->dc_name}}
                                @endforeach
                                </select>
                            </div>
                            <div class="prd-block_description topline">
                                <span>Keterangan</span>
                                <textarea name="prod_desc" class="form-control" rows="12" placeholder="Keterangan Produk">{{ old('prod_desc') ? old('prod_desc') : @$prod_data->prod_desc }}</textarea>
                            </div>
                            <br />
                            <hr />
                            <div class="row">
                                <span class="option-label">Harga Sewa per Hari</span>
                                <br />
                                <div class="form-group cd-width-80">
                                    <input type="text" value="{{ old('prod_unit_price') ? old('prod_unit_price') : @$prod_data->prod_unit_price }}" name="prod_unit_price" id="input-harga-sewa" data-v-min="0" data-v-max="10000000" data-a-sign="Rp " class="form-control autonumeric col-lg-8 col-sm-8 col-xs-12" placeholder="Harga Sewa" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <span class="option-label">Stok Tersedia</span>
                            </div>
                            <div class="row">
                                <div class="qty qty-changer">
                                    <fieldset>
                                        <input type="button" value="&#8210;" class="decrease">
                                        <input type="text" name="prod_stock" class="qty-input" value="{{ old('prod_stock') ? old('prod_stock') : @$prod_data->prod_stock ? $prod_data->prod_stock : '1' }}" data-min="1" data-max="100">
                                        <input type="button" value="+" class="increase">
                                    </fieldset>
                                </div><span class="option-label marg-left-md"> max <span class="qty-max">100</span> item(s)</span>
                            </div>
                            <br />
                            <div class="row">
                                <span class="option-label">Berat Satuan (kg)</span>
                                <br />
                                <div class="form-group cd-width-80">
                                    <input type="text" name="prod_weight_vol" value="{{ old('prod_weight_vol') ? old('prod_weight_vol') : @$prod_data->prod_weight_vol }}" data-a-sign=" kg" data-p-sign="s" class="form-control autonumeric col-lg-8 col-sm-8 col-xs-12" placeholder="Berat" />
                                </div>
                            </div>
                            <br />
                            <div class="row">
                                <span class="option-label">Gunakan Asuransi?</span>
                            </div>
                            <div class="row container-insurance-cost">
                                <div class="col col-sm-4">
                                    <input type="checkbox" id="prod_insurance" name="prod_insurance[]" {{ old('prod_insurance') ? 'checked' : (@$prod_data->prod_insurance==0 && $page_stat !== 'new') ? '' : 'checked' }} data-toggle="toggle" data-on="Ya" data-off="Tidak">
                                </div>
                                <div class="col col-sm-8 container-insurance-cost-1 marg-top-sm cd-hidden">
                                    <span class="insurance-cost"></span>
                                    <span class="option-desc">per hari</span>
                                </div>
                                <div class="loader-wrap cd-hidden">
                                    <div class="dots">
                                        <div class="dot one"></div>
                                        <div class="dot two"></div>
                                        <div class="dot three"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="prd-block_actions topline">
                            <div class="row">
                                <span class="option-label"><b>Total Harga Sewa</b></span>
                            </div>
                            <hr />
                            <div class="row">
                                <div class="totalprice-wrap">
                                    <span class="prd-block_price--actual">Rp 0</span>
                                    <span class="prd-block_price--smaller marg-left-md"> per hari</span>
                                </div>
                                <div class="loader-wrap cd-hidden">
                                    <div class="dots">
                                        <div class="dot one"></div>
                                        <div class="dot two"></div>
                                        <div class="dot three"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" name="btn_savedraft" value="1" class="btn btn-secondary">
                                    <i class="icon icon-handbag"></i>
                                    <span>Simpan ke Draft</span>
                                </button>
                                <button type="submit" name="btn_publishproduct" value="1" class="btn btn-primary">
                                    <i class="icon icon-handbag"></i>
                                    <span>Publish</span>
                                </button>
                            </div>
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
