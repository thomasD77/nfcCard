<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<div>
    <!-- Hero Content -->
    <div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
        <div class="content content-full text-center pt-7 pb-6">
            <h1 class="h2 text-white mb-2">
                The latest Promos only for you.
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
            <h3 class="block-title">Promo</h3>
        </div>
        <!-- promo Content -->
        <div class="block-content">
            <div class="row push">
                <div class="col-12">
                    <div class="col-6 form-group mb-4">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::label('name',$promo->name,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-6 form-group mb-4">
                        {!! Form::label('Date From:') !!}
                        {!! Form::label('date_from', $promo->date_from,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-6 form-group mb-4">
                        {!! Form::label('Date to:') !!}
                        {!! Form::label('date_to', $promo->date_to,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-6 form-group mb-4">
                        {!! Form::label('Discount:') !!}
                        {!! Form::label('discount', $promo->discount,['class'=>'form-control']) !!}
                    </div>

                    <div class="col-12 form-group mb-4">
                        {!! Form::label('Description:') !!}
                        <div class="form-control" >{!! $promo->description !!}</div>
                    </div>

                </div>
            </div>
        </div>
        <!-- END promo Content -->
    </div>
    <!-- END User Profile -->
</div>
</div>

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>
<?php require '../resources/inc/_global/views/footer_end.php'; ?>
