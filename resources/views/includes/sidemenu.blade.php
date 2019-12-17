<div class="col-md-3 aside aside--left">
    <div class="list-group">
    	<a href="{{ url('account') }}" class="list-group-item{{ (Request::segment(2)) == '' ? ' active' : '' }} ">Detail Akun</a>
        <a href="{{ url('account/verification') }}" class="list-group-item{{ (Request::segment(2)) == 'verification' ? ' active' : '' }}">Verifikasi Akun</a>
    	<?php /*<a href="{{ url('account/wishlist') }}" class="list-group-item{{ (Request::segment(2)) == 'wishlist' ? ' active' : '' }}">Wishlist</a>*/ ?>
    	<a href="{{ url('product') }}" class="list-group-item">Barang Saya</a>
    	<a href="{{ url('transaction/myRents') }}" class="list-group-item{{ (Request::segment(2)) == 'myRents' ? ' active' : '' }}">Transaksi Sewa</a>
    	<a href="{{ url('transaction/myRentedStuffs') }}" class="list-group-item{{ (Request::segment(2)) == 'myRentedStuffs' ? ' active' : '' }}">Barang yang Disewa</a>
    	<a href="#" class="list-group-item">Review</a>
    </div>
</div>
