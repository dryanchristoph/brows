    <footer class="page-footer footer-style-1 global_width">
        <div class="holder bgcolor bgcolor-1 mt-0">
            <div class="container">
                <div class="row shop-features-style3">
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Promo Gratis Ongkir</div>
                                <div class="text2">Syarat dan Ketentuan Berlaku</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="fa fa-shield"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">Promo Asuransi Gratis</div>
                                <div class="text2">Syarat dan Ketentuan Berlaku</div>
                            </div>
                        </a></div>
                    <div class="col-md"><a href="#" class="shop-feature light-color">
                            <div class="shop-feature-icon"><i class="fa fa-weixin"></i></div>
                            <div class="shop-feature-text">
                                <div class="text1">24/7 Customer Support</div>
                                <div class="text2">Ada masalah apapun, hubungi kami</div>
                            </div>
                        </a></div>
                </div>
            </div>
        </div>
        <?php /*<div class="holder bgcolor bgcolor-2 py-3 py-md-5 mt-0">
            <div class="container">
                <div class="subscribe-form subscribe-form--style1">
                    <form action="#">
                        <div class="form-inline">
                            <div class="subscribe-form-title">subscribe to newsletter:</div>
                            <div class="form-control-wrap"><input type="text" class="form-control" placeholder="Enter Your e-mail address"></div><button type="submit" class="btn-decor">subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> */ ?>
        <div class="footer-top container">
            <div class="row py-md-4">
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Customer Service</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="{{url('tnc')}}">Terms and Conditions</a></li>
                                <li><a href="{{url('privacy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('faq')}}">F.A.Q.</a></li>
                                <li><a href="{{url('contact_us')}}">Contact Info</a></li>
                                <li><a href="{{url('account/login')}}">Create Account</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>My Account</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="{{ url('account') }}">My Account</a></li>
                                <li><a href="{{ url('transaction/cart') }}">View Cart</a></li>
                                <li><a href="{{ url('transaction/myRents') }}">Order Status</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>Information</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul>
                                <li><a href="{{url('about')}}">About Us</a></li>
                                <li><a href="{{url('faq')}}">How to buy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-3">
                    <div class="footer-block collapsed-mobile">
                        <div class="title">
                            <h4>contact us</h4>
                            <div class="toggle-arrow"></div>
                        </div>
                        <div class="collapsed-content">
                            <ul class="contact-list">
                                <li><i class="icon-phone"></i><span><span class="h6-style">Call Us:</span><span>+62-812-1473-2660</span></span></li>
                                <li><i class="icon-clock4"></i><span><span class="h6-style">Hours:</span><span>Mon-Fri 9am-8pm<br>Sat-Sun 9am-6pm</span></span></li>
                                <li><i class="icon-mail-envelope1"></i><span><span class="h6-style">E-mail:</span><span><a href="mailto:cs@brows.id">cs@brows.id</a></span></span></li>
                                <li><i class="icon-location1"></i><span><span class="h6-style">Address:</span><span>Jl. Letkol Wisnu No.2, Banjar Jawa, Kec. Buleleng, Kabupaten Buleleng, Bali</span></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php /* <div class="footer-bottom container">
            <div class="row lined py-2 py-md-3">
                <div class="col-md-2 hidden-mobile"><a href="#"><img src="{{asset('resources/gwtemplate/images/logo-footer-dark.png')}}" class="img-fluid" alt=""></a></div>
                <div class="col-md-6 col-lg-5 footer-copyright">
                    <p class="footer-copyright-text"><span>© Copyright</span> 2019 <a href="#">GoodwinStore</a>. <span>All rights reserved.</span></p>
                    <p class="footer-copyright-links"><a href="">Terms & conditions</a> <a href="">Privacy policy</a></p>
                </div>
                <div class="col-md-auto">
                    <div class="payment-icons"><img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/payment/payment-card-visa.png')}} 1x, ../resources/gwtemplate/images/payment/payment-card-visax2.png 2x" class="lazyload" alt=""> <img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/payment/payment-card-mastecard.png')}} 1x, ../resources/gwtemplate/images/payment/payment-card-mastecardx2.png 2x" class="lazyload" alt=""> <img src="{{asset('resources/gwtemplate/images/placeholder.png')}}" data-srcset="{{asset('resources/gwtemplate/images/payment/payment-card-discover.png')}} 1x, ../resources/gwtemplate/images/payment/payment-card-discoverx2.png 2x" class="lazyload" alt=""></div>
                </div>
                <div class="col-md-auto ml-lg-auto">
                    <ul class="social-list">
                        <li><a href="#" class="icon icon-facebook"></a></li>
                        <li><a href="#" class="icon icon-twitter"></a></li>
                        <li><a href="#" class="icon icon-google"></a></li>
                        <li><a href="#" class="icon icon-instagram"></a></li>
                        <li><a href="#" class="icon icon-youtube"></a></li>
                    </ul>
                </div>
            </div>
        </div> */ ?>
    <?php /*</footer><a class="back-to-top js-back-to-top compensate-for-scrollbar" href="#" title="Scroll To Top"><i class="icon icon-angle-up"></i></a>*/ ?>
    <div class="modal--quickview" id="modalQuickView" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title">Add to Cart</div>
        </div>
        <div class="modal-content">
                <div class="loader-wrap">
                    <div class="dots">
                        <div class="dot one"></div>
                        <div class="dot two"></div>
                        <div class="dot three"></div>
                    </div>
                </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
    <div id="modalWishlistAdd" class="modal-info modal--success" style="display: none;">
        <div class="modal-text"><i class="icon icon-heart-fill modal-icon-info"></i><span>Product added to wishlist</span></div>
    </div>
    <div id="modalWishlistRemove" class="modal-info modal--error" style="display: none;">
        <div class="modal-text"><i class="icon icon-heart modal-icon-info"></i><span>Product removed from wishlist</span></div>
    </div>
    <div id="modalCheckOut" class="modal--checkout" style="display: none;">
        <div class="modal-header">
            <div class="modal-header-title"><i class="icon icon-check-box"></i><span>Product added to cart successfully!</span></div>
        </div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="modalchk-prd">
                    <div class="row h-font">
                        <div class="modalchk-prd-image col"><a href="product.html"><img src="{{asset('resources/gwtemplate/images/products/product-01.jpg')}}" alt="Glamor shoes"></a></div>
                        <div class="modalchk-prd-info col">
                            <h2 class="modalchk-title"><a href="product.html">Glamor shoes</a></h2>
                            <div class="modalchk-price">$ 34.00</div>
                            <div class="prd-options"><span class="label-options">Sizes:</span><span class="prd-options-val">xs</span></div>
                            <div class="prd-options"><span class="label-options">Qty:</span><span class="prd-options-val">1</span></div>
                            <div class="prd-options"><span class="label-options">Color:</span><span class="prd-options-val">silver</span></div>
                            <div class="shop-features-modal d-none d-sm-block"><a href="#" class="shop-feature">
                                    <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                    <div class="shop-feature-text">
                                        <div class="text1">Delivery</div>
                                        <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                    </div>
                                </a></div>
                        </div>
                        <div class="shop-features-modal d-sm-none"><a href="#" class="shop-feature">
                                <div class="shop-feature-icon"><i class="icon-box3"></i></div>
                                <div class="shop-feature-text">
                                    <div class="text1">Delivery</div>
                                    <div class="text2">Lorem ipsum dolor sit amet conset</div>
                                </div>
                            </a></div>
                        <div class="modalchk-prd-actions col">
                            <h3 class="modalchk-title">There is <span class="custom-color">3</span> items in your cart</h3>
                            <div class="prd-options"><span class="label-options">Total:</span><span class="modalchk-total-price">$ 600.00</span></div>
                            <div class="modalchk-custom"><img src="{{asset('resources/gwtemplate/images/payment/guaranteed.png')}}" alt="Guaranteed"></div>
                            <div class="modalchk-btns-wrap"><a href="checkout.html" class="btn">proceed to checkout</a> <a href="#" class="btn btn--alt" data-fancybox-close>continue shopping</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php /*<div style="display: none;" class="<?php /* modal--newsletter js-newslettermodal" data-pause="5000" data-expires="1">
        <div class="row no-gutters">
            <div class="col-sm d-none d-md-flex align-items-center justify-content-center">
                <div class="newslettermodal-img"><img src="{{asset('resources/gwtemplate/images/newsletter/newsletter-popup-fashion.png')}}" alt="Subscribe Us"></div>
            </div>
            <div class="col-sm">
                <div class="newslettermodal-content">
                    <div class="newslettermodal-content-center">
                        <div class="newslettermodal-content-logo"><img src="{{asset('resources/images/logo/brows.png')}}" alt=""></div>
                        <h3 class="h2-style newslettermodal-content-title">Subscribe untuk mendapatkan info terbaru seputar dunia sewa menyewa</h3>
                        <div class="newslettermodal-content-text">Masukkan alamat email anda</div>
                        <form action="#" class="newslettermodal-content-form">
                            <div class="form-group"><input type="email" class="form-control" placeholder="Enter Your e-mail address"></div><button type="submit" class="btn mt-1">Subscribe</button>
                            <div class="checkbox-group mt-2"><input type="checkbox" name="newsletter" id="newsLetterCheckBox"> <label for="newsLetterCheckBox">Jangan tampilkan popup ini</label></div>
                        </form>
                        <div class="newslettermodal-content-socials">
                            <ul class="social-list mt-3">
                                <li><a href="#" class="icon icon-facebook"></a></li>
                                <li><a href="#" class="icon icon-twitter"></a></li>
                                <li><a href="#" class="icon icon-google"></a></li>
                                <li><a href="#" class="icon icon-instagram"></a></li>
                                <li><a href="#" class="icon icon-youtube"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>*/ ?>


    <script src="{{asset('resources/gwtemplate/js/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/scrollLock/jquery-scrollLock.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/instafeed/instafeed.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/countdown/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/ez-plus/jquery.ez-plus.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/tocca/tocca.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap-tabcollapse/bootstrap-tabcollapse.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/isotope/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/cookie/jquery.cookie.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/lazysizes/lazysizes.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/lazysizes/ls.bgset.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/form/jquery.form.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/form/validator.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/slider/slider.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/app.js')}}"></script>
    <script src="{{asset('resources/js/vendor/bootstrap/bootstrap-imageupload.js')}}"></script>
    <script src="{{asset('resources/js/bootstrap-datepicker.min.js')}}"></script>
    <?php /*  <script src="{{asset('resources/js/vendor/jquery/jquery.form.js')}}"></script>
    <script src="{{asset('resources/js/daterangepicker.js')}}"></script>
    */ ?>
    <script src="{{asset('resources/js/underscore-min.js')}}"></script>
    <script src="{{asset('resources/js/lodash.min.js')}}"></script>
    <script src="{{asset('resources/js/jquery.typeahead.js')}}"></script>
    <script src="{{asset('resources/js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{asset('resources/js/autoNumeric.js')}}"></script>
    <script src="{{asset('resources/js/moment.min.js')}}"></script>
    <script src="{{asset('resources/js/lightpick.js')}}"></script>
    <script src="{{asset('resources/js/custom.js?cf=20191120')}}"></script>
    <script src="{{asset('resources/js/transaction.js?cf=20191120')}}"></script>
    @if(Request::segment(1)=='account')
    <script src="{{asset('resources/js/less.js')}}"></script>
    @endif

    @if(Request::segment(1)=='transaction')
    <script type="text/javascript"
            src="https://app.midtrans.com/snap/snap.js"
            data-client-key="Mid-client-qF6SYjlVdHGsHmnT"></script>
    @endif

    <?php /*
    dev :
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-nrI5Pi977IN-pcpF"></script>

    <script src="{{asset('resources/gwtemplate/js/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/slick/slick.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/scrollLock/jquery-scrollLock.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/instafeed/instafeed.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/countdown/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/ez-plus/jquery.ez-plus.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/tocca/tocca.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap-tabcollapse/bootstrap-tabcollapse.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/isotope/jquery.isotope.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/fancybox/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/cookie/jquery.cookie.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/lazysizes/lazysizes.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/lazysizes/ls.bgset.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/form/jquery.form.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/form/validator.min.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/vendor/slider/slider.js')}}"></script>
    <script src="{{asset('resources/gwtemplate/js/app.js')}}"></script>
    */ ?>
</body>

</html>
