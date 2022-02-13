<?php require '../resources/inc/_global/config.php'; ?>
<?php require '../resources/inc/backend/config.php'; ?>
<?php require '../resources/inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/magnific-popup/magnific-popup.css'); ?>

<?php require '../resources/inc/_global/views/head_end.php'; ?>
<?php require '../resources/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
            <div class="flex-grow-1">
                <h1 class="h3 fw-bold mb-2">
                    Gallery
                </h1>
                <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                    Clean and easy way to showcase your images. Hover over them and see your options.
                </h2>
            </div>
            <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx" href="javascript:void(0)">Blog</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        Gallery
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Magnific Popup (.js-gallery class is initialized in Helpers.jqMagnific()) -->
<!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
<div class="content">

    <!-- Advanced Gallery -->
    <h2 class="content-heading">Advanced</h2>
    <div class="row g-sm items-push js-gallery push">
        @foreach($photos as $photo)
        <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
            <div class="options-container fx-item-rotate-r">
                    <img class="options-item" width="270" height="180" src="{{$photo ? asset('images/posts') . $photo->file : 'http://placehold.it/62x62'}}" alt="">
                    <div class="options-overlay bg-black-75">
                    <div class="options-overlay-content">
                        <h3 class="h4 fw-normal text-white mb-1">Image Caption</h3>
                        <h4 class="h6 fw-normal text-white-75 mb-3">Some extra info</h4>
                        <a class="btn btn-sm btn-primary img-lightbox" href="{{ asset('images/posts') . $photo->file }}">
                            <i class="fa fa-search-plus me-1"></i> View
                        </a>
                        <a class="btn btn-sm btn-secondary" href="{{route('posts.edit', $photo->post->id)}}">
                            <i class="fa fa-pencil-alt me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- END Advanced Gallery -->
    <div class="d-flex justify-content-center">
        {!! $photos->links()  !!}
    </div>
</div>
<!-- END Page Content -->

<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<!-- jQuery (required for Magnific Popup plugin) -->
<?php $one->get_js('js/lib/jquery.min.js'); ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>One.helpersOnLoad(['jq-magnific-popup']);</script>

<?php require '../resources/inc/_global/views/footer_end.php'; ?>
