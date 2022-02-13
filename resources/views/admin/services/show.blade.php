<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>
@livewireStyles




<div>
    <!-- Hero Content -->
    <div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center pt-7 pb-6">
            <h1 class="h2 text-white mb-2">
                The latest Services only for you.
            </h1>
            <h2 class="h4 fw-normal text-white-75 mb-0">
                Feel free to explore and read.
            </h2>
        </div>
    </div>
    <!-- END Hero Content -->

    <!-- Page Content -->
    <div class="content content-boxed">

    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Service</h3>
        </div>
        <!-- service Content -->
        <div class="block-content">
            <div class="row push">
                <div class="col-12">
                    <div class="col-6 form-group mb-4">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::label('name',$service->name,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-6 form-group mb-4">
                        {!! Form::label('Price:') !!}
                        {!! Form::label('price', $service->price,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-6 form-group mb-4">
                        {!! Form::label('Category:') !!}
                        {!! Form::label('price', $service->servicecategory ? $service->servicecategory->name : 'No Category',['class'=>'form-control']) !!}
                    </div>

                    <div class="col-12 form-group mb-4">
                        {!! Form::label('Description:') !!}
                        {!! Form::label('price', $service->description,['class'=>'form-control']) !!}
                    </div>


                </div>
            </div>
        </div>
        <!-- END service Content -->
    </div>
    <!-- END User Profile -->
</div>
</div>



@livewireScripts
<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
<script>One.helpersOnLoad(['js-ckeditor5']);</script>


<?php require '../resources/inc/_global/views/footer_end.php'; ?>
