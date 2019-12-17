@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span>Registrasi User</span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8 col-md-6">
                    <h2 class="text-center">REGISTRASI AKUN BROWS.ID</h2>
                    <div class="form-wrapper">
                        <p>Daftar di sini untuk dapat melakukan transaksi sewa menyewa barang yang Anda inginkan.</p>
                              @if (count($errors) > 0)
						         <div class = "alert alert-danger">
						            <ul>
						               @foreach ($errors->all() as $error)
						                  <li>{{ $error }}</li>
						               @endforeach
						            </ul>
						         </div>
						      @endif
                        <form action="{{ url('account/doRegister') }}" method="POST">
                        	{{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group"><input type="text" name="firstname" value="{{ old('firstname') }}" class="form-control" placeholder="Nama Depan"></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group"><input type="text" name="lastname" value="{{ old('lastname') }}" class="form-control" placeholder="Nama Belakang"></div>
                                </div>
                            </div>
                            <div class="form-group"><input type="text" name="cust_phone" value="{{ old('cust_phone') }}" class="form-control" placeholder="Nomor HP"></div>
                            <div class="form-group"><input type="text" name="cust_email" value="{{ old('cust_email') }}" class="form-control" placeholder="E-mail"></div>
                            <div class="form-group"><input type="password" name="cust_password" value="{{ old('cust_password') }}" class="form-control" placeholder="Password"></div>
                            <div class="form-group"><input type="password" name="cust_password_confirmation" value="{{ old('cust_password_confirmation') }}" class="form-control" placeholder="Konfirmasi Password"></div>
                            <div class="clearfix">
                                <input id="checkboxAgreement" name="agreement" type="checkbox">
                                <label for="checkboxAgreement">Dengan melakukan registrasi akun di BROWS.id, Anda setuju pada seluruh
                                    <a href="{{url('/tnc')}}" target="_blank">Terms and Conditions</a> yang berlaku.
                                </label>
                            </div>
                            <div class="text-center"><button id="btn_register" class="btn" disabled>Register</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')
