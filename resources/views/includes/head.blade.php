<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1">
    <meta name="google-signin-client_id" content="640425749475-fh9tgt33bnqdj93kj88df2sujbbrcgt1.apps.googleusercontent.com">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BROWS - Platform Penyewaan Barang Online Terlengkap</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('resources/images/logo/B.png')}}">
    <!-- Vendor CSS -->
    <link href="{{asset('resources/js/vendor/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/js/vendor/slick/slick.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/js/vendor/fancybox/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/js/vendor/animate/animate.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('resources/css/style-light.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/style.css?cf=20200218')}}" rel="stylesheet">
    <link href="{{asset('resources/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/lightpick.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/jquery.typeahead.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('resources/css/custom.less?cf=20191029')}}" type="text/css" rel="stylesheet/less">
    <!--icon font-->
    <link href="{{asset('resources/fonts/icomoon/icomoon.css')}}" rel="stylesheet">
    <!--custom font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <script>
        var base_url = "{{ url('/') }}";
        var segment1 = "{{ Request::segment(1) }}";
        var segment2 = "{{ Request::segment(2) }}";
    </script>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
</head>

<body class="home-page is-dropdn-click has-slider">
    <div class="body-preloader">
        <div class="loader-wrap">
            <div class="dots">
                <div class="dot one"></div>
                <div class="dot two"></div>
                <div class="dot three"></div>
            </div>
        </div>
    </div>
    <header class="hdr global_width hdr_sticky hdr-mobile-style2 minicart-icon-style-2 hdr-style-11">
        <!-- Promo TopLine -->
        <?php /*<div class="bgcolor" style="background-image: url({{asset('resources/gwtemplate/images/promo-topline-bg.png')}})">
            <div class="promo-topline" data-expires="1" style="display: none;">
                <div class="container">
                    <div class="promo-topline-item"><b>Dapatkan <span style="color: #000">100</span>&nbsp;Karma Points<span class="hidden-xs">&nbsp;|&nbsp;Pada Saat Registrasi User</span></b></div>
                </div><a href="#" class="promo-topline-close js-promo-topline-close"><i class="icon-cross"></i></a>
            </div>
        </div>
        <!-- /Promo TopLine --> */ ?>
