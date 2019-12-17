@include('includes/head')
@include('includes/menu')

<div class="page-content">
    <div class="holder mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><span><a href="{{url('contact_us')}}">Contact Us</a></span></li>
            </ul>
        </div>
    </div>
    <div class="holder mt-0">
        <div class="container">
            <!-- Page Title -->
            <div class="page-title text-center">
                <div class="title">
                    <h1>Contact Us</h1>
                </div>
            </div>
            <!-- /Page Title -->
            <div class="row vert-margin-double justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <h2>Contact us any time for any questions</h2>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-mobile"></i></div>
                        <div class="contact-info-title">CALL US:</div>
                        <div class="contact-info-text">+62-812-1473-2660</div>
                    </div>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-clock"></i></div>
                        <div class="contact-info-title">HOURS:</div>
                        <div class="contact-info-text">Mon-fri 9am-8pm sat-Sun 9am-6pm</div>
                    </div>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-mail"></i></div>
                        <div class="contact-info-title">E-MAIL:</div>
                        <div class="contact-info-text"><a href="mailto:sc@brows.id"></a>cs@brows.id</div>
                    </div>
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="icon-location"></i></div>
                        <div class="contact-info-title">ADDRESS:</div>
                        <div class="contact-info-text">Jl. Letkol Wisnu No.2, Banjar Jawa, Kec. Buleleng, Kabupaten Buleleng, Bali</div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4 offset-lg-1">
                    <h2 class="text-center">SIGN IN</h2>
                    <form data-toggle="validator" class="contact-form" id="contactForm">
                        <div class="form-confirm">
                            <div class="success-confirm text-center">Thanks! Your message has been sent.<br>We will get back to you soon!</div>
                            <div class="error-confirm text-center">Oops! There was an error submitting form.<br>Refresh and send again.</div>
                        </div>
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>NAME</label> <input type="text" name="name" class="form-control" data-required-error="Please fill the field" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>EMAIL</label> <input type="text" name="email" class="form-control" data-error="Error, that email address is invalid" required>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group"><label class="text-dark"><span class="required">*</span>MESSAGE</label> <textarea class="form-control textarea--height-100" name="message" data-required-error="Please fill the field" required></textarea>
                            <div class="help-block with-errors"></div>
                        </div><button class="btn mt-1">send message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="holder fullwidth">
        <div class="container px-0">
            <div class="contact-map"><iframe width="600" height"500" src="https://maps.google.com/maps?q=telkom%20singaraja&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe></div>
        </div>
    </div>
</div>


@include('includes/foot')
