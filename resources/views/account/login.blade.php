@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Login</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <div class="row justify-content-around">
                <div class="col-sm-6 col-md-4">
                    <div id="loginForm">
                        <h2 class="text-center">SIGN IN</h2>
                        <div class="form-wrapper">
                            <p>Jika Anda sudah mempunyai akun, silahkan login.</p>
                            @if (count($errors) > 0)
                                 <div class="alert alert-danger">
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @endif
                            <form method="POST" action="{{ url('account/doLogin')  }}">
                                {{ csrf_field() }}
                                <div class="form-group"><input type="text" name="cust_email" value="{{ old('cust_email') }}" class="form-control" placeholder="email"></div>
                                <div class="form-group"><input type="password" name="cust_password" value="{{ old('cust_password') }}" class="form-control" placeholder="password"></div>
                                <p class="text-uppercase"><a href="#" class="js-toggle-forms">Lupa Password?</a></p>
                                <div class="clearfix"><input id="checkbox1" name="checkbox1" type="checkbox" checked="checked"> <label for="checkbox1">Remember me</label></div>
                                <button type="submit" class="btn">Log in</button>
                            </form>
                        </div>
                    </div>
                    <div id="recoverPasswordForm" class="d-none">
                        <h2 class="text-center">RESET PASSWORD</h2>
                        <div class="form-wrapper">
                            <p>Kami akan mengirimkan email untuk reset password akun Anda.</p>
                            <form action="#">
                                <div class="form-group"><input type="text" class="form-control" placeholder="username/ email"></div>
                                <div class="btn-toolbar"><a href="#" class="btn btn--alt js-toggle-forms">Cancel</a> <button class="btn ml-1">Submit</button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-divider"></div>
                <div class="col-sm-6 col-md-4 mt-3 mt-sm-0">
                    <div class="row">
                        <div class="row">
                            <div id="my-signin2" class="cd-centralize"></div>
                        </div>
                        <br /><br />
                        <div class="row">
                            <a href="{{ url('account/doFBAuth') }}" id="fb-signin" class="btn btn-primary btn-block cd-centralize"><i class="fa fa-facebook"></i> Sign in with <b>Facebook</b></a>
                        </div>
                    </div>
                    <hr />
                    <h2 class="text-center">REGISTER</h2>
                    <div class="form-wrapper">
                        <p>Dengan membuat akun di BROWS.id, Anda dapat melakukan transaksi sewa menyewa barang yang Anda inginkan.</p><a href="{{ url('account/register') }}" class="btn">Buat Akun</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')
