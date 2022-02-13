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
      <h1 class="h2 text-white mb-0">Edit Post</h1>
      <h2 class="h4 fw-normal text-white-75">
          <?php echo Auth::user()->name; ?>
      </h2>
      <a class="btn btn-alt-secondary" href="{{route('posts.index')}}">
        <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Posts
      </a>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
  <!-- User Profile -->
  <div class="block block-rounded">
    <div class="block-header block-header-default">
      <h3 class="block-title">Edit Post</h3>
    </div>
    <div class="block-content">
          <div class="row push">

          <div class="col-12">

              @if(Session::has('photo_upload'))
                  <p class="alert alert-danger my-2 col-6">{{session('photo_upload')}}</p>
              @endif

              {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminPostController@update',$post->id],'files'=>true])!!}

              <div class="col-6 form-group mb-4">
                  {!! Form::label('title', 'Title:') !!}
                  {!! Form::text('title',$post->title,['class'=>'form-control']) !!}
                  @error('title')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>
              <div class="col-6 form-group  mb-4">
                  {!! Form::label('Select Category:') !!}
                  {!! Form::select('postcategory_id',$postcategories,$post->postcategory->toArray(),['class'=>'form-control', ])!!}
                  @error('postcategory_id')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>
              <div class="col-6 form-group mb-4">
                  {!! Form::label('Select Publish Date:') !!}
                  <input id="datePost" name="datePost" type="datetime-local" class="form-control" value="{{$post->book}}"
                         placeholder="Select date submission" data-inline="month" data-enable-time="false">
              </div>
              <div class="form-group  mb-4">
                  {!! Form::label('body', 'Description:') !!}
                  {!! Form::textarea('body', $post->body,['class'=>'form-control','id'=>'js-ckeditor5-classic']) !!}
                  @error('body')
                  <p class="text-danger mt-2"> {{ $message }}</p>
                  @enderror
              </div>

              <div class="mb-4">
              <label class="form-label">Photo</label>

                  <div class="mb-4 row">
                      @foreach($post->photos as $photo)
                          <img class="rounded col-4 mb-4 img-fluid"  src="{{$photo ? asset('images/posts') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$post->title}}">
                      @endforeach
                  </div>

                  <div class="form-group mb-4 col-6">
                      {!! Form::label('photos', 'Choose new photo(s):') !!}
                      {!! Form::label('photos', '*If you want to change the picture, please upload it again.', ['class'=>'text-muted, mb-3']) !!}
                      {!! Form::file('photos[]',['class'=>'form-control','multiple'=>'multiple']) !!}
                  </div>

                  <div class="form-group col-4 mb-4">
                      {!! Form::label('default', 'Default size (850x500px):') !!}
                      {!! Form::checkbox('default','default', false) !!}
                  </div>

                  @if(Session::has('post_crop'))
                      <p class="alert alert-danger my-2 col-6">{{session('post_crop')}}</p>
                  @endif

                  <p>
                      <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                          customize
                      </button>

                  </p>
                  <div class="collapse collapse-horizontal" id="collapseWidthExample">
                      <div class="form-group col-4 mb-4">
                          {!! Form::label('x-as', 'Width:') !!}
                          {!! Form::number('pictWidth',null,['class'=>'form-control']) !!}
                      </div>

                      <div class="form-group col-4 mb-4">
                          {!! Form::label('y-as', 'Height:') !!}
                          {!! Form::number('pictHeight',null,['class'=>'form-control']) !!}
                      </div>
                  </div>

                  @if($account == 'active')
                      <h3 class="mt-3">SEO optimalisation</h3>
                      <div class="col-6 form-group mb-4">
                          {!! Form::label('seo_alternativeTitle', 'Alternative Title:') !!}
                          {!! Form::text('seo_alternativeTitle',$post->seo_alternativeTitle ,['class'=>'form-control']) !!}
                      </div>
                      <div class="col-6 form-group mb-4">
                          {!! Form::label('seo_description', 'Description Post:') !!}
                          {!! Form::text('seo_description',$post->seo_description,['class'=>'form-control']) !!}
                      </div>
                      <div class="col-6 form-group mb-4">
                          {!! Form::label('seo_keywords', 'Keywords:') !!}
                          {!! Form::text('seo_keywords',$post->seo_keywords,['class'=>'form-control']) !!}
                      </div>
                  @endif

              <div class="d-flex justify-content-end">
                  <div class="form-group mr-1">
                      {!! Form::submit('Update',['class'=>'btn btn-alt-primary']) !!}
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

    <!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/cropperjs/cropper.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_image_cropper.js'); ?>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>
