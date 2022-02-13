<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark" style="background-image: url({{asset('images/general/banner6.png')}}); background-size: cover  ; background-repeat: no-repeat ">
    <div class="content content-full text-center pt-7 pb-5">
        <h1 class="h2 text-white mb-2">
            Cookie Policy Page Builder
        </h1>
        <h2 class="h4 fw-normal text-white-75">
            Here you can Build & Change the Content of your Cookie Policy Page!
        </h2>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-body-extra-light">
    <div class="content">
        <div class="row items-push justify-content-center">
                {!! Form::open(['method'=>'PATCH', 'action'=>['App\Http\Controllers\CookieController@update',$credential->id],'files'=>true])!!}
                <div class="row">

                    <div class="mb-4">
                        <label class="form-label" for="input_1">Title</label>
                        <input type="text" class="form-control" name="input_1"
                               value="{{ $credential->input_1 }}">
                    </div>
                    <div class="mb-4">
                        <label class="form-label" for="text_1">Text</label>
                        <textarea class="form-control" id="js-ckeditor5-classic" cols="30" rows="50" name="text_1" >{{ $credential->text_1 }}</textarea>
                    </div>

                <div class="mb-4">
                    <button type="submit" class="btn btn-alt-primary">
                        <i class="fa fa-paper-plane me-1 opacity-50"></i> Save
                    </button>
                </div>
                </form>
                {!! Form::close() !!}
            </div>
    </div>
</div>
<!-- END Page Content -->


<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
    <script>One.helpersOnLoad(['js-ckeditor5']);</script>

    <!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/cropperjs/cropper.min.js'); ?>


<?php require '../resources/inc/_global/views/footer_end.php'; ?>

