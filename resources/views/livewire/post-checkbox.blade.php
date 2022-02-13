<div>

@if(isset($comments))
    <!-- Comments -->
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Post with all Comments!</h3>
            <div class="block-options d-flex">

                <a class="btn-block-option me-2" href="#forum-reply-form">
                    <i class="far fa-comment"></i> Comment
                </a>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>

        <div class="block-content">

        @if(isset($comments))
        @foreach($comments as $comment)
                @if($comment->reply_id == null)
                <table class="table table-borderless">
                    <tbody>
                    <tr class="btn-alt-primary mt-5">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="fs-sm text-muted d-flex justify-content-between">
                            <div>
                                <span class="text-muted me-4 fw-semibold">Message from</span> {{ $comment->user->name }} on <span class="text-muted ms-4">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>

                            @livewire('toggle-button',
                            [
                                'model' => $comment,
                                'field' => 'is_active'
                            ])

                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">

                            <img class="rounded-circle" height="62" width="62" src="{{ $comment->user->avatar ? asset('/') . $comment->user->avatar->file : 'http://placehold.it/62x62'  }}" alt="">

                            <p class="fs-sm fw-medium mt-3 mx-1">{{ $comment->user->posts->count() . 'Posts' }}</p>
                        </td>
                        <td>
                            {!! $comment->body !!}
                            <hr>
                            <div class="d-flex justify-content-between">
                                <p class="fs-sm text-muted">There is only one way to avoid criticism: do nothing, say nothing, and be nothing.</p>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-end">
                    <a class="btn btn-alt-success mb-4" data-bs-toggle="collapse" href="#collapseExample{{ $comment->id }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $comment->id }}">
                        <i class="far fa-comment me-1 opacity-50"></i>Reply on Message
                    </a>
                </div>
                <div class="collapse" id="collapseExample{{ $comment->id }}">
                    <div class="card card-body border-0">
                        <div class="">
                            <article class="col-md-10 offset-md-1">
                                <tr>
                                    <td class="d-none d-sm-table-cell text-center">
                                    </td>
                                    <td>
                                        {!! Form::open(['method'=>'POST', 'action'=>'App\Http\Controllers\AdminCommentController@storeReply']) !!}
                                        <div class="form-group  mb-4 d-flex justify-content-end">
                                            {!! Form::textarea('body',null,['class'=>'form-control', ]) !!}
                                            {{ Form::hidden('post_id', $post = Route::current()->post) }}
                                            {{ Form::hidden('comment_id', $comment->id) }}
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <div class="mx-5">
                                                <a class="fw-semibold text-success" href="be_pages_generic_profile.php"><?php echo Auth::user()->name ?></a> type your reply
                                            </div>
                                            <div class="form-group mr-1">
                                                {!! Form::button('<i class="far fa-comment me-1 opacity-50"></i> Submit',['type'=>'submit','class'=>'btn btn-alt-primary mb-5']) !!}
                                            </div>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            </article>
                        </div>
                    </div>
                </div>

                    @php
                        $commentReplies = \App\Models\Comment::query()
                        ->with('user')
                        ->where('reply_id', $comment->id)
                        ->latest()
                        ->get()
                    @endphp
                    <!-- Replies on the Comments Section-->
                    @foreach($commentReplies as $commentReply)
                        @if(isset($commentReply))

                            <table class="block-content w-75 mb-4">
                                <tbody class="col-md-10 offset-md-1 w-75">

                                <div class="btn-alt-secondary py-2 my-5 d-flex justify-content-between ms-5 ps-5">
                                    <a class="fw-semibold fs-sm text-muted py-2 mx-5 ps-5" href="be_pages_generic_profile.php"><span class="text-muted me-4 py-1">Reply from</span> {{ $commentReply->user->name }} on <span class="text-muted ms-4">{{ $commentReply->created_at->diffForHumans() }}</span></a>
                                    @livewire('toggle-button-reply',
                                    [
                                    'model' => $commentReply,
                                    'field' => 'is_active'
                                    ])
                                </div>
                                <tr>

                                    <td class="d-none d-sm-table-cell text-center" style="width: 140px;">

                                        <img class="rounded-circle" height="62" width="62" src="{{ $commentReply->user->avatar ? asset('/') . $commentReply->user->avatar->file : 'http://placehold.it/62x62'  }}" alt="">

                                        <p class="fs-sm fw-medium mt-3 mx-1">{{ $commentReply->user->posts->count() . 'Posts' }}</p>
                                    </td>
                                    <td>
                                        {!! $commentReply->body !!}
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <p class="fs-sm text-muted">There is only one way to avoid criticism: do nothing, say nothing, and be nothing.</p>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                    @endforeach

                    <!-- END Replies on the Comments Section-->
                @endif
            @endforeach
            @endif
        </div>
    </div>
    <!-- END Comments -->
    @endif
    <div class="d-flex justify-content-center">
        {{ $comments->links() }}
    </div>
</div>
