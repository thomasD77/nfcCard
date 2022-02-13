<div class="content pt-0">
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ route('services.index') }}">
                <div class="block block-rounded" data-toggle="appear" data-offset="-200">
                    <div class="block-content block-content-full">
                        <div class="py-5 text-center">
                            <div class="item item-2x item-rounded bg-body-light text-primary mx-auto">
                                <i class="fa fa-hand-holding fa-2x"></i>
                            </div>
                            <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Services')}}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('clients.index') }}">
            <div class="block block-rounded" data-toggle="appear" data-offset="-200" data-timeout="200">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-body-light text-danger mx-auto">
                            <i class="fa-2x far fa-gem"></i>
                        </div>
                        <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Clients')}}</div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('submissions.index') }}">
            <div class="block block-rounded" data-toggle="appear" data-offset="-200" data-timeout="400">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-body-light text-success mx-auto">
                            <i class="fa-2x far fa-list-alt"></i>
                        </div>
                        <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Submissions')}}</div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('posts.index') }}">
                <div class="block block-rounded" data-toggle="appear" data-offset="-200">
                    <div class="block-content block-content-full">
                        <div class="py-5 text-center">
                            <div class="item item-2x item-rounded bg-body-light text-warning-light mx-auto">
                                <i class="fa fa-blog fa-2x"></i>
                            </div>
                            <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Blog')}}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('faqs.index') }}">
                <div class="block block-rounded" data-toggle="appear" data-offset="-200" data-timeout="200">
                    <div class="block-content block-content-full">
                        <div class="py-5 text-center">
                            <div class="item item-2x item-rounded bg-body-light text-gray mx-auto">
                                <i class="fa-2x far fa-question-circle"></i>
                            </div>
                            <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Faqs')}}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('testimonials.index') }}">
                <div class="block block-rounded" data-toggle="appear" data-offset="-200" data-timeout="400">
                    <div class="block-content block-content-full">
                        <div class="py-5 text-center">
                            <div class="item item-2x item-rounded bg-body-light text-flat mx-auto">
                                <i class="fa-2x fa fa-comment-dots"></i>
                            </div>
                            <div class="fs-4 fw-semibold pt-3 mb-0">{{__('custom.Testimonials')}}</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
