<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign In Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Sign In</h3>
                        <div class="block-options">
                            @if (Route::has('password.request'))
                                <a class="btn-block-option fs-sm" href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1">Hi there!</h1>
                            <p class="fw-medium text-muted">
                                Welcome, please login.
                            </p>
                            <!-- Sign In Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _js/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signin" action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="py-3">
                                    <div class="mb-4">
                                        <input placeholder="email" id="email" type="email" class="form-control form-control-alt form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <input placeholder="password" id="password" type="password" class="form-control form-control-alt form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
{{--                                    <div class="mb-4">--}}
{{--                                        <div class="form-check">--}}
{{--                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
{{--                                            <label class="form-check-label" for="login-remember">Remember Me</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            <i class="fa fa-fw fa-sign-in-alt me-1 opacity-50"></i> Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign In Form -->

                            @php
                                $url = \App\Models\URL::first();
                            @endphp

                            <div class=" bg-gray-light text-dark p-2 rounded text-center">
                                <p class="fw-medium text-muted">
                                    Reminder: if you want to login on your desktop please use following login: <br>
                                </p>
                                <a class="text-dark" href="{{ $url->url }}"><strong>{{ $url->url }}</strong></a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END Sign In Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong><?php echo $one->name ; ?></strong> &copy; <span data-toggle="year-copy"></span>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<!-- jQuery (required for jQuery Validation plugin) -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>


