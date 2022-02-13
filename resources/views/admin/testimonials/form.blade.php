<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
    <div class="content content-full text-center pt-7 pb-5">
        <h1 class="h2 text-white mb-2">
            Testimonial Us.
        </h1>
        <h2 class="h4 fw-normal text-white-75">
            What was your experience with our Company? Let Us know!
        </h2>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-body-extra-light">
    <div class="content">
        <div class="row items-push justify-content-center">
            @if(Session::has('contactform_message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <h4 class="alert-heading">Bedankt!</h4>
                    <p class="alert-success">De Testimonial staat klaar voor behandeling.</p>
                    <hr>
                    <p class="mb-0 alert-success">{{session('contactform')}}</p>

                </div>
            @endif
            <div class="col-md-10 col-xl-6">
                <form class="row mb-0" name="contactformulier" action="{{action('App\Http\Controllers\TestimonialController@store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <input id="input1" name="firstname" type="text" class="form-control my-1 styleinput shadow" placeholder="Enter your firstname" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-12">
                            <input id="input1" name="lastname" type="text" class="form-control my-1 styleinput shadow" placeholder="Enter your lastname" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="col-12">
                            <input id="input2" name="city" type="text" class="form-control my-1 shadow" placeholder="Your city" aria-label="email" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-12">
                            <textarea id="input4" name="experience" class="form-control textfield shadow" rows="10" cols="50" placeholder="Your experience here" aria-label="With textarea"></textarea>
                        </div>
                    </div>
                    <div class="form-group form-check ms-3 my-2">
                        <input type="checkbox" class="form-check-input" name="GDPR">
                        <label class="form-check-label" for="exampleCheck1">Ik ga akkoord met GDPR</label>
                    </div>
                    <div class="g-recaptcha" id="g-recaptcha" data-sitekey="{{ config('custom.RECAPTCHA_SITE_KEY') }}"></div>
                    <div class="row">
                        <div class="d-flex justify-content-center my-5">
                            <button type="submit" class="btn btn-alt-primary"> <i class="fa fa-paper-plane me-1 opacity-50"></i>Send to Us</button>
                        </div>
                    </div>
                </form>
                <script src="https://www.google.com/recaptcha/api.js"></script>

            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>
