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
                The latest posts only for you.
            </h1>
            <h2 class="h4 fw-normal text-white-75 mb-0">
                Feel free to explore and read.
            </h2>
        </div>
    </div>
    <!-- END Hero Content -->

    <!-- Post Content -->
    <div class="content content-boxed">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Story -->
                <div class="push">
                    <a class="block block-rounded block-link-pop overflow-hidden" href="be_pages_blog_story.php">
                        <div id="carouselExampleControls" class="carousel slide mb-md-5" data-bs-ride="carousel" data-innterval="100">
                            <div class="carousel-inner">
                                @foreach($post->photos as $photo)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <img class="d-block" style="max-width: 100%" src="{{$photo ? asset('images/posts') . $photo->file : 'http://placehold.it/62x62'}}" alt="{{$post->title}}">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="block-content">
                            <h4 class="mb-1">
                                {{ $post->title }}
                            </h4>
                            <p class="fs-sm fw-medium mb-2">
                                <span class="text-primary">{{  $post->postcategory->name }}</span>
                            </p>
                            <p class="fs-sm text-muted">
                                {!! $post->body  !!}
                            </p>
                            <p class="fs-sm fw-medium mb-2">
                                <span class="text-primary">{{  $post->user ? $post->user->name : 'No Author' }}</span><span class="text-muted mx-4">{{ $post->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    </a>
                </div>
                <!-- END Story -->
            </div>
        </div>
    </div>
    <!-- END Post Content -->

    <!-- Page Content -->
    <div class="content">

        @livewire('post-checkbox', ['post' => $post])

        <!-- Comment Section -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Please share your thoughts with us!</h3>
                <div class="block-options">
                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                </div>
            </div>
            <div class="block-content">
                <table class="table table-borderless">
                    <tbody>
                    <tr class="table-active" id="forum-reply-form">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="fs-sm text-muted">
                            <a class="fw-semibold" href="be_pages_generic_profile.php"><?php echo Auth::user()->name ?></a> type your comment
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">
                            <p>
                                <img class="rounded-circle" height="62" width="62" src="<?php echo Auth::user()->avatar ? asset('/') . Auth::user()->avatar->file : 'http://placehold.it/62x62' ?>" alt="">

                            </p>
                            <p class="fs-sm fw-medium"><?php echo (Auth::user()->posts->count() . " " . 'Posts') ?></p>
                        </td>
                        <td>
                            {!! Form::open(['method'=>'POST', 'action'=>'App\Http\Controllers\AdminCommentController@store']) !!}
                            <div class="form-group  mb-4">
                                {!! Form::textarea('body',null,['class'=>'form-control', 'id'=>'js-ckeditor5-classic']) !!}
                                @error('body')
                                <p class="text-danger mt-2"> {{ $message }}</p>
                                @enderror
                                {{ Form::hidden('post_id', $post->id) }}
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="form-group mr-1">
                                    {!! Form::button('<i class="far fa-comment me-1 opacity-50"></i> Comment',['type'=>'submit','class'=>'btn btn-alt-primary']) !!}
                                </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END Comment -->


    </div>
    <!-- END Page Content -->
</div>






@livewireScripts
<?php require '../resources/inc/_global/views/page_end.php'; ?>
<?php require '../resources/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/ckeditor5-classic/build/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor 5 plugins) -->
<script>One.helpersOnLoad(['js-ckeditor5']);</script>


<?php require '../resources/inc/_global/views/footer_end.php'; ?>
