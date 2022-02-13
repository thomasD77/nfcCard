<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="content">
        <div class="row justify-content-center push">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Reminder Block -->
                <div class="block block-rounded mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Password Reminder</h3>
                        <div class="block-options">
                            <a class="btn-block-option" href="{{ route('login')}}" data-bs-toggle="tooltip" data-bs-placement="left" title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 px-xxl-5 py-lg-5">
                            <h1 class="h2 mb-1"><?php echo $one->name ; ?></h1>
                            <p class="fw-medium text-muted">
                                Please provide your account’s email and we will send you your password.
                            </p>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <!-- Reminder Form -->
                            <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _js/pages/op_auth_reminder.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-reminder mt-4" action="{{ route('password.email')}}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <input placeholder="email" id="email" type="email" class="form-control form-control-lg form-control-alt @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn w-100 btn-alt-primary">
                                            <i class="fa fa-fw fa-envelope me-1 opacity-50"></i> Send Mail
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Reminder Form -->

                        </div>
                    </div>
                </div>
                <!-- END Reminder Block -->
            </div>
        </div>
        <div class="fs-sm text-muted text-center">
            <strong><?php echo $one->name; ?></strong> &copy; <span data-toggle="year-copy"></span>
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
<?php $one->get_js('js/pages/op_auth_reminder.min.js'); ?>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>
