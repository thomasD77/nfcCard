<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
    <div class="content content-full text-center">
      <div class="my-3">
          <img class="rounded-circle border border-white border border-3" height="80" width="80" src="{{Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62'}}" alt="{{Auth::user()->name}}">
      </div>
      <h1 class="h2 text-white mb-0">Add Promo</h1>
      <h2 class="h4 fw-normal text-white-75">
          <?php echo Auth::user()->name; ?>
      </h2>
      <a class="btn btn-alt-secondary" href="{{route('promos.index')}}">
        <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Promos
      </a>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
  <!-- User Profile -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">New Promo</h3>
    </div>
    <div class="block-content">
          <div class="row push">

          <div class="col-12">

              {!! Form::open(['method'=>'POST', 'action'=>'App\Http\Controllers\AdminPromoController@store','files'=>false]) !!}

              <div class="col-6 form-group mb-4">
                  {!! Form::label('name', 'Name:') !!}
                  {!! Form::text('name',null,['class'=>'form-control']) !!}
                  @error('name')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>

              @if(Session::has('promo_date'))
                  <p class="alert alert-danger my-2 col-6">{{session('promo_date')}}</p>
              @endif

              <div class="col-6 form-group mb-4">
                  {!! Form::label('date_from', 'Date from:') !!}
                  {!! Form::date('date_from', null,['class'=>'form-control']) !!}
                  @error('date_from')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>

              <div class="col-6 form-group mb-4">
                  {!! Form::label('date_to', 'Date to:') !!}
                  {!! Form::date('date_to', null,['class'=>'form-control']) !!}
                  @error('date_to')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>

              <div class="col-6 form-group mb-4">
                  {!! Form::label('discount', 'Discount (%):') !!}
                  {!! Form::number('discount',null,['class'=>'form-control']) !!}
                  @error('discount')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>

              <div class="form-group  mb-4">
                  {!! Form::label('description', 'Description:') !!}
                  {!! Form::textarea('description',null,['class'=>'form-control', 'id'=>'js-ckeditor5-classic']) !!}
                  @error('description')
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
  </div>
  <!-- END User Profile -->


<!-- Page JS Plugins -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
    <script>One.helpersOnLoad(['js-ckeditor5']);</script>


<?php require '../resources/inc/_global/views/footer_end.php'; ?>


