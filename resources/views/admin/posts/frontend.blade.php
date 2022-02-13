<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>
<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

    <div class="container">
        <div class="row">
                @foreach($post->photos as $photo)
                <div class="col-6">
                    <div class="">
                        <img class="d-block" style="max-width: 100%" src="{{$photo ? asset('images/posts') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$post->title}}">
                    </div>
                </div>
                @endforeach
        </div>
    </div>







<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
<script>One.helpersOnLoad(['js-ckeditor5']);</script>


<?php require '../resources/inc/_global/views/footer_end.php'; ?>
