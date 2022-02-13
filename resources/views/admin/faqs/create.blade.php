<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/cropperjs/cropper.min.css'); ?>

<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>



<!-- Hero -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="rounded-circle border border-white border border-3" height="80" width="80" src="{{Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62'}}" alt="{{Auth::user()->name}}">
            </div>
            <h1 class="h2 text-white mb-0">Create Faq</h1>
            <h2 class="h4 fw-normal text-white-75">
                <?php echo Auth::user()->name; ?>
            </h2>
            <a class="btn btn-alt-secondary" href="{{route('faqs.index')}}">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Faqs
            </a>
        </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Faq</h3>
        </div>
        <div class="block-content">
            <div class="row push">
                {!! Form::open(['method'=>'POST', 'action'=>['App\Http\Controllers\AdminFaqController@store'],'files'=>false])!!}
                <div class="form-group mb-4">
                    {!! Form::label('question', 'Question:') !!}
                    {!! Form::text('question',null,['class'=>'form-control']) !!}
                    @error('question')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group  mb-4">
                    {!! Form::label('answer', 'Answer:') !!}
                    {!! Form::textarea('answer', null,['class'=>'form-control','id'=>'js-ckeditor5-classic']) !!}
                    @error('answer')
                    <p class="text-danger mt-2"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <div class="form-group mr-1">
                        {!! Form::submit('Create',['class'=>'btn btn-alt-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- END User Profile -->



    <!-- Page JS Plugins -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
    <script>One.helpersOnLoad(['js-ckeditor5']);</script>

    <!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/cropperjs/cropper.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_image_cropper.js'); ?>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>
