@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <div class="row marg-top-xl">
                <div class="col-md-6">
                    <div class="page404-text">404</div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <div class="page404-info">
                        <h2 class="h1-style mb-0">Halaman tidak ditemukan.</h2>
                        <div class="mt-1">
                            <p>Not sure what happened, but we couldn’t find what you were looking for.</p>
                        </div>
                        <div class="mt-3"></div><a href="{{ url('/') }}" class="btn-decor">Home Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/foot')